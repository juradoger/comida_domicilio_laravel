<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class AuthControllers extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Obtener el usuario autenticado
            $user = Auth::user();

            // Redireccionar según el rol del usuario
            switch ($user->id_rol) {
                case 1: // Admin
                    return redirect('/admin');
                case 2: // Empleado
                    return redirect('/empleado');
                default: // Cliente u otros
                    return redirect('/cliente/dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas.',
        ]);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        // Asignar el id_rol de cliente por defecto (2)
        $idRolCliente = 2;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'apellido' => $request->apellido ?? '',
            'telefono' => $request->telefono ?? '',
            'id_rol' => $idRolCliente,
        ]);

        return redirect()->route('login')->with('success', 'Usuario registrado correctamente.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
