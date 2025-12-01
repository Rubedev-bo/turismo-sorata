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
        // mostrar sólo activas para turistas; admin ve todas
        if (session('admin_id')) {
            $comunidades = Comunidad::with('experiencias')->get();
        } else {
            $comunidades = Comunidad::with('experiencias')->where('estado','activa')->get();
        }
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
        // Manejar subida de imagen si se proporcionó
        if ($request->hasFile('imagen_representativa')) {
            $file = $request->file('imagen_representativa');
            $folder = public_path('uploads/comunidades');
            if (!file_exists($folder)) mkdir($folder, 0755, true);
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
            $file->move($folder, $filename);
            // Guardar ruta relativa accesible
            $data['imagen_representativa'] = '/uploads/comunidades/' . $filename;
        }

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
        // Manejar subida de imagen: si se sube una nueva, reemplazar; si no, mantener la existente
        if ($request->hasFile('imagen_representativa')) {
            $file = $request->file('imagen_representativa');
            $folder = public_path('uploads/comunidades');
            if (!file_exists($folder)) mkdir($folder, 0755, true);
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
            $file->move($folder, $filename);
            $data['imagen_representativa'] = '/uploads/comunidades/' . $filename;
        }

        $comunidad->update($data);

        return redirect()->route('comunidades.index')->with('success', 'Comunidad actualizada correctamente');
    }

    public function desactivar(Comunidad $comunidad)
    {
        // Toggle estado between 'activa' and 'inactiva'
        $comunidad->estado = ($comunidad->estado === 'activa') ? 'inactiva' : 'activa';
        $comunidad->save();

        $msg = $comunidad->estado === 'activa' ? 'Comunidad activada' : 'Comunidad desactivada';
        return redirect()->route('comunidades.index')->with('success', $msg);
    }

    public function show(Comunidad $comunidad)
    {
        $comunidad->load('experiencias.reservas');

        // Obtener tipos de actividad de las experiencias de la comunidad y buscar climas
        $tipos = $comunidad->experiencias->pluck('tipo_actividad')->unique()->filter()->values();
        $climas = collect();
        if ($tipos->isNotEmpty()) {
            $climas = InformacionClimatica::whereIn('tipo_experiencia', $tipos->all())
                ->where('estado','activa')
                ->get();
        }

        return view('comunidades.show', compact('comunidad','climas'));
    }

}