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
        // back()->with('dishOrder', $request->session()->get('dishOrder'));
        back()->with('orderId', $request->session()->get('orderId'));

        if ($request->session()->get('dishOrder') != '') {
            $d = $request->session()->get('dishOrder');
            // printf($dis);
            $drink_Order = Drink_order::create([
                'id' => $d,
                'quantify' => $request->quantify,
                'price' => $request->quantify * $request->priceDish,
                'dish_id' => $request->id,
                'order_id' => $request->idOrder,
            ]);
            if ($drink_Order->save()) {
                // dd($dish_Order);
                return redirect()->route('menu-restaurant')
                    ->with('message', 'Bebida agregado a la orden correctamente')
                    ->with('dishOrder', $drink_Order->id);
            }
        } else {
            $drink = Drink_order::select('id')->max('id');
            // dd($dish);
            if (!$drink) {
                $drink = 1;
                $drink_Order = Drink_order::create([
                    'id' => $drink,
                    'quantify' => $request->quantify,
                    'price' => $request->quantify * $request->priceDish,
                    'dish_id' => $request->id,
                    'order_id' => $request->idOrder,
                ]);
                if ($drink_Order->save()) {
                    return redirect()->route('menu-restaurant')
                        ->with('message', 'Bebida agregado a la orden correctamente')
                        ->with('dishOrder', $drink_Order->id);
                }
            }
            foreach ($drink as $d) {
                $drink_Order = Drink_order::create([
                    'id' => ($d->id) + 1,
                    'quantify' => $request->quantify,
                    'price' => $request->quantify * $request->priceDish,
                    'dish_id' => $request->id,
                    'order_id' => $request->idOrder,
                ]);
                if ($drink_Order->save()) {
                    return redirect()->route('menu-restaurant')
                        ->with('message', 'Bebida agregado a la orden correctamente')
                        ->with('dishOrder', $drink_Order->id);
                }
            }
        }
    }
}
