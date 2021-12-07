<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Dish;
use App\Models\Drink;
use App\Models\Order;
use App\Models\Spirit;
use App\Models\Table;
use App\Models\Dish_order;
use App\Models\Drink_order;
use App\Models\Image;
use App\Models\Mozo;
use App\Models\Spirit_order;
use App\Models\Waiter;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $tables = Table::where('state', false)->get();
        $dishes = Dish::paginate(6);
        $drinks = Drink::paginate(6);
        $spirits = Spirit::paginate(6);
        $waiters = Waiter::all();
        $recomend = Image::inRandomOrder()->get(); // Recomendacion de plato aleatorio
        // Name end-order -> finaliza la orden
        if ($request->endOrder) {
            // Vuelve a la tabla al estado disponible
            Table::where('id', $request->session()->get('tableID'))
                ->update([
                    'state' => false
                ]);
            Order::where('id', $request->session()->get('orderId'))
                ->update([
                    'finalized' => true
                ]);
            // alerta al mesero que se finalizo una orden.
            $request->session()->forget('orderId');
            $request->session()->forget('tableID');
            back()->with('message-order', 'Orden finalizada exitosamente!.');
            return view('orders.index', compact('dishes', 'drinks', 'spirits', 'tables', 'recomend'));
        }

        back()->with('orderId', $request->session()->get('orderId'));
        back()->with('tableID', $request->session()->get('tableID'));
        back()->with('client_id', $request->session()->get('client_id'));
        back()->with('waiter_id', $request->session()->get('waiter_id'));
        return view('orders.index', compact('dishes', 'drinks', 'spirits', 'tables', 'waiters', 'recomend'));
    }

    // Metodo para generar
    public function create(Request $request)
    {
        // return redirect()->route('menu-restaurant');
        back()->with(
            'error-order',
            'Datos obligatorios: Mesero, nombre del cliente y seleccionar una mesa.'
        );
        $request->validate([
            'idTable' => 'required',
            'name_client' => 'required',
            'waiter_id' => 'required',
        ]);
        $clients = Client::create([
            'dni' => $request->dni_client,
            'ruc' => $request->ruc_client,
            'name' => $request->name_client,
        ]);
        $orders = Order::create([
            'hour'        => date('h:i:s'),
            'date'        => date('y-m-d h:i:s'),
            'table_id'  => $request->idTable,
            'client_id' => $clients->id,
            'waiter_id' => $request->waiter_id
        ]);
        Table::where('id', $request->idTable)
            ->update([
                'state' => true,
            ]);

        if ($orders->save() && $clients->save()) {
            back()->with('message-order', 'Orden generada exitosamente!.');
            $request->session()->forget('error-order');
        } else {
            back()->with('error-order', 'No se pudo generar orden.');
        }
        return redirect()->route('menu-restaurant')
            ->with('orderId', $orders->id)
            ->with('tableID', $request->idTable)
            ->with('client_id', $clients->id)
            ->with('waiter_id', $request->waiter_id);
    }
    // , $idTable
    public function show(Request $request)
    {
        if (!$request->session()->has('tableID') && !$request->session()->has('orderId')) {
            return redirect()->route('menu-restaurant')
                ->with('error-order', 'Por favor genere una orden.');
        }
        // Obtenemos la cabecera y la configuracion de la tabla
        $headsFood = $this->getHeadsFood();
        $config = $this->getConfig();
        // Eloquent: Relationships 
        $dishes_o = Order::with('dish_Orders.dishes')
            ->where('table_id', $request->session()->get('tableID'))
            ->where('id', $request->session()->get('orderId'))->get();

        $drinks_o = Order::with('drink_Orders.drinks')
            ->where('table_id', $request->session()->get('tableID'))
            ->where('id', $request->session()->get('orderId'))->get();

        $spirits_o = Order::with('spirit_Orders.spirits')
            ->where('table_id', $request->session()->get('tableID'))
            ->where('id', $request->session()->get('orderId'))->get();

        $table = Table::select('num_table')->where('id', $request->session()->get('tableID'))->get();
        // $table = $table->num_table;
        back()->with('orderId', $request->session()->get('orderId'));
        back()->with('tableID', $request->session()->get('tableID'));
        back()->with('client_id', $request->session()->get('client_id'));
        back()->with('waiter_id', $request->session()->get('waiter_id'));
        $total = null;
        foreach ($dishes_o as $value) {
            foreach ($value->dish_Orders as $dishO) {
                $total += $dishO->price;
            }
        }
        foreach ($drinks_o as $value) {
            foreach ($value->drink_Orders as $drinkO) {
                $total += $drinkO->price;
            }
        }
        foreach ($spirits_o as $value) {
            foreach ($value->spirit_Orders as $spiritO) {
                $total += $spiritO->price;
            }
        }
        $mozo = Waiter::where('id', $dishes_o[0]->waiter_id)->get();
        // dd();
        return view(
            'orders.show',
            compact(
                'dishes_o',
                'drinks_o',
                'spirits_o',
                'table',
                'headsFood',
                'config',
                'mozo',
                'total'
            )
        );
    }
    public function edit(Request $request)
    {
        if (!$request->session()->has('tableID') && !$request->session()->has('orderId')) {
            back()->with('error-order', 'Por favor genere una orden.');
            return redirect()->route('menu-restaurant');
        }
        $headsFood = $this->getHeadsFood();
        $config = $this->getConfig();
        // Eloquent: Relationships 
        $dishes_o = Order::with('dish_Orders.dishes')
            ->where('table_id', $request->session()->get('tableID'))
            ->where('id', $request->session()->get('orderId'))->get();

        $drinks_o = Order::with('drink_Orders.drinks')
            ->where('table_id', $request->session()->get('tableID'))
            ->where('id', $request->session()->get('orderId'))->get();

        $spirits_o = Order::with('spirit_Orders.spirits')
            ->where('table_id', $request->session()->get('tableID'))
            ->where('id', $request->session()->get('orderId'))->get();

        $total = null;
        foreach ($dishes_o as $value) {
            foreach ($value->dish_Orders as $dishO) {
                $total += $dishO->price;
            }
        }
        foreach ($drinks_o as $value) {
            foreach ($value->drink_Orders as $drinkO) {
                $total += $drinkO->price;
            }
        }
        foreach ($spirits_o as $value) {
            foreach ($value->spirit_Orders as $spiritO) {
                $total += $spiritO->price;
            }
        }

        back()->with('orderId', $request->session()->get('orderId'));
        back()->with('tableID', $request->session()->get('tableID'));
        back()->with('client_id', $request->session()->get('client_id'));
        back()->with('waiter_id', $request->session()->get('waiter_id'));

        return view('orders.update', compact('dishes_o', 'drinks_o', 'spirits_o', 'total', 'headsFood', 'config'));
    }

    public function update(Request $request)
    {
    }

    public function destroy(Request $request)
    {
    }

    public function delete(Request $request)
    {
        if (!$request->session()->has('tableID') && !$request->session()->has('orderId')) {
            back()->with('error-order', 'Por favor genere una orden.');
            return redirect()->route('menu-restaurant');
        }
        $headsFood = $this->getHeadsFood();
        $config = $this->getConfig();
        // Eloquent: Relationships 
        $dishes_o = Order::with('dish_Orders.dishes')
            ->where('table_id', $request->session()->get('tableID'))
            ->where('id', $request->session()->get('orderId'))->get();

        $drinks_o = Order::with('drink_Orders.drinks')
            ->where('table_id', $request->session()->get('tableID'))
            ->where('id', $request->session()->get('orderId'))->get();

        $spirits_o = Order::with('spirit_Orders.spirits')
            ->where('table_id', $request->session()->get('tableID'))
            ->where('id', $request->session()->get('orderId'))->get();

        $total = null;
        foreach ($dishes_o as $value) {
            foreach ($value->dish_Orders as $dishO) {
                $total += $dishO->price;
            }
        }
        foreach ($drinks_o as $value) {
            foreach ($value->drink_Orders as $drinkO) {
                $total += $drinkO->price;
            }
        }
        foreach ($spirits_o as $value) {
            foreach ($value->spirit_Orders as $spiritO) {
                $total += $spiritO->price;
            }
        }

        back()->with('orderId', $request->session()->get('orderId'));
        back()->with('tableID', $request->session()->get('tableID'));
        back()->with('client_id', $request->session()->get('client_id'));
        back()->with('waiter_id', $request->session()->get('waiter_id'));

        return view('orders.delete', compact('dishes_o', 'drinks_o', 'spirits_o', 'total', 'headsFood', 'config'));
    }

    public function ordersNew(Request $request, $order_id = 0)
    {
        $ordersNow = null;
        $orders = Order::where('finalized', true)
            ->where('delivered', false)
            ->get();

        if ($order_id != 0) {
            $ordersNow = Order::where('id', $order_id)
                ->where('delivered', false)
                ->where('finalized', true)
                ->get();
            // dd($ordersNow);
        }
        // dd($num_pedidos);
        $heads = $this->getHeadsFoodForOrdersDish();
        $config = $this->getConfig();
        return view(
            'admin.orders.index',
            compact(
                'heads',
                'config',
                'orders',
                'ordersNow',
            )
        );
    }
    public function ordersNewDelivered(Request $request, $order_id = 0)
    {
        $ordersNow = null;
        $orders = Order::where('delivered', true)->get();

        if ($order_id != 0) {
            $ordersNow = Order::where('id', $order_id)
                ->where('delivered', true)
                ->get();
            // dd($ordersNow);
        }
        // dd($num_pedidos);
        $heads = $this->getHeadsFoodForOrdersDish();
        $config = $this->getConfig();
        return view(
            'admin.orders.show',
            compact(
                'heads',
                'config',
                'orders',
                'ordersNow',
            )
        );
    }
    public function ordersNewFin(Request $request)
    {
        Order::where('finalized', true)
            ->where('id', $request->order_id)
            ->update([
                'delivered' => true,
            ]);
        return redirect()->route('orders.new.now', $request->order_id);
    }

    private function getHeadsFood()
    {
        return $heads = [
            ['label' => 'Id', 'width' => 0],
            'Total S/',
            'Cantidad Und.',
            'Plato',
            ['label' => 'Descripcion', 'width' => 40],
            ['label' => 'Precio Und.', 'width' => 0],
            ['label' => '', 'width' => 0],
            // ['label' => 'Cantidad', 'width' => 10],
            // ['label' => 'Mesa', 'width' => 3],
        ];
    }
    private function getHeadsFoodForOrdersDish()
    {
        return $heads = [
            ['label' => 'Tipo', 'width' => 15],
            ['label' => 'Cantidad', 'width' => 4],
            ['label' => 'Precio', 'width' => 4],
        ];
    }
    private function getConfig()
    {
        return $config = [
            "lengthMenu" => [
                [10, 25, 50, -1],
                ['10 Resultados', '25 Resultados', '50 Resultados', 'Motrar Todos'],
            ],
            "language" => [
                // "pageLength" => "Mostrar %d Registros",
                "lengthMenu" => "Ver _MENU_",
                "search" => "Buscar",
                "zeroRecords" => "Sin resultados",
                "info" => "Página _PAGE_ de _PAGES_",
                "infoEmpty" => "No hay registros disponibles",
                "infoFiltered" => "(filtrado de _MAX_ registros totales)",
                "paginate" => [
                    "previous" => '<i class="fa fa-angle-left"></i><span class="sr-only">Previous</span>',
                    "next" => '<i class="fa fa-angle-right"></i><span class="sr-only">Next</span>',
                ],
            ],
            'columns' => [
                null,
                null,
                null,
            ],
        ];
    }
}
