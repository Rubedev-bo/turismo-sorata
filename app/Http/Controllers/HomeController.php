<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experiencia;

class HomeController extends Controller
{
    public function index()
    {
        $experiencias = Experiencia::where('estado','activa')->get();
        return view('pages.home', compact('experiencias'));
    }
}
