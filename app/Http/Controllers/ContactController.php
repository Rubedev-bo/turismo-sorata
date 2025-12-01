<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email',
            'telefono' => 'required|numeric',
            'mensaje' => 'required|string|max:1000',
            'personas' => 'nullable|integer|min:1|max:20',
        ]);

        // Aquí puedes guardar la consulta en DB o enviar un email.

        return back()->with('success','Tu consulta ha sido enviada. Gracias.');
    }
}
