<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        User::create($request->all());
        return response()->json(['status'=>true,
                                 "messsage"=>"Inserted Successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json(['status'=>true,
                                 "data"=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        return response()->json(['status'=>true,
                                 "messsage"=>"Updated Successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['status'=>true,
                                 "messsage"=>"Deleted Successfully"]);

    }
}