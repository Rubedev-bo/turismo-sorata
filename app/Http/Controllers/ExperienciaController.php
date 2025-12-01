<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experiencia;
use App\Models\InformacionClimatica;
use App\Http\Requests\ExperienciaRequest;
use App\Models\Comunidad;

class ExperienciaController extends Controller
{
    
    public function store(ExperienciaRequest $request)
    {
        $data = $request->validated();
        Experiencia::create($data);
        return redirect()->route('experiencias.index')->with('success', 'Experiencia creada correctamente');
    }

    public function index()
    {
        $experiencias = Experiencia::where('estado', 'activa')->get();
        return view('experiencias.index', compact('experiencias'));
    }

    public function create()
    {
        $comunidades = Comunidad::where('estado','activa')->get();
        return view('experiencias.create', compact('comunidades'));
    }

    public function edit(Experiencia $experiencia)
    {
        $comunidades = Comunidad::where('estado','activa')->get();
        return view('experiencias.edit', compact('experiencia','comunidades'));
    }

    public function update(ExperienciaRequest $request, Experiencia $experiencia)
    {
        $data = $request->validated();
        $experiencia->update($data);
        return redirect()->route('experiencias.index')->with('success', 'Experiencia actualizada');
    }

    public function desactivar(Experiencia $experiencia)
    {
        $experiencia->estado = 'inactiva';
        $experiencia->save();

        return redirect()->route('experiencias.index')->with('success', 'Experiencia desactivada');
    }


    public function show(Experiencia $experiencia)
    {
        $experiencia->load('reservas');

        // Información climática relacionada al tipo de actividad
        $climas = InformacionClimatica::where('tipo_experiencia', $experiencia->tipo_actividad)
            ->where('estado','activa')
            ->get();

        return view('experiencias.show', compact('experiencia','climas'));
    }

    public function filter(Request $request)
    {
        $query = Experiencia::query();

        if ($request->filled('tipo_actividad')) {
            $query->where('tipo_actividad', $request->tipo_actividad);
        }

        if ($request->filled('comunidad_id')) {
            $query->where('comunidad_id', $request->comunidad_id);
        }

        $experiencias = $query->get();
        return view('experiencias.index', compact('experiencias'));
    }

    

}
