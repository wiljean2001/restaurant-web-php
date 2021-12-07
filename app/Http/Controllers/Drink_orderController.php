<?php

namespace App\Http\Controllers;

use App\Models\Drink_order;
use Exception;
use Illuminate\Http\Request;

class Drink_orderController extends Controller
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

        $drink_Order = Drink_order::create([
            'quantify' => $request->quantify,
            'price' => $request->quantify * $request->priceDrink,
            'drink_id' => $request->id,
            'order_id' => $request->idOrder,
        ]);
        if ($drink_Order->save()) {
            return redirect()->route('menu-restaurant')
                ->with('message', 'Bebida agregado a la orden correctamente')
                ->with('drinkOrder', $drink_Order->id);
        }
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
        $drink_Order = Drink_order::where('id', $request->idDrOrder)->first();
        $drink_Order->quantify = $request->quantify;
        $drink_Order->price = $request->quantify * $drink_Order->drinks->price;

        // dd($dish_Order);
        if ($drink_Order->save()) {
            return redirect()->route('order.show')
                ->with('message-order', 'Plato actualizado correctamente')
                ->with('dishOrder', $drink_Order->id);
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
        $drink_Order = Drink_order::where('id', $request->idDrinkO)->delete();

        // dd($dish_Order);
        if ($drink_Order) {
            return redirect()->route('order.show')
                ->with('message-order', 'Plato actualizado correctamente');
        }
    }
}
