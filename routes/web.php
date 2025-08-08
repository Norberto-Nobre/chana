<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


// ROTAS DO SITE
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::view('/', 'pages.index');

Route::view('mycount', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('about', 'about')
    ->name('about');
Route::view('carros', 'carros')
    ->name('carros');
Route::view('contacto', 'contacto')
    ->name('contacto');
Route::view('carro-detalhes', 'carro-detalhes')
    ->name('carro-detalhes');
Route::view('reserva-detalhes', 'reserva-detalhes')
    ->name('reserva-detalhes');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
