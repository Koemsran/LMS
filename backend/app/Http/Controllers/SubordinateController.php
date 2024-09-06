<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubordinateRequest;
use App\Http\Resources\SubordinateResource;
use App\Models\Subordinate;
use Illuminate\Http\Request;

class SubordinateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getSubordinates()
    {
        $subordinates = Subordinate::all();
        $subordinates = SubordinateResource::collection($subordinates);
        return response()->json(['success'=>true, 'data'=>$subordinates], 200);
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
    public function assignSubordinate(SubordinateRequest $request)
    {
        Subordinate::store($request);
        return response()->json(['success'=> true, "message"=>"Subordinate assigned successfully"], 201);
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
        Subordinate::store($request, $id);
        return response()->json(['success'=> true, "message"=>"Subordinate updated successfully"], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function removeSubordinate(string $id)
    {
        $subordinate = Subordinate::find($id);
        $subordinate->delete();
        return response()->json(['success'=>true, 'message'=>'Subordinate deleted successfully'], 200);
    }
}
