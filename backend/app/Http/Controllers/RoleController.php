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
        // Fetch all roles with their permissions
        $roles = Role::with('permissions')->get();

        // Prepare the data to be returned
        $data = $roles->map(function ($role) {
            return [
                'id' => $role->id,
                'name' => $role->name,
                'permissions' => $role->permissions->map(function ($permission) {
                    return [
                        'id' => $permission->id,    // Include permission ID
                        'name' => $permission->name // Include permission name
                    ];
                })
            ];
        });

        return response()->json(['success' => true, 'data' => $data]);
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

        return response()->json(['success' => true, 'message' => 'Role created successfully']);
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
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:roles,name,'
            ]
        ]);

        // Update the role
        $role = Role::find($id);
        if ($role) {
            $role->update([
                'name' => $request->name
            ]);

            return response()->json(['success' => true, 'message' => 'Role updated successfully']);
        } else {
            return response()->json(['error' => true, 'message' => 'Role not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return response()->json(['success' => true, 'message' => 'Role deleted successfully']);
    }

    /**
     * Show the form for adding permissions to a role.
     */
    public function updatePermissions(Request $request, $roleId)
    {
        // Validate the request
        $request->validate([
            'permission_ids' => 'required|array',
            'permission_ids.*' => 'exists:permissions,id'
        ]);

        $permissionIds = $request->input('permission_ids');

        // Find the role
        $role = Role::findOrFail($roleId);

        // Remove all existing permissions from the role
        $role->permissions()->detach();

        // Loop through each permission ID
        foreach ($permissionIds as $permissionId) {
            // Find the permission
            $permission = Permission::findOrFail($permissionId);

            // Assign permission to the role
            $role->givePermissionTo($permission);
        }

        // Retrieve the updated list of permissions for the role
        $rolePermissions = $role->permissions->map(function ($permission) {
            return [
                'id' => $permission->id,
                'name' => $permission->name
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Permissions updated successfully',
            'rolePermissions' => $rolePermissions
        ]);
    }

    // public function updatePermission(Request $request, $id)
    // {
    //     $request->validate([
    //         'permission' => 'required'
    //     ]);
    //     $role = Role::findOrFail($id);
    //     $role->syncPermissions($request->permission);
    //     return redirect()->back()->with('status', 'Permissions updated successfully.');
    // }
}
