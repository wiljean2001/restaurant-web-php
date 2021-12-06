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
use App\Models\Mozo;
use App\Models\Spirit_order;
use App\Models\Waiter;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $tables = Table::all();
        $dishes = Dish::paginate(6);
        $drinks = Drink::paginate(6);
        $spirits = Spirit::paginate(6);
        $waiters = Waiter::all();
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
            return view('orders.index', compact('dishes', 'drinks', 'spirits', 'tables'));
        }

        back()->with('orderId', $request->session()->get('orderId'));
        back()->with('tableID', $request->session()->get('tableID'));
        return view('orders.index', compact('dishes', 'drinks', 'spirits', 'tables', 'waiters'));
    }

    // Metodo para generar
    public function create(Request $request)
    {
        // return redirect()->route('menu-restaurant');
        back()->with('error-order', 'Datos obligatorios: Mesero, nombre del cliente y seleccionar una mesa.');
        $request->validate([
            'idTable' => 'required',
            'name_client' => 'required',
            'waiter_id' => 'required',
        ]);
        // $table->state = true;
        // Table::where('id', $request->idTable)
        //     ->update([
        //         'state' => true
        //     ]);
        // Generar orden
        $clients = Client::create([
            'dni' => $request->dni_client,
            'ruc' => $request->ruc_client,
            'name' => $request->name_client,
        ]);
        $orders = Order::create([
            'date'        => date('Y-m-d h:i:s'),
            'table_id'  => $request->idTable,
            'client_id' => $clients->id,
            'waiter_id' => $request->waiter_id
        ]);

        $orders->tables->state = true;

        if ($orders->save() && $clients->save()) {
            back()->with('message-order', 'Orden generada exitosamente!.');
            $request->session()->forget('error-order');
        } else {
            back()->with('error-order', 'No se pudo generar orden.');
        }
        return redirect()->route('menu-restaurant')
            ->with('orderId', '' . $orders->id)
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
        // dd($table);
        return view('orders.show', compact('dishes_o', 'drinks_o', 'spirits_o', 'table', 'headsFood', 'config'));
    }
    public function edit(Request $request)
    {
        if (!$request->session()->has('tableID') && !$request->session()->has('orderId')) {
            back()->with('error-order', 'Por favor genere una orden.');
            return redirect()->route('menu-restaurant');
        }
        $Order = null;
        $headsFood = $this->getHeadsFood();
        $config = $this->getConfig();
        back()->with('orderId', $request->session()->get('orderId'));
        back()->with('tableID', $request->session()->get('tableID'));
        return view('orders.update', compact('Order', 'dishes', 'headsFood', 'config'));
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
        $Order = null;
        $heads = $this->getHeads();
        $config = $this->getConfig();
        back()->with('orderId', $request->session()->get('orderId'));
        back()->with('tableID', $request->session()->get('tableID'));
        $dishes = [];
        $spirits = [];
        $drinks = [];
        return view('orders.delete', compact('Order', 'dishes', 'heads', 'config'));
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
                null,
                null,
                //     ->join('tables', 'orders.tableID', '=', 'tables.id')
                null,
                // null,
                ['orderable' => false]
            ],
        ];
    }
}

        // printf($dishes);
        // foreach ($dishes_o as $key => $order) {
        //     // Orden
        //     printf('Order <br>');
        //     printf($key + 1 . ' <br>');
        //     // printf($order->id . ' <br>');
        //     printf($order->date . ' <br>');
        //     foreach ($order->dish_Orders as $key => $dish_o) {
        //         //     // Orden de plato

        //         printf('Dish order <br>');
        //         printf($key + 1 . ' <br>');
        //         // printf($dish_o->id . ' <br>');
        //         printf($dish_o->price . ' <br>');
        //         printf('Dish <br>');
        //         printf($dish_o->dishes->name . ' <br>');
        //         printf($dish_o->dishes->description . ' <br>');
        //         printf($dish_o->dishes->price . ' <br>');
        //         // foreach ($dish_o->dishes as $dish) {
        //         // printf($dish);
        //         //     // Platos
        //         //     printf('Dishes <br>');
        //         //     printf($dish->id . ' <br>');
        //         //     printf($dish->price . ' <br>');
        //         //     printf($dish->name . ' <br>');
        //         //     printf($dish->description . ' <br>');
        //         // }
        //     }
        // }
        // dd($dishes);
        // printf($dishes_o);

        //  METODO DE JOINS
        // $dishes = Dish::select(
        //     'dishes.id',
        //     'dishes.name',
        //     'dishes.price',
        //     'dishes.description',
        //     'dish_orders.quantify',
        //     'tables.num_table',
        //     'dish_orders.price as total'
        // )
        //     ->join('dish_orders', 'dishes.id', '=', 'dish_orders.dish_id')
        //     ->join('orders', 'dish_orders.order_id', '=', 'orders.id')
        //     ->join('tables', 'orders.table_id', '=', 'tables.id')
        //     ->where('tables.id', '=', $request->session()->get('tableID'))
        //     ->where('orders.id', '=', $request->session()->get('orderId'))
        //     ->get();;

        // $drinks = Drink::select(
        //     'drinks.id',
        //     'drinks.name',
        //     'drinks.price',
        //     'drinks.description',
        //     'drink_orders.quantify',
        //     'tables.num_table',
        //     'drink_orders.price as total'
        // )
        //     ->join('drink_orders', 'drinks.id', '=', 'drink_orders.drink_id')
        //     ->join('orders', 'drink_orders.order_id', '=', 'orders.id')
        //     ->join('tables', 'orders.table_id', '=', 'tables.id')
        //     ->where('tables.id', '=', $request->session()->get('tableID'))
        //     ->where('orders.id', '=', $request->session()->get('orderId'))
        //     ->get();;
        // $spirits = Spirit::select(
        //     'spirits.id',
        //     'spirits.name',
        //     'spirits.price',
        //     'spirits.description',
        //     'spirit_orders.quantify',
        //     'tables.num_table',
        //     'spirit_orders.price as total'
        // )
        //     ->join('spirit_orders', 'spirits.id', '=', 'spirit_orders.spirit_id')
        //     ->join('orders', 'spirit_orders.order_id', '=', 'orders.id')
        //     ->join('tables', 'orders.table_id', '=', 'tables.id')
        //     ->where('tables.id', '=', $request->session()->get('tableID'))
        //     ->where('orders.id', '=', $request->session()->get('orderId'))
        //     ->get();
