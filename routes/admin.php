<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SpiritController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

Route::get('', function () {
    // return view('admin');
    return view('admin');
})->name('admin.auth');

Route::get('registrar-usuario', [RegisteredUserController::class, 'create'])
    ->middleware(['guest:' . config('fortify.guard'), 'can:admin.roles'])
    ->name('register-user');
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
// Route::get('platos/editar/{dishID}', [DishController::class, 'editIn'])->name('dish.update.dishID');
Route::put('platos/actualizar', [DishController::class, 'update'])->name('dish.update');
// drink routes
Route::get('bebida/registrar', [DrinkController::class, 'create'])->name('drink.create');
Route::get('bebida/buscar', [DrinkController::class, 'index'])->name('drink.search');
Route::post('bebidas', [DrinkController::class, 'store'])->name('drink.store');
Route::get('bebidas/eliminar', [DrinkController::class, 'delete'])->name('drink.delete');
Route::post('bebidas/eliminar', [DrinkController::class, 'destroy'])->name('drink.distroy');
Route::get('bebidas/editar', [DrinkController::class, 'edit'])->name('drink.edit');
Route::post('bebidas/editar', [DrinkController::class, 'update'])->name('drink.update');

///licores
Route::get('licor/registrar', [SpiritController::class, 'create'])->name('spirit.create');
Route::get('licor/buscar', [SpiritController::class, 'index'])->name('spirit.search');
Route::post('licores', [SpiritController::class, 'store'])->name('spirit.store');
Route::get('licores/eliminar', [SpiritController::class, 'delete'])->name('spirit.delete');
Route::post('licores/eliminar', [SpiritController::class, 'destroy'])->name('spirit.distroy');
Route::get('licores/editar', [SpiritController::class, 'edit'])->name('spirit.edit');
Route::post('licores/editar', [SpiritController::class, 'update'])->name('spirit.update');


//mesas

Route::get('mesas/gestionar', [TableController::class, 'index'])->name('table.index');
Route::post('mesas/actualizar', [TableController::class, 'update'])->name('table.update');
Route::post('mesas/eliminar', [TableController::class, 'delete'])->name('table.delete');
Route::post('mesas/registrar', [TableController::class, 'create'])->name('table.create');


// roles
Route::get('roles/mostrar', [RoleController::class, 'index'])->middleware('can:admin.roles')->name('role.show');
Route::post('roles/actualizar', [RoleController::class, 'update'])->middleware('can:admin.roles')->name('role.update');
// ignorar
// Route::get('prueba/perfil', function(){
//     return view('profile');    
// });