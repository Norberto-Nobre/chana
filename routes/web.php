<?php

use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservaController;
use App\Livewire\CarroDetalhes;
use Illuminate\Support\Facades\Auth;

Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('logout');


// ROTAS DO SITE
Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/about', [FrontController::class, 'about'])->name('front.about');
Route::get('/cars', [FrontController::class, 'cars'])->name('front.cars');
Route::get('/contact', [FrontController::class, 'contact'])->name('front.contact');
Route::get('/car-details/{vehicle:id}', [FrontController::class, 'details'])->name('front.details');

// Route::post('/reserva-detalhes', [FrontController::class, 'reservaDetalhes'])->name('reserva.detalhes');

// routes/web.php
Route::get('/reserva-detalhes', [ReservaController::class, 'detalhes'])->name('reserva.detalhes');
Route::post('/confirmar', [ReservaController::class, 'confirmar'])->name('reserva.confirmar');

Route::get('/success', [ReservaController::class, 'success'])->name('reserva.success');


Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

require __DIR__.'/auth.php';
