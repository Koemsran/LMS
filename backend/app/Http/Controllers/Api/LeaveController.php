<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeaveRequest;
use App\Http\Resources\LeaveResource;
use App\Models\History;
use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaves = Leave::all();
        $leaves = LeaveResource::collection($leaves);
        return response()->json(['success' => true, "data" => $leaves], 200);
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
    public function store(LeaveRequest $request)
    {
        $leave = Leave::store($request);
        History::create([
            'leave_id' => $leave->id,
            'user_id' => 1,
            'created_at' => now(),
        ]);
        return response()->json(['success' => true, 'message' => 'Leave created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $userId)
    {
        // Fetch the leaves for the user
        $leave = Leave::where('user_id', $userId)->get();  // Use get() to retrieve the collection

        // Check if any leave records exist for the user
        if ($leave->isEmpty()) {
            return response()->json(['error' => 'User not found or no leaves recorded'], 404);
        }

        // Return the collection of leave records as a resource
        $leaveResource = LeaveResource::collection($leave);
        return response()->json(['success' => true, 'data' => $leaveResource], 200);
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
    public function update(Request $request, string $id)
    {
        Leave::store($request, $id);
        return response()->json(['success' => true, 'message' => 'Leave updated successfully'], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $leave = Leave::find($id);
        $leave->delete();
        return response()->json(['success' => true, 'message' => 'Leave deleted successfully'], 200);
    }
    public function approveLeave(string $id)
    {
        $leave = Leave::find($id);
        $leave->status = 'approved';
        $leave->save();
        return response()->json(['success' => true, 'message' => 'Leave approved successfully'], 200);
    }
    public function rejectLeave(string $id)
    {
        $leave = Leave::find($id);
        $leave->status = 'rejected';
        $leave->save();
        return response()->json(['success' => true, 'message' => 'Leave rejected successfully'], 200);
    }
    public function cancelLeaveRequest(string $id)
    {
        $leave = Leave::find($id);
        $leave->status = 'cancelled';
        $leave->save();
        return response()->json(['success' => true, 'message' => 'Leave cancelled successfully'], 200);
    }
}
