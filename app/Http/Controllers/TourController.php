<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experiencia;

class TourController extends Controller
{
    public function index()
    {
        $experiencias = Experiencia::where('estado','activa')->get();
        return view('pages.tours', compact('experiencias'));
    }
}
