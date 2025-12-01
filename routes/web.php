<?php

use Illuminate\Support\Facades\Route;


use App\Models\Comunidad;
use App\Models\Experiencia;
use App\Models\Reserva;

Route::get('/', function () {
    $reservas = Reserva::orderBy('created_at','desc')->take(6)->get();
    return view('inicio', compact('reservas'));
});

// Ruta de inicio para turistas (sin login)
Route::get('/inicio', function(){ return view('inicio'); })->name('inicio');

// Rutas de autenticacion para admin (login/logout)
Route::get('admin/login', [\App\Http\Controllers\AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('admin/login', [\App\Http\Controllers\AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('admin/logout', [\App\Http\Controllers\AdminAuthController::class, 'logout'])->name('admin.logout');
// Crear primer administrador (solo si no hay admins) - formulario y post
Route::get('admin/create-first', [\App\Http\Controllers\AdminAuthController::class, 'showCreateFirst'])->name('admin.createFirst');
Route::post('admin/create-first', [\App\Http\Controllers\AdminAuthController::class, 'storeCreateFirst'])->name('admin.createFirst.post');

// Rutas protegidas del admin (middleware por clase)
Route::prefix('admin')->middleware(\App\Http\Middleware\CheckAdminAuth::class)->group(function(){
    Route::get('/', [\App\Http\Controllers\AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('reservas', [\App\Http\Controllers\ReservaController::class, 'adminPanel'])->name('reservas.admin');
    Route::post('reservas/{reserva}/estado', [\App\Http\Controllers\ReservaController::class, 'updateEstado'])->name('reservas.updateEstado');
});

// Rutas para CRUD y acciones especificas
Route::resource('comunidades', \App\Http\Controllers\ComunidadController::class)->names('comunidades')->parameters(['comunidades' => 'comunidad']);
Route::get('comunidades/{comunidad}/desactivar', [\App\Http\Controllers\ComunidadController::class, 'desactivar'])->name('comunidades.desactivar');

Route::resource('experiencias', \App\Http\Controllers\ExperienciaController::class)->names('experiencias');
Route::get('experiencias/filter', [\App\Http\Controllers\ExperienciaController::class, 'filter'])->name('experiencias.filter');
Route::get('experiencias/{experiencia}/desactivar', [\App\Http\Controllers\ExperienciaController::class, 'desactivar'])->name('experiencias.desactivar');

Route::resource('reservas', \App\Http\Controllers\ReservaController::class)->only(['create','store','show'])->names('reservas');
Route::get('reservas/success/{id}', function($id){ return view('reservas.success', ['id' => $id]); })->name('reservas.success');

// (Las rutas administrativas para reservas están registradas bajo el prefijo `admin` protegido por middleware.)


