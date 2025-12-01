<?php

namespace App\Http\Controllers;

use App\Models\Comunidad;
use App\Models\InformacionClimatica;
use App\Http\Requests\ComunidadRequest;
use Illuminate\Http\Request;

class ComunidadController extends Controller
{
    // proteger acciones administrativas
    public function __construct()
    {
        // Usar el middleware de autenticacion de admin simple (session 'admin_id')
        $this->middleware(\App\Http\Middleware\CheckAdminAuth::class)->except(['index','show']);
    }

    public function index()
    {
        // mostrar sólo activas
        $comunidades = Comunidad::with('experiencias')->where('estado','activa')->get();
        return view('comunidades.index', compact('comunidades'));
    }

    public function create()
    {
        return view('comunidades.create');
    }

    public function store(ComunidadRequest $request)
    {
        $data = $request->validated();
        $data['estado'] = $data['estado'] ?? 'activa';
        Comunidad::create($data);

        return redirect()->route('comunidades.index')->with('success', 'Comunidad creada correctamente');
    }

    public function edit(Comunidad $comunidad)
    {
        return view('comunidades.edit', compact('comunidad'));
    }

    public function update(ComunidadRequest $request, Comunidad $comunidad)
    {
        $data = $request->validated();
        $comunidad->update($data);

        return redirect()->route('comunidades.index')->with('success', 'Comunidad actualizada correctamente');
    }

    public function desactivar(Comunidad $comunidad)
    {
        $comunidad->estado = 'inactiva';
        $comunidad->save();

        return redirect()->route('comunidades.index')->with('success', 'Comunidad desactivada');
    }

    public function show(Comunidad $comunidad)
    {
        $comunidad->load('experiencias.reservas');

        // Obtener tipos de actividad de las experiencias de la comunidad y buscar climas
        $tipos = $comunidad->experiencias->pluck('tipo_actividad')->unique()->filter()->values()->all();
        $climas = [];
        if (!empty($tipos)) {
            $climas = InformacionClimatica::whereIn('tipo_experiencia', $tipos)
                ->where('estado','activa')
                ->get();
        }

        return view('comunidades.show', compact('comunidad','climas'));
    }

}