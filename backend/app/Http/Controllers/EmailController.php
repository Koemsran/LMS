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
    public function sendEmail()
    {
        $toEmail = 'koemsran.phon1111@gmail.com';
        $message = 'Welcome to our Leave Request';
        $subject = 'Welcome Leave Request';
        $responde = Mail::to($toEmail)->send(new SendingEmail($message, $subject));
        dd($responde);
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
