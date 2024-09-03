<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct(){
        $this->middleware('permission:permissions-delete',['only' => ['destroy'] ]);
        $this->middleware('permission:permissions-lists',['only' => ['index','show'] ]);
        $this->middleware('permission:permissions-edit',['only' => ['edit','update'] ]);
        $this->middleware('permission:permissions-create',['only' => ['create','store'] ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('roles-permissions.permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles-permissions.permissions.create');
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
        $permission = Permission::create($request->all());
        flash()->success('Permission created successfully.');
        return redirect()->route('permissions.show',$permission);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = Permission::findOrFail($id);
        return view('roles-permissions.permissions.show',compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::findOrFail($id);
        return view('roles-permissions.permissions.edit',compact('permission'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'name' => ['required', 'string'],
        ];
        $messages = [
            'name.required' => 'Name is required.',
        ];
        $this->validate($request,$rules,$messages);
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());
        flash()->success('Permission updated successfully.');
        return redirect()->route('permissions.show',$permission);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        flash()->success('Permission deleted successfully.');
        return redirect()->route('permissions.index');
    }
}
