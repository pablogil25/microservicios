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
       $userService = UserService::all();
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

        $userService = UserService::create($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $userService
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $userService = UserService::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $userService
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserService $userService)
    {
        $request->validate([
            'name' => 'string|max:30',
            'email' => 'string|max:80',
            'password' => 'string|max:30',
        ]);

        $userService->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Actualizado correctamente',
            'data' => $userService
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserService $userService)
    {
        $userService->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'UserService eliminado correctamente.'
        ], 200);
    }
}
