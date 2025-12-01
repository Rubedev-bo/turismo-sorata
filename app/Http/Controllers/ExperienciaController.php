<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experiencia;
use App\Models\InformacionClimatica;
use App\Models\Equipamiento;
use App\Http\Requests\ExperienciaRequest;
use App\Models\Comunidad;

class ExperienciaController extends Controller
{
    
    public function store(ExperienciaRequest $request)
    {
        $data = $request->validated();
        // Manejar subida de imagen principal igual que en Comunidades: mover a public/uploads/experiencias
        if ($request->hasFile('imagen_principal')) {
            $file = $request->file('imagen_principal');
            // Comprobar que el archivo fue subido correctamente y sigue disponible en tmp
            if (!$file->isValid()) {
                $errorMsg = 'Error al subir la imagen principal. Verifica el tamaño y formato.';
                return back()->withErrors(['imagen_principal' => $errorMsg])->withInput();
            }
            $folder = public_path('uploads/experiencias');
            if (!file_exists($folder)) mkdir($folder, 0755, true);
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
            $file->move($folder, $filename);
            $data['imagen_principal'] = '/uploads/experiencias/' . $filename;
        }

        $experiencia = Experiencia::create($data);

        // Guardar informacion climatica si se proporcionó
        $tipo = $experiencia->tipo_actividad;
        if (!empty($data['clima_temporada']) || !empty($data['clima_recomendacion_vestimenta'])) {
            InformacionClimatica::updateOrCreate(
                ['tipo_experiencia' => $tipo],
                [
                    'temporada' => $data['clima_temporada'] ?? null,
                    // convertir mejor_epoca a booleano si se proporciona
                    'mejor_epoca' => isset($data['clima_mejor_epoca']) ? (bool) $data['clima_mejor_epoca'] : null,
                    'temp_max_promedio' => $data['clima_temp_max_promedio'] ?? null,
                    'temp_min_promedio' => $data['clima_temp_min_promedio'] ?? null,
                    'recomendacion_vestimenta' => $data['clima_recomendacion_vestimenta'] ?? null,
                    'consideraciones_especiales' => $data['clima_consideraciones_especiales'] ?? null,
                    'estado' => $data['clima_estado'] ?? 'activa',
                ]
            );
        }

        // Guardar equipamiento (reemplaza los items para ese tipo de actividad si se envían)
        if (!empty($data['equipamiento_items'])) {
            // Separar por comas y limpiar espacios
            $items = array_filter(array_map('trim', explode(',', $data['equipamiento_items'])));
            // Normalizar categoría a lowercase para coincidir con enums en la BD
            $categoria = isset($data['equipamiento_categoria']) ? strtolower(trim($data['equipamiento_categoria'])) : null;
            $explicacion = $data['equipamiento_explicacion'] ?? null;
            // Borrar equipamiento previo para el tipo
            Equipamiento::where('tipo_actividad', $tipo)->delete();
            foreach ($items as $item) {
                Equipamiento::create([
                    'tipo_actividad' => $tipo,
                    'categoria' => $categoria,
                    'item' => $item,
                    'explicacion' => $explicacion,
                    'estado' => 'activa',
                ]);
            }
        }

        return redirect()->route('experiencias.index')->with('success', 'Experiencia creada correctamente');
    }

    public function index()
    {
        // Mostrar todas para admin, sólo activas para turistas
        if (session('admin_id')) {
            $experiencias = Experiencia::all();
        } else {
            $experiencias = Experiencia::where('estado', 'activa')->get();
        }
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
        // Cargar informacion climatica y equipamiento existente para mostrar en el formulario
        $clima = InformacionClimatica::where('tipo_experiencia', $experiencia->tipo_actividad)->first();
        $equip_items = Equipamiento::where('tipo_actividad', $experiencia->tipo_actividad)->pluck('item')->all();
        $equip_text = implode("\n", $equip_items);

        return view('experiencias.edit', compact('experiencia','comunidades','clima','equip_text'));
    }

    public function update(ExperienciaRequest $request, Experiencia $experiencia)
    {
        $data = $request->validated();
        $oldTipo = $experiencia->tipo_actividad;
        // Si se sube nueva imagen principal en la edición, guardar y reemplazar (mismo comportamiento que Comunidades)
        if ($request->hasFile('imagen_principal')) {
            $file = $request->file('imagen_principal');
            if (!$file->isValid()) {
                $errorMsg = 'Error al subir la imagen principal. Verifica el tamaño y formato.';
                return back()->withErrors(['imagen_principal' => $errorMsg])->withInput();
            }
            $folder = public_path('uploads/experiencias');
            if (!file_exists($folder)) mkdir($folder, 0755, true);
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
            $file->move($folder, $filename);
            $data['imagen_principal'] = '/uploads/experiencias/' . $filename;
        }

        $experiencia->update($data);

        $newTipo = $experiencia->tipo_actividad;

        // Actualizar informacion climatica según el tipo nuevo
        if (!empty($data['clima_temporada']) || !empty($data['clima_recomendacion_vestimenta'])) {
            InformacionClimatica::updateOrCreate(
                ['tipo_experiencia' => $newTipo],
                [
                    'temporada' => $data['clima_temporada'] ?? null,
                    'mejor_epoca' => isset($data['clima_mejor_epoca']) ? (bool) $data['clima_mejor_epoca'] : null,
                    'temp_max_promedio' => $data['clima_temp_max_promedio'] ?? null,
                    'temp_min_promedio' => $data['clima_temp_min_promedio'] ?? null,
                    'recomendacion_vestimenta' => $data['clima_recomendacion_vestimenta'] ?? null,
                    'consideraciones_especiales' => $data['clima_consideraciones_especiales'] ?? null,
                    'estado' => $data['clima_estado'] ?? 'activa',
                ]
            );
        }

        // Si cambió el tipo, eliminar equipamiento para el tipo antiguo
        if ($oldTipo && $oldTipo !== $newTipo) {
            Equipamiento::where('tipo_actividad', $oldTipo)->delete();
        }

        // Reemplazar equipamiento para el nuevo tipo si se enviaron items
        if (!empty($data['equipamiento_items'])) {
            $items = array_filter(array_map('trim', explode(',', $data['equipamiento_items'])));
            $categoria = isset($data['equipamiento_categoria']) ? strtolower(trim($data['equipamiento_categoria'])) : null;
            $explicacion = $data['equipamiento_explicacion'] ?? null;
            Equipamiento::where('tipo_actividad', $newTipo)->delete();
            foreach ($items as $item) {
                Equipamiento::create([
                    'tipo_actividad' => $newTipo,
                    'categoria' => $categoria,
                    'item' => $item,
                    'explicacion' => $explicacion,
                    'estado' => 'activa',
                ]);
            }
        }

        return redirect()->route('experiencias.index')->with('success', 'Experiencia actualizada');
    }

    public function desactivar(Experiencia $experiencia)
    {
        // Toggle estado between 'activa' and 'inactiva'
        $experiencia->estado = ($experiencia->estado === 'activa') ? 'inactiva' : 'activa';
        $experiencia->save();

        $msg = $experiencia->estado === 'activa' ? 'Experiencia activada' : 'Experiencia desactivada';
        return redirect()->route('experiencias.index')->with('success', $msg);
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
