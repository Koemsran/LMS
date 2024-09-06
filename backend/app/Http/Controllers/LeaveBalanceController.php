<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\LeaveBalanceResource;
use App\Models\LeaveBalance;
use Illuminate\Http\Request;

class LeaveBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $balances = LeaveBalance::all();
        $balances = LeaveBalanceResource::collection($balances);
        return response()->json(['success' => true, 'data' => $balances], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        LeaveBalance::store($request);
        return response()->json(['success' => true, 'message' => 'Leave balance created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $balance = LeaveBalance::find($id);
        $balance = new LeaveBalanceResource($balance);
        return response()->json(['success' => true, 'data' => $balance], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $userId)
    {
        LeaveBalance::store($request, $userId);
        return response()->json(['success' => true, 'message' => 'Leave balance updated successfully'], 201);
    }

    public function updateTokenBalance(Request $request, $userId)
    {
        $leaveBalance = LeaveBalance::where('user_id', $userId)->first();

        if (!$leaveBalance) {
            return response()->json(['message' => 'Leave balance not found'], 404);
        }
        $user = $leaveBalance->user;

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $leaveBalance->token_balance += $request->input('token_balance');
        $leaveBalance->leave_balance = $user->leave_balance - $leaveBalance->token_balance;
        $leaveBalance->save();

        return response()->json([
            'message' => 'Token balance updated successfully',
            'leaveBalance' => $leaveBalance
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $balance = LeaveBalance::find($id);
        $balance->delete();
        return response()->json(['success' => true, 'message' => 'Leave balance deleted successfully'], 200);
    }
}
