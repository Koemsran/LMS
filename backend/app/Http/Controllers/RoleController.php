<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission; // Import the correct model
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all(); // Fetch all roles
        return view('menus.roles.index', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menus.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:roles,name'
            ]
        ]);

        // Create the new role
        Role::create([
            'name' => $request->name
        ]);

        return redirect('roles')->with('status', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('menus.roles.edit', [
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:roles,name,' . $role->id
            ]
        ]);

        // Update the role
        $role->update([
            'name' => $request->name
        ]);

        return redirect('roles')->with('status', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Role::find($id)->delete();
        return redirect('roles')->with('status', 'Role deleted successfully.');
    }

    /**
     * Show the form for adding permissions to a role.
     */
    public function addPermission($id)
    {
        $permissions = Permission::all(); // Fetch all permissions
        $role = Role::findOrFail($id);
        $rolePermissions = DB::table('role_has_permissions')
                               ->where('role_has_permissions.role_id', $role->id)
                               ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                               ->all();
        return view('menus.roles.add-permission', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' =>$rolePermissions
        ]);
    }
    public function updatePermission(Request $request, $id)
    {
        $request->validate([
            'permission' => 'required'
        ]);
        $role = Role::findOrFail($id);
        $role->syncPermissions($request->permission);
        return redirect()->back()->with('status', 'Permissions updated successfully.');
    }
}
