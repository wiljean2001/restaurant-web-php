<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SpiritController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\WaiterController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

Route::get('', function () {
    return redirect()->route('order.index');
})->name('admin.auth');

Route::get('menu', [OrderController::class, 'index'])->name('order.index');
// Dish  routes
Route::get('plato/registrar', [DishController::class, 'create'])->name('dish.create');
Route::get('plato/buscar', [DishController::class, 'index'])->name('dish.search');
Route::post('platos', [DishController::class, 'store'])->name('dish.store');
Route::get('platos/eliminar', [DishController::class, 'delete'])->name('dish.delete');
Route::post('platos/eliminar', [DishController::class, 'destroy'])->name('dish.distroy');
Route::get('platos/editar', [DishController::class, 'edit'])->name('dish.edit');
// Route::get('platos/editar/{dishID}', [DishController::class, 'editIn'])->name('dish.update.dishID');
Route::put('platos/actualizar', [DishController::class, 'update'])->name('dish.update');
// Drink routes
Route::get('bebida/registrar', [DrinkController::class, 'create'])->name('drink.create');
Route::get('bebida/buscar', [DrinkController::class, 'index'])->name('drink.search');
Route::post('bebidas', [DrinkController::class, 'store'])->name('drink.store');
Route::get('bebidas/eliminar', [DrinkController::class, 'delete'])->name('drink.delete');
Route::post('bebidas/eliminar', [DrinkController::class, 'destroy'])->name('drink.distroy');
Route::get('bebidas/editar', [DrinkController::class, 'edit'])->name('drink.edit');
Route::post('bebidas/editar', [DrinkController::class, 'update'])->name('drink.update');

///Spirits
Route::get('licor/registrar', [SpiritController::class, 'create'])->name('spirit.create');
Route::get('licor/buscar', [SpiritController::class, 'index'])->name('spirit.search');
Route::post('licores', [SpiritController::class, 'store'])->name('spirit.store');
Route::get('licores/eliminar', [SpiritController::class, 'delete'])->name('spirit.delete');
Route::post('licores/eliminar', [SpiritController::class, 'destroy'])->name('spirit.distroy');
Route::get('licores/editar', [SpiritController::class, 'edit'])->name('spirit.edit');
Route::post('licores/editar', [SpiritController::class, 'update'])->name('spirit.update');


//Tables
Route::get('mesas/gestionar', [TableController::class, 'index'])->name('table.index');
Route::post('mesas/actualizar', [TableController::class, 'update'])->name('table.update');
Route::post('mesas/eliminar', [TableController::class, 'delete'])->name('table.delete');
Route::post('mesas/registrar', [TableController::class, 'create'])->name('table.create');

// Roles
Route::get('roles/mostrar', [RoleController::class, 'index'])->middleware('can:admin.roles')->name('role.show');
Route::post('roles/actualizar', [RoleController::class, 'update'])->middleware('can:admin.roles')->name('role.update');

// Orders
Route::get('pedidos/nuevos', [OrderController::class, 'ordersNew'])->name('orders.new');
Route::get('pedidos/nuevos/{order_id}', [OrderController::class, 'ordersNew'])->name('orders.new.now');
Route::post('pedidos/nuevos', [OrderController::class, 'ordersNewFin'])->name('orders.new.now.final');

// Orders finalized
Route::get('pedidos/entregados', [OrderController::class, 'ordersNewDelivered'])->name('orders.show');
Route::get('pedidos/entregados/{order_id}', [OrderController::class, 'ordersNewDelivered'])->name('orders.show.now');
// Waiters
Route::get('mozo/gestionar', [WaiterController::class, 'index'])->middleware('can:admin.roles')->name('waiter.index');
Route::post('mozo/registrar', [WaiterController::class, 'store'])->name('waiter.register');
Route::post('mozo/actualizar', [WaiterController::class, 'update'])->name('waiter.update');
Route::post('mozo/eliminar', [WaiterController::class, 'destroy'])->name('waiter.delete');

// Registrar usuarios
Route::get('registrar-usuario', [UserController::class, 'create'])
    ->middleware('can:admin.roles')
    ->name('register-user');
// ignorar
// Route::get('prueba/perfil', function(){
//     return view('profile');    
// });