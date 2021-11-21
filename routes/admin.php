<?php

use App\Http\Controllers\DishController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('', function () {
    // return view('admin');
    return view('admin');
});
// Route::get('pestañas', function () {
//     return view('adminIFrame');
// });

Route::get('menu', [OrderController::class, 'index'])->name('order.index');
// dish routes
Route::get('plato/registrar', [DishController::class, 'create'])->name('dish.create');
Route::get('plato/buscar', [DishController::class, 'index'])->name('dish.search');
Route::post('platos', [DishController::class, 'store'])->name('dish.store');
Route::get('platos/eliminar', [DishController::class, 'delete'])->name('dish.delete');
Route::post('platos/eliminar', [DishController::class, 'destroy'])->name('dish.distroy');
Route::get('platos/editar', [DishController::class, 'edit'])->name('dish.edit');
Route::post('platos/editar', [DishController::class, 'update'])->name('dish.update');
// drink routes
Route::get('bebida/registrar', [DrinkController::class, 'create'])->name('drink.create');
Route::get('bebida/buscar', [DrinkController::class, 'index'])->name('drink.search');
Route::post('bebidas', [DrinkController::class, 'store'])->name('drink.store');
Route::get('bebidas/eliminar', [DrinkController::class, 'delete'])->name('drink.delete');
Route::post('bebidas/eliminar', [DrinkController::class, 'destroy'])->name('drink.distroy');
Route::get('bebidas/editar', [DrinkController::class, 'edit'])->name('drink.edit');
Route::post('bebidas/editar', [DrinkController::class, 'update'])->name('drink.update');

// plato/registrar