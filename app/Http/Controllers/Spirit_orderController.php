<?php

namespace App\Http\Controllers;

use App\Models\Spirit;
use App\Models\Spirit_order;
use Exception;
use Illuminate\Http\Request;

class Spirit_orderController extends Controller
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

        $spirit_Order = null;
        $stock = Spirit::find($request->id);
        if ($request->quantify <= $stock->stock && $request->quantify > 0) {
            $spirit_Order = Spirit_order::create([
                'quantify' => $request->quantify,
                'price' => $request->quantify * $request->priceSpirit,
                'spirit_id' => $request->id,
                'order_id' => $request->idOrder,
            ]);
            $stock->update([
                'stock' => $stock->stock - $request->quantify,
            ]);
            if ($spirit_Order->save() && $stock->save()) {
                back()->with('message', 'Licor agregado a la orden correctamente.');
            }
        } else {
            back()->with('error', 'Cantidad de solicitud no permitida.');
        }

        return redirect()->route('menu-restaurant');
        // ->with('message', 'Bebida agregado a la orden correctamente')
        // ->with('spiritOrder', $spirit_Order->id);

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
        $spirit_Order = null;
        $stock = Spirit::find($request->idSpOrder);
        if ($request->quantify <= $stock->stock && $request->quantify > 0) {
            $spirit_Order = Spirit_order::where('id', $request->idSpOrder)->first();
            $spirit_Order->quantify = $request->quantify;
            $spirit_Order->price = $request->quantify * $spirit_Order->spirits->price;

            $stock->update([
                'stock' => $stock->stock - $request->quantify,
            ]);
            if ($spirit_Order->save() && $stock->save()) {
                back()->with('message', 'Licor actualizado correctamente.');
            }
        } else {
            back()->with('error', 'Cantidad de solicitud no permitida.');
        }
        // dd($dish_Order);
        return redirect()->route('order.show');
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
        $spirit_Order = Spirit_order::where('id', $request->idSpiritO)->delete();

        // dd($dish_Order);
        if ($spirit_Order) {
            return redirect()->route('order.show')
                ->with('message-order', 'Plato actualizado correctamente');
        }
    }
}
