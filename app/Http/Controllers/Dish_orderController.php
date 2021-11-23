<?php

namespace App\Http\Controllers;

use App\Models\Dish_order;
use Exception;
use Illuminate\Http\Request;

class Dish_orderController extends Controller
{
    public function create(Request $request)
    {
        try {
            back()->with('tableID', '' . $request->session()->get('tableID'));
            back()->with('orderId', '' . $request->session()->get('orderId'));
            $dish_Order = new Dish_order();
            $dish_Order->quantify = $request->quantify;
            $dish_Order->price = $request->quantify * $request->priceDish;
            $dish_Order->dishID = $request->id;
            $dish_Order->orderID = $request->idOrder;
            if ($dish_Order->save()) {
                return redirect()->route('menu-restaurant')
                    ->with('message', 'Plato agregado a la orden correctamente');
            }
        } catch (Exception $exec) {
            return redirect()->route('menu-restaurant')
                ->with('error', 'Error, por favor genere una orden');
        }
    }
}
