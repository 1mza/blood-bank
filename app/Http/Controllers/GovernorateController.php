<?php

namespace App\Http\Controllers;

use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    public function __construct(){
        $this->middleware('permission:governorates-delete',['only' => ['destroy'] ]);
        $this->middleware('permission:governorates-lists',['only' => ['index','show'] ]);
        $this->middleware('permission:governorates-edit',['only' => ['edit','update'] ]);
        $this->middleware('permission:governorates-create',['only' => ['create','store'] ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Governorate::all();
        return view('governorates.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('governorates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'string'],
        ];
        $messages = [
            'name.required' => 'Name is required.',
        ];
        $this->validate($request,$rules,$messages);
        $governorate = Governorate::create($request->all());
        flash()->success('Governorate created successfully.');
        return redirect()->route('governorates.show',compact('governorate'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Governorate  $governorate)
    {
        return view('governorates.show', compact('governorate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Governorate $governorate)
    {
        return view('governorates.edit', compact('governorate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Governorate $governorate)
    {
        $rules = [
            'name' => ['required', 'string'],
        ];
        $messages = [
            'name.required' => 'Name is required.',
        ];
        $this->validate($request,$rules,$messages);
        $governorate->update($request->all());
        flash()->success('Governorate updated successfully.');
        return redirect()->route('governorates.show',compact('governorate'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Governorate $governorate)
    {
        $governorate->delete();
        return redirect('/governorates');
    }
}
