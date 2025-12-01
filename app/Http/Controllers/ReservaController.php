<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Experiencia;
use App\Models\Comunidad;
use App\Models\InformacionClimatica;
use Illuminate\Http\Request;
use App\Http\Requests\ReservaRequest;
use Illuminate\Support\Facades\Mail;


class ReservaController extends Controller
{
    public function store(ReservaRequest $request)
    {
        $data = $request->validated();

        // Si viene comunidad_id, comprobar que la experiencia pertenece a esa comunidad
        if (!empty($data['comunidad_id']) && !empty($data['experiencia_id'])) {
            $exists = Experiencia::where('experiencia_id', $data['experiencia_id'])
                ->where('comunidad_id', $data['comunidad_id'])
                ->exists();

            if (! $exists) {
                return back()->withErrors(['experiencia_id' => 'La experiencia seleccionada no pertenece a la comunidad indicada.'])->withInput();
            }
        }

        // Calcular precio_total: (ninos + adultos) * precio de la experiencia
        $numeroAdultos = isset($data['numero_adultos']) ? (int) $data['numero_adultos'] : 0;
        $numeroNinos = isset($data['numero_ninos']) ? (int) $data['numero_ninos'] : 0;
        $cantidadPersonas = $numeroAdultos + $numeroNinos;

        if (!empty($data['experiencia_id'])) {
            $experiencia = Experiencia::find($data['experiencia_id']);
            if ($experiencia) {
                $precioUnitario = is_null($experiencia->precio_bs) ? 0 : (float) $experiencia->precio_bs;
                $data['precio_total'] = $cantidadPersonas * $precioUnitario;
            } else {
                $data['precio_total'] = 0;
            }
        } else {
            // Si no hay experiencia vinculada, dejar en 0
            $data['precio_total'] = 0;
        }

        $reserva = Reserva::create($data);

        // Enviar correo de confirmación (si está configurado)
        try {
            Mail::to($reserva->email)->send(new \App\Mail\ReservaConfirmacion($reserva));
        } catch (\Throwable $e) {
            // no detener el flujo si el envío de correo falla; registrar o manejar según políticas
        }

        return redirect()->route('reservas.success', $reserva->reserva_id);
    }

    // Caso de uso 5: Panel Administrativo de Reservas
    public function adminPanel(Request $request)
    {
        $query = Reserva::with('experiencia');

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('fecha_experiencia')) {
            $query->whereDate('fecha_experiencia', $request->fecha_experiencia);
        }

        $reservas = $query->paginate(20);
        return view('reservas.admin', compact('reservas'));
    }

    public function create(Request $request)
    {
        // Opcional: filtrar por comunidad o experiencia preseleccionada
        $comunidadId = $request->query('comunidad_id');
        $experienciaId = $request->query('experiencia_id');

        $comunidades = Comunidad::where('estado','activa')->get();

        if ($comunidadId) {
            $experiencias = Experiencia::where('comunidad_id', $comunidadId)->where('estado','activa')->get();
        } elseif ($experienciaId) {
            $experiencias = Experiencia::where('experiencia_id', $experienciaId)->where('estado','activa')->get();
        } else {
            $experiencias = Experiencia::where('estado','activa')->get();
        }

        return view('reservas.create', compact('experiencias','comunidades','comunidadId','experienciaId'));
    }

    public function updateEstado(Request $request, Reserva $reserva)
    {
        $request->validate(['estado' => 'required|string']);
        $reserva->estado = $request->estado;
        $reserva->save();

        return back()->with('success', 'Estado actualizado correctamente');
    }

}
