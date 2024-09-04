<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email'     => 'required|string|email|max:255',
            'password'  => 'required|string'
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 401);
        }

        // Check if the provided password matches the stored hashed password
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Incorrect password'
            ], 401);
        }

        // Generate the token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return success response with token
        return response()->json([
            'message'       => 'Login success',
            'access_token'  => $token,
            'token_type'    => 'Bearer'
        ]);
    }

    public function index(Request $request)
{
    if (Auth::check()) {
        $user = $request->user();
        $token = $request->bearerToken();
        
        // Get roles and format them
        $roles = $user->roles->map(function ($role) {
            return [
                'id' => $role->id,
                'name' => $role->name
            ];
        });

        // Prepare the user data without the roles
        $userData = $user->only(['id', 'name', 'email', 'profile', 'leave_balance', 'created_at', 'updated_at']);
        $userData['roles'] = $roles; // Add formatted roles

        return response()->json([
            'message' => 'Login success',
            'data' => $userData ,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    } else {
        return response()->json(['error' => 'User not found'], 404);
    }
}
    public function show($id)
    {
        $user = User::find($id);
        return response()->json(['success' => true, 'data' => $user]);
    }

    public function register(Request $request)
    {
        $user = User::store($request);
        $token  = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message'       => 'Register success',
            'access_token'  => $token,
            'token_type'    => 'Bearer'
        ], 201);
    }
    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->syncRoles($request->role);
        return response()->json(['message' => 'Role updated successfully', 'role' => $user->getRoleNames()], 200);
    }

    public function logout(Request $request)
    {


        $user = $request->user();

        // Revoke the user's current token
        $user->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
