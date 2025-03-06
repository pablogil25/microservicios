<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Registro de usuario
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Usuario registrado exitosamente'], 201);
    }

    // Inicio de sesión
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $user]);
    }

    // Obtener información del perfil del usuario autenticado
    public function profile(Request $request)
    {
        return response()->json($request->user());
    }

    // Cerrar sesión (revocar token)
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Sesión cerrada exitosamente']);
    }

        // Actualizar perfil del usuario autenticado
    public function update(Request $request)
    {
    $user = $request->user(); // Obtener el usuario autenticado

    // Validar los datos ingresados
    $request->validate([
        'name' => 'string|max:255',
        'email' => 'string|email|max:255|unique:users,email,' . $user->id, // Asegurar que el email sea único excepto para el usuario actual
        'password' => 'nullable|string|min:6',
    ]);

    // Actualizar solo los campos enviados en la solicitud
    if ($request->has('name')) {
        $user->name = $request->name;
    }
    if ($request->has('email')) {
        $user->email = $request->email;
    }
    if ($request->filled('password')) { // Verifica que la contraseña no esté vacía
        $user->password = Hash::make($request->password);
    }

    $user->save(); // Guardar cambios en la base de datos

    return response()->json(['message' => 'Perfil actualizado correctamente', 'user' => $user]);
    }

}
