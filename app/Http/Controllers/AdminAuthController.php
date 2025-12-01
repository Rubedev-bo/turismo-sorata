<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrador;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'usuario' => 'required|string',
            'password' => 'required|string',
        ]);

        try {
            // Probar conexión y consulta usando el modelo; capturamos excepciones SQL para mostrar mensajes útiles
            DB::connection()->getPdo();
            $admin = Administrador::where('usuario', $data['usuario'])->first();
        } catch (\Throwable $e) {
            Log::error('Error DB admin login: '.$e->getMessage());
            return back()->withErrors(['db' => 'Error de conexión a la base de datos. Revisa la configuración en .env o el servidor DB.'])->withInput();
        }

        if (!$admin) {
            return back()->withErrors(['usuario' => 'Credenciales inválidas'])->withInput();
        }

        // Verificar contraseña (asumimos bcrypt/hashing)
        if (!Hash::check($data['password'], $admin->contrasena_hsh)) {
            return back()->withErrors(['usuario' => 'Credenciales inválidas'])->withInput();
        }

        // Guardar en sesión simple
        session(['admin_id' => $admin->admin_id]);

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_id');
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Mostrar formulario para crear primer admin si no hay ninguno
    public function showCreateFirst()
    {
        $count = Administrador::count();
        if ($count > 0) {
            return redirect()->route('admin.login')->with('success','Ya existen administradores registrados.');
        }
        return view('admin.create_admin');
    }

    // Guardar el primer admin (o cualquiera mediante este endpoint)
    public function storeCreateFirst(Request $request)
    {
        $data = $request->validate([
            'usuario' => 'required|string|max:100|unique:administrador,usuario',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $admin = Administrador::create([
            'usuario' => $data['usuario'],
            'contrasena_hsh' => Hash::make($data['password']),
            'rol' => 'superadmin',
            'estado' => 'activa'
        ]);

        // iniciar sesion del admin creado
        session(['admin_id' => $admin->admin_id]);

        return redirect()->route('admin.dashboard')->with('success','Administrador creado y autenticado.');
    }
}
