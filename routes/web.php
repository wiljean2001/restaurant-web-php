<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', [OrderController::class, 'index'])->name('menu-restaurant');
Route::post('pedido/registrar', [OrderController::class, 'store'])->name('order.dish.store');
