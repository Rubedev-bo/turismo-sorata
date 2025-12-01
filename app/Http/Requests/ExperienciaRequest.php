<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienciaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'comunidad_id' => 'required|exists:comunidad,comunidad_id',
            'nombre' => 'required|string|max:150',
            // nueva imagen principal: requerida al crear, opcional al actualizar. Max 10240 KB (10 MB)
            'imagen_principal' => $this->isMethod('post') ? 'required|image|max:10240' : 'nullable|image|max:10240',
            'descripcion_corta' => 'nullable|string',
            'descripcion_completa' => 'nullable|string',
            'duracion_estimada' => 'nullable|string',
            'precio_bs' => 'required|numeric|min:0',
            // limitar tipo_actividad a los valores aceptados por el enum en la BD (usar minúsculas)
            'tipo_actividad' => 'required|string|in:trekking,hospedaje,cultural',
            'estado' => 'nullable|string|in:activa,inactiva',
            // Campos opcionales para información climática
            // Temporada es un user-defined enum en la BD; validar como string (se puede cambiar más adelante)
            'clima_temporada' => 'nullable|string',
            // Mejor época es boolean en la tabla: aceptar booleanos
            'clima_mejor_epoca' => 'nullable|boolean',
            'clima_temp_max_promedio' => 'nullable|numeric',
            'clima_temp_min_promedio' => 'nullable|numeric',
            'clima_recomendacion_vestimenta' => 'nullable|string',
            'clima_consideraciones_especiales' => 'nullable|string',
            'clima_estado' => 'nullable|string|in:activa,inactiva',
            // Equipamiento: textarea con items por línea y categoria opcional
            'equipamiento_categoria' => 'nullable|string|max:100',
            'equipamiento_items' => 'nullable|string',
        ];
    }

    protected function prepareForValidation()
    {
        // Normalizar tipo_actividad a minúsculas para que coincida con el enum de la BD
        if ($this->has('tipo_actividad')) {
            $this->merge([
                'tipo_actividad' => strtolower(trim($this->input('tipo_actividad'))),
            ]);
        }

        // Normalizar clima y mejor epoca
        if ($this->has('clima_temporada')) {
            $this->merge(['clima_temporada' => strtolower(trim($this->input('clima_temporada')))]);
        }
        if ($this->has('clima_mejor_epoca')) {
            $this->merge(['clima_mejor_epoca' => strtolower(trim($this->input('clima_mejor_epoca')))]);
        }
    }
}
