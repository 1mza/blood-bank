<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct(){
        $this->middleware('permission:roles-delete',['only' => ['destroy'] ]);
        $this->middleware('permission:roles-lists',['only' => ['index','show'] ]);
        $this->middleware('permission:roles-edit',['only' => ['edit','update'] ]);
        $this->middleware('permission:roles-create',['only' => ['create','store','addPermissionToRole','givePermissionToRole'] ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles-permissions.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles-permissions.roles.create');
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
        $role = Role::create($request->all());
        flash()->success('Role created successfully.');
        return redirect()->route('roles.show',$role);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::findOrFail($id);
        return view('roles-permissions.roles.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
        return view('roles-permissions.roles.edit',compact('role'));

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
        $role = Role::findOrFail($id);
        $role->update($request->all());
        flash()->success('Role updated successfully.');
        return redirect()->route('roles.show',$role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        flash()->success('Role deleted successfully.');
        return redirect()->route('roles.index');
    }

    public function addPermissionToRole(Request $request, string $id){

        $permissions = Permission::get();
        $role = Role::findOrFail($id);
        $rolePermissions = DB::table("role_has_permissions")
            ->where('role_id',$role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('roles-permissions.roles.add-permission',compact('permissions','role','rolePermissions'));
    }

    public function givePermissionToRole(string $id, Request $request)
    {
    $rules = [
        'permissions' => 'required|array',
        'permissions.*' => 'exists:permissions,name',
    ];
    $messages = [
        'permissions.required' => 'Permissions are required.',
        'permissions.*.exists' => 'One or more selected permissions do not exist.',
    ];
    $this->validate($request, $rules, $messages);

    $role = Role::findOrFail($id);

    // Syncing permissions with the role
    $role->syncPermissions($request->permissions);

    flash()->success('Permissions given successfully.');

    return redirect()->route('roles.show', $role);
}

}
