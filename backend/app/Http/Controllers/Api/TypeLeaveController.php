<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeaveTpyeRequest;
use App\Http\Resources\LeaveTpyeResource;
use App\Models\TypeLeav;
use Illuminate\Http\Request;

class TypeLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typeLeaves = TypeLeav::all();
        $typeLeaves = LeaveTpyeResource::collection($typeLeaves);
        return response()->json(['success'=> true, "data"=>$typeLeaves ],200);
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
    public function store(LeaveTpyeRequest $request)
    {
            TypeLeav::store($request);
            return response()->json(['success'=>true, "data"=>"type of leave created successfully"], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $typeLeave = TypeLeav::find($id);
        if($typeLeave){
            $typeLeave = new LeaveTpyeResource($typeLeave);
            return response()->json(['success'=> true, "data"=>$typeLeave ],200);
        }
        else{
            return response()->json(['success'=> false, "message"=>"type of leave not found"], 404);
        }
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
        TypeLeav::store($request, $id);
        return response()->json(['success'=>true, "data"=>"type of leave updated successfully"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type = TypeLeav::find($id);
        $type ->delete();
        return response()->json(['success'=> true, "message"=>"type of leave deleted successfully"], 200);
    }
}
