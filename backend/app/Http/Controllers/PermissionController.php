<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;
use Spatie\Permission\Models\Permission; // Use the correct model

class PermissionController extends Controller
 
{
    public function index()
    {
        $permissions = Permission::get();
        return response()->json(['success'=>true, 'data'=>$permissions]);
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

        return response()->json(['success'=>true, 'message'=>'Permission created successfully']);
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

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:permissions,name,'
            ]
        ]);
        // Create the new permission
        $permission = Permission::find($id);
        if (!$permission) {
            return response()->json(['success'=>false, 'message'=>'Permission not found']);
        }
        $permission->update([
            'name' => $request->name
        ]);
        return response()->json(['success'=>true, 'message'=>'Permission updated successfully']);

    }

    public function destroy($id)
    {
        Permission::find($id)->delete();
        return response()->json(['success'=>true, 'message'=>'Permission deleted successfully']);
    }
}
