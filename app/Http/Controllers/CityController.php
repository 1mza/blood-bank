<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct(){
        $this->middleware('permission:cities-delete',['only' => ['destroy'] ]);
        $this->middleware('permission:cities-lists',['only' => ['index','show'] ]);
        $this->middleware('permission:cities-edit',['only' => ['edit','update'] ]);
        $this->middleware('permission:cities-create',['only' => ['create','store'] ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::paginate(10);
        return view('cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'governorate_id' => 'required|exists:governorates,id',
        ];
        $this->validate($request,$rules);
        $city = City::create($request->all());
        flash()->success('Governorate created successfully.');
        return redirect()->route('cities.show',compact('city'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $city = City::findOrFail($id);
        return view('cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $city = City::findOrFail($id);
        return view('cities.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'name' => 'required',
            'governorate_id' => 'required|exists:governorates,id',
        ];
        $this->validate($request,$rules);
        $city = City::findOrFail($id);
        $city->update($request->all());
        flash()->success('City updated successfully.');
        return redirect()->route('cities.show',compact('city'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        flash()->success('City deleted successfully.');
        return redirect()->route('cities.index');
    }
}
