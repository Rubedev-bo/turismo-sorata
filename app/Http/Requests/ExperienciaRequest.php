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
            'imagen_principal' => 'nullable|string',
            'descripcion_corta' => 'nullable|string',
            'descripcion_completa' => 'nullable|string',
            'duracion_estimada' => 'nullable|string',
            'precio_bs' => 'required|numeric|min:0',
            'tipo_actividad' => 'required|string',
            'estado' => 'nullable|string|in:activa,inactiva',
        ];
    }
}
