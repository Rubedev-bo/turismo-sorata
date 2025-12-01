<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComunidadRequest extends FormRequest
{
    public function authorize()
    {
        // permitir la autorización en controlador/middleware
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:100',
            'imagen_representativa' => 'nullable|string',
            'descripcion' => 'nullable|string',
            'contacto_email' => 'nullable|email|max:100',
            'contacto_telefono' => 'nullable|string|max:30',
            'punto_partida_sorata' => 'nullable|string|max:200',
            'dificultad_acceso' => 'nullable|string',
            'recomendaciones_acceso' => 'nullable|string',
            'estado' => 'nullable|string|in:activa,inactiva',
        ];
    }
}
