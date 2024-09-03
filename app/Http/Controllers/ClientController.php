<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Post;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ClientController extends Controller
{
    use UploadImageTrait;

    public function __construct()
    {
        $this->middleware('permission:posts-delete', ['only' => ['destroy']]);
        $this->middleware('permission:posts-lists', ['only' => ['index', 'show']]);
        $this->middleware('permission:posts-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:posts-create', ['only' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clients',
            'password' => 'required|confirmed',
            'd_o_b' => 'required|date|before:today',
            'phone' => 'required',
            'last_donation_date' => 'required|date|before:today',
            'blood_type_id' => 'required|exists:blood_types,id',
            'governorate_id' => 'required|exists:governorates,id',
            'city_id' => 'required|exists:cities,id',
        ]);
        $data['password'] = bcrypt($data['password']);
//            $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($data);
        $client->api_token = Str::random(60);
        $client->save();
        $client->bloodTypes()->attach($request->blood_type_id);

        $client->governorates()->attach($request->governorate_id);
        flash()->success('Client created successfully.');
        return redirect()->route('clients.show', compact('client'));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::findOrFail($id);
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'email' => 'email|',
            'password' => 'confirmed',
            'd_o_b' => 'date|before:today',
            'last_donation_date' => 'date|before:today',
            'blood_type_id' => 'required|exists:blood_types,id',
            'governorate_id' => 'required|exists:governorates,id',
            'city_id' => 'required|exists:cities,id',
        ];
        $this->validate($request, $rules);
        $request['password'] = bcrypt($request['password']);
        $client = Client::findOrFail($id);
        $client->update($request->all());
        flash()->success('Client updated successfully.');
        return redirect()->route('clients.show', compact('client'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        flash()->success('Client deleted successfully.');
        return redirect()->route('clients.index');
    }
}
