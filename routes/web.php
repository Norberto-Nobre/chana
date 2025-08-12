<?php

use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservaController;
use App\Livewire\CarroDetalhes;


// ROTAS DO SITE
Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/car-details/{vehicle:id}', [FrontController::class, 'details'])->name('front.details');

Route::post('/reserva-detalhes', [FrontController::class, 'reservaDetalhes'])->name('reserva.detalhes');

// routes/web.php
// Route::get('/reserva-detalhes', [ReservaController::class, 'detalhes'])->name('reserva.detalhes');
Route::post('/reservar', [ReservaController::class, 'store'])->name('reserva.store');


require __DIR__.'/auth.php';
