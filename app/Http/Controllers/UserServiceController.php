<?php

namespace App\Http\Controllers;

use App\Models\UserService;
use Illuminate\Http\Request;

class UserServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $userService= UserService::all();
       return response()->json([
        'status' => 'success',
        'data' => $userService
    ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|string|max:80',
            'password' => 'required|string|max:30',
        ]);
        $userService=UserService::create($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $userService
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(UserService $userService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserService $userService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserService $userService)
    {
        //
    }
}
