<?php

namespace App\Http\Controllers;

use App\Models\TramoAcceso;
use App\Models\Equipamiento;
use App\Models\InformacionClimatica;
use Illuminate\Http\Request;

class GuiaController extends Controller
{
    // Caso de uso 6: Consultar ¿Cómo Llegar?
    public function comoLlegar()
    {
        $tramos = TramoAcceso::with('comunidad')->get();
        return view('guia.como_llegar', compact('tramos'));
    }

    // Caso de uso 7: Consultar Equipamiento
    public function equipamiento(Request $request)
    {
        $query = Equipamiento::query();
        if ($request->filled('tipo_actividad')) {
            $query->where('tipo_actividad', $request->tipo_actividad);
        }
        $equipos = $query->get();
        return view('guia.equipamiento', compact('equipos'));
    }

    // Caso de uso 8: Consultar Información Climática
    public function clima()
    {
        $climas = InformacionClimatica::all();
        return view('guia.clima', compact('climas'));
    }
}
