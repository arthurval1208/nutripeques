<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\FirebaseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Página principal pública
Route::view('/', 'index')->name('inicio');

// Página de contacto pública
Route::view('Contacto', 'contacto')->name('contacto');
Route::post('guardar-contacto', [ContactController::class, 'store']);


// -------------------------------------------------------
// RUTAS PROTEGIDAS POR LOGIN
// -------------------------------------------------------
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Lista de usuarios
    Route::get('Usuarios', [HomeController::class, 'users']);

    // Mensajes enviados desde contacto
    Route::get('leer-contactos', [ContactController::class, 'index']);

    // CRUD Servicios
    Route::resource('servicios', ServicioController::class);

    Route::delete('/mensajes/{id}', [MensajeController::class, 'destroy'])->name('mensajes.destroy');

    Route::patch('/mensajes/{id}/read', [MensajeController::class, 'markAsRead'])->name('mensajes.read');

    // Esta ruta servirá para ver los datos
    //Route::get('/ver-usuarios', [FirebaseController::class, 'index']);

    Route::get('/crear-usuario', [FirebaseController::class, 'crear']);
    Route::post('/guardar-usuario', [FirebaseController::class, 'store']);

    // Rutas de Servicios
    Route::get('/crear-servicio', [FirebaseController::class, 'crearServicio']);
    Route::post('/guardar-servicio', [FirebaseController::class, 'storeServicio']);

    // Rutas de Contacto
    Route::get('/crear-contacto', [FirebaseController::class, 'crearContacto']);
    Route::post('/guardar-contacto', [FirebaseController::class, 'storeContacto']);


});


// Autenticación
Auth::routes();
