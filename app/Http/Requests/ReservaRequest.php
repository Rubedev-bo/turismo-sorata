<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'comunidad_id' => 'nullable|exists:comunidad,comunidad_id',
            'experiencia_id' => 'required|exists:experiencia,experiencia_id',
            'fecha_experiencia' => 'required|date|after_or_equal:today',
            'numero_adultos' => 'required|integer|min:0',
            'numero_ninos' => 'nullable|integer|min:0',
            'nombre_completo' => 'required|string|max:200',
            'email' => 'required|email|max:200',
            'telefono' => 'required|string|max:50',
            'tipo_habitacion' => 'nullable|in:Simple,Doble,Triple',
            'servicios' => 'nullable|array',
            'servicios.*' => 'string|max:100',
            'terminos' => 'accepted',
        ];
    }
}
