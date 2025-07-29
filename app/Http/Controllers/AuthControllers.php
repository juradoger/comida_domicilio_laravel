<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Empleado;
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

        $user = User::where('email', $credentials['email'])->first();
        if ($user && $user->estado === 'inactivo') {
            return back()->withErrors([
                'email' => 'Esta cuenta no existe o ha sido eliminada.'
            ]);
        }
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
                case 3: // Cliente
                    return redirect('/dashboard');
                default: // Cliente u otros
                    return redirect('/dashboard');
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
            'apellido' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'telefono' => ['required'],
            'password' => ['required', 'confirmed', 'min:6'],
            'tipo_registro' => ['required', 'in:cliente,empleado'],
            // Campos específicos para empleados
            'ci' => ['required_if:tipo_registro,empleado', 'digits_between:7,8', 'unique:empleados,dni'],
            'licencia_conducir' => ['required_if:tipo_registro,empleado', 'string', 'max:20'],
        ]);

        // Determinar el rol según el tipo de registro
        $idRol = $request->tipo_registro === 'empleado' ? 2 : 3; // 2=empleado, 3=cliente

        $user = User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefono' => $request->telefono,
            'id_rol' => $idRol,
        ]);

        // Si es empleado, crear el registro en la tabla empleados
        if ($request->tipo_registro === 'empleado') {
            Empleado::create([
                'fecha_ingreso' => now(),
                'estado' => 'disponible',
                'dni' => $request->ci,
                'licencia_conducir' => $request->licencia_conducir,
                'calificacion_promedio' => 0.0,
                'id_usuario' => $user->id,
            ]);
        }

        // Hacer login automático después del registro y redirigir según el rol
        Auth::login($user);

        // Redireccionar según el rol del usuario registrado
        switch ($user->id_rol) {
            case 1: // Admin
                return redirect('/admin')->with('success', 'Usuario registrado correctamente como administrador.');
            case 2: // Empleado
                return redirect('/empleado')->with('success', 'Usuario registrado correctamente como empleado.');
            case 3: // Cliente
                return redirect('/dashboard')->with('success', 'Usuario registrado correctamente como cliente.');
            default: // Cliente u otros
                return redirect('/dashboard')->with('success', 'Usuario registrado correctamente.');
        }
    }

    public function showConvertToEmployee()
    {
        $user = Auth::user();

        // Verificar que el usuario sea cliente
        if ($user->id_rol !== 3) {
            return redirect()->back()->with('error', 'Solo los clientes pueden convertirse en empleados.');
        }

        return view('auth.convert-to-employee');
    }

    public function convertToEmployee(Request $request)
    {
        $user = Auth::user();

        // Verificar que el usuario sea cliente
        if ($user->id_rol !== 3) {
            return redirect()->back()->with('error', 'Solo los clientes pueden convertirse en empleados.');
        }

        $request->validate([
            'ci' => ['required', 'digits_between:7,8', 'unique:empleados,dni'],
            'licencia_conducir' => ['required', 'string', 'max:20'],
        ]);

        // Crear el registro de empleado
        Empleado::create([
            'fecha_ingreso' => now(),
            'estado' => 'disponible',
            'dni' => $request->ci,
            'licencia_conducir' => $request->licencia_conducir,
            'calificacion_promedio' => 0.0,
            'id_usuario' => $user->id,
        ]);

        // Cambiar el rol del usuario de cliente a empleado
        $user->id_rol = 2; // 2 = empleado
        $user->save();

        return redirect('/empleado')->with('success', '¡Felicidades! Ahora eres un empleado. Bienvenido al panel de empleados.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/'); // Redirige a la página principal
    }
}
