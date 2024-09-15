<?php

namespace App\Http\Controllers;

use App\Mail\SendingEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function sendEmail(Request $request)
    {
        $toEmail = $request->toEmail;
        $subject = "Leave Request from " . $request->employeeName;
        $employeeName = $request->employeeName;
        $leaveType = $request->leaveType;
        $leaveDates = $request->leaveDates;
        $leaveReason = $request->leaveReason;
        $leaveId = $request->leaveId;
        Mail::to($toEmail)->send(new SendingEmail($employeeName, $leaveType, $leaveDates, $leaveReason, $leaveId, $subject));
    
        return response()->json(['success' => true, 'data' => 'Email sent successfully'], 200);
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
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
