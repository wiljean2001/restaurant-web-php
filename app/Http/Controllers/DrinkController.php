<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use Illuminate\Http\Request;

class DrinkController extends Controller
{
    public function index()
    {
        $heads = $this->getHeads();
        $config = $this->getConfig();
        $drinks = Drink::all();
        return view('admin.drinks.show', compact('heads', 'drinks', 'config'));
    }

    public function create()
    {
        $time = date('m-d-Y h:i:s a');
        // back()->with('error', '');
        // back()->with('message', '');
        return view('admin.drinks.add', compact('time'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
            'stock' => 'required'
        ]);

        $drinkObj = new Drink();
        $drinkObj->name = $request->name;
        $drinkObj->description = $request->description;
        $drinkObj->price = $request->price;
        $drinkObj->stock = $request->stock;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/files/drinks/', $filename);
            $drinkObj->image = $filename;
        }

        if ($drinkObj->save()) {
            back()->with('message', 'true');
        } else {
            back()->with('error', 'true');
        }

        return redirect()->route('drink.create', $drinkObj);
    }

    public function show(Drink $drinks)
    {
        $heads = $this->getHeads();
        $config = $this->getConfig();
        return view('admin.drinks.delete', compact('heads', 'drinks', 'config'));
    }

    public function edit()
    {
        $heads = $this->getHeads();
        $config = $this->getConfig();
        $drinks = Drink::all();
        return view('admin.drinks.update', compact('heads', 'drinks', 'config'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required'
        ]);

        if ($request->image) {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path() . '/files/drinks/', $filename);
            }
            Drink::where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'stock' => $request->stock,
                    'image' => $filename,
                    'price' => $request->price
                ]);
        } else {
            Drink::where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'stock' => $request->stock,
                    'price' => $request->price
                ]);
        }
        // return $this->edit();
        return redirect()->route('drink.edit');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'idDel' => 'required',
        ]);
        foreach ($request->idDel as $dish) {
            Drink::where('id', '=', $dish)->delete();
        }
        return redirect()->route('drink.delete');
    }

    public function delete()
    {
        $heads = $this->getHeads();
        $config = $this->getConfig();
        $drinks = Drink::all();
        return view('admin.drinks.delete', compact('heads', 'drinks', 'config'));
    }

    private function getHeads()
    {
        return $heads = [
            ['label' => 'id', 'width' => 0],
            'Nombre',
            'Precio',
            ['label' => 'Descripcion', 'width' => 40],
            ['label' => 'Imagen', 'no-export' => true, 'width' => 13],
            ['label' => 'Stock', 'width' => 10],
            ['label' => 'Accion', 'no-export' => true, 'width' => 3],
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
                ['orderable' => false],
                null,
                ['orderable' => false]
            ],
        ];
    }
}
