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

        back()->with('tableID', '' . $request->session()->get('tableID'));
        back()->with('orderId', '' . $request->session()->get('orderId'));
        $drink_Order = new Drink_order();
        $drink_Order->quantify = $request->quantify;
        $drink_Order->price = $request->quantify * $request->priceDrink;
        //    priceSpirit
        $drink_Order->drink_id = $request->id;
        $drink_Order->order_id = $request->idOrder;
        if ($drink_Order->save()) {
            back()->with('message', 'Bebida agregada al pedido correctamente');
            return redirect()->route('menu-restaurant');
        }
    }
}
