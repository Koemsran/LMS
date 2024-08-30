<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission; // Use the correct model

class PermissionController extends Controller
 
{
    public function index()
    {
        $permissions = Permission::get();
        return view('menus.permissions.index', [
            'permissions'=>$permissions
        ]);
    }

    public function create()
    {
        // Show the form to create a new permission
        return view('menus.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:permissions,name'
            ]
        ]);

        // Create the new permission
        Permission::create([
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status', 'Permission created successfully.');
    }

    public function show($id)
    {
        // Logic for displaying a specific permission
    }

    public function edit(Permission $permission)
    {
        return view('menus.permissions.edit', [
            'permission' => $permission
        ]);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:permissions,name,'.$permission->id
            ]
        ]);
        // Create the new permission
        $permission->update([
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status', 'Permission updated successfully.');

    }

    public function destroy($id)
    {
        Permission::find($id)->delete();
        return redirect('permissions')->with('status', 'Permission deleted successfully.');
    }
}
