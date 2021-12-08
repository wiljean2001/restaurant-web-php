<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Dish_order;
use Exception;
use Illuminate\Http\Request;

class Dish_orderController extends Controller
{
    public function create(Request $request)
    {
        if (!$request->session()->has('tableID') && !$request->session()->has('orderId')) {
            return redirect()->route('menu-restaurant')
                ->with('error', 'Error, por favor genere una orden');
        }
        back()->with('tableID', $request->session()->get('tableID'));
        back()->with('orderId', $request->session()->get('orderId'));
        back()->with('client_id', $request->session()->get('client_id'));
        back()->with('waiter_id', $request->session()->get('waiter_id'));

        $dish_Order = null;
        $stock = Dish::find($request->id);
        if ($request->quantify <= $stock->stock && $request->quantify > 0) {
            // dd($stock);
            $dish_Order = Dish_order::create([
                'quantify' => $request->quantify,
                'price' => $request->quantify * $request->priceDish,
                'dish_id' => $request->id,
                'order_id' => $request->idOrder,
            ]);
            $stock->update([
                'stock' => $stock->stock - $request->quantify,
            ]);
            if ($dish_Order->save() && $stock->save()) {
                back()->with('message', 'Plato agregado a la orden correctamente');
            }
        } else {
            back()->with('error', 'Cantidad de solicitud no permitida.');
        }
        return redirect()->route('menu-restaurant');
        // ->with('dishOrder', $dish_Order->id);
    }
    public function update(Request $request)
    {
        if (!$request->session()->has('tableID') && !$request->session()->has('orderId')) {
            return redirect()->route('menu-restaurant')
                ->with('error', 'Error, por favor genere una orden');
        }
        back()->with('tableID', $request->session()->get('tableID'));
        back()->with('orderId', $request->session()->get('orderId'));
        back()->with('client_id', $request->session()->get('client_id'));
        back()->with('waiter_id', $request->session()->get('waiter_id'));

        // dd($request->idOrder);
        $dish_Order = null;
        $stock = Dish::find($request->idDiOrder);
        // dd($stock);
        if ($request->quantify <= $stock->stock && $request->quantify > 0) {
            $dish_Order = Dish_order::where('id', $request->idDiOrder)->first();
            $dish_Order->quantify = $request->quantify;
            $dish_Order->price = $request->quantify * $dish_Order->dishes->price;
            $stock->update([
                'stock' => $stock->stock - $request->quantify,
            ]);
            if ($dish_Order->save() && $stock->save()) {
                back()->with('message', 'Plato actualizado correctamente');
            }
        } else {
            back()->with('error', 'Cantidad de solicitud no permitida.');
        }
        // dd($dish_Order);
        if ($dish_Order->save()) {
            return redirect()->route('order.show')
                ->with('message-order', 'Plato actualizado correctamente')
                ->with('dishOrder', $dish_Order->id);
        }
    }
    public function destroy(Request $request)
    {
        if (!$request->session()->has('tableID') && !$request->session()->has('orderId')) {
            return redirect()->route('menu-restaurant')
                ->with('error', 'Error, por favor genere una orden');
        }
        back()->with('tableID', $request->session()->get('tableID'));
        back()->with('orderId', $request->session()->get('orderId'));
        back()->with('client_id', $request->session()->get('client_id'));
        back()->with('waiter_id', $request->session()->get('waiter_id'));

        // dd($request->idOrder);
        $dish_Order = Dish_order::where('id', $request->idDishO)->delete();

        // dd($dish_Order);
        if ($dish_Order) {
            return redirect()->route('order.show')
                ->with('message-order', 'Plato actualizado correctamente');
        }
    }
}



        // if ($request->session()->has('dishOrder')) {
        //     $d = $request->session()->get('dishOrder');
        //     // printf($dis);
        //     $dish_Order = Dish_order::create([
        //         'id' => $d,
        //         'quantify' => $request->quantify,
        //         'price' => $request->quantify * $request->priceDish,
        //         'dish_id' => $request->id,
        //         'order_id' => $request->idOrder,
        //     ]);
        //     if ($dish_Order->save()) {
        //         // dd($dish_Order);
        //         return redirect()->route('menu-restaurant')
        //             ->with('message', 'Plato agregado a la orden correctamente')
        //             ->with('dishOrder', $dish_Order->id);
        //     }
        // } else {
        //     $dish = Dish_order::select('id')->max('id');
        //     // dd($dish);
        //     if (!$dish) {
        //         $dish = 1;
        //         $dish_Order = Dish_order::create([
        //             'id' => $dish,
        //             'quantify' => $request->quantify,
        //             'price' => $request->quantify * $request->priceDish,
        //             'dish_id' => $request->id,
        //             'order_id' => $request->idOrder,
        //         ]);
        //         if ($dish_Order->save()) {
        //             return redirect()->route('menu-restaurant')
        //                 ->with('message', 'Plato agregado a la orden correctamente')
        //                 ->with('dishOrder', $dish_Order->id);
        //         }
        //     }