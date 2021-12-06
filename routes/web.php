<?php

use App\Http\Controllers\Dish_orderController;
use App\Http\Controllers\Drink_orderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Spirit_orderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Order routes
Route::get('/', [OrderController::class, 'index'])->name('menu-restaurant');
Route::post('/', [OrderController::class, 'create'])->name('order.create');
Route::get('orden/mostrar', [OrderController::class, 'show'])->name('order.show');
Route::get('orden/actualizar', [OrderController::class, 'edit'])->name('order.edit');
Route::get('orden/eliminar', [OrderController::class, 'delete'])->name('order.delete');
// Route::post('/', [OrderController::class, 'create'])->name('order.create');

Route::post('pedido/registrar/plato', [Dish_orderController::class, 'create'])->name('dish.orders.store');
Route::post('pedido/registrar/bebida', [Drink_orderController::class, 'create'])->name('drink.orders.store');
Route::post('pedido/registrar/licor', [Spirit_orderController::class, 'create'])->name('spirit.orders.store');

Route::post('realizar-pedido', [OrderController::class, 'create'])->name('register.client');