<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function index()
    {
        $heads = $this->getHeads();
        $config = $this->getConfig();
        $dishes = Dish::all();
        return view('admin.dishes.show', compact('heads', 'dishes', 'config'));
    }

    public function create()
    {
        $time = date('m-d-Y h:i:s a');
        // back()->with('error', '');
        // back()->with('message', '');
        return view('admin.dishes.add', compact('time'));
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

        $dishObj = new Dish();
        $dishObj->name = $request->name;
        $dishObj->description = $request->description;
        $dishObj->price = $request->price;
        $dishObj->stock = $request->stock;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/files/dishes/', $filename);
            $dishObj->image = $filename;
        }

        if ($dishObj->save()) {
            back()->with('message', 'true');
        } else {
            back()->with('error', 'true');
        }

        return redirect()->route('dish.create', $dishObj);
    }

    public function show(Dish $dishes)
    {
        $heads = $this->getHeads();
        $config = $this->getConfig();
        return view('admin.dishes.delete', compact('heads', 'dishes', 'config'));
    }

    public function edit()
    {
        $heads = $this->getHeads();
        $config = $this->getConfig();
        $dishes = Dish::all();

        return view('admin.dishes.update', compact('heads', 'dishes', 'config'));
    }
    public function editIn(Request $request, $dishID)
    {
        $heads = $this->getHeads();
        $config = $this->getConfig();
        $upToDish = Dish::where('id', '=', $dishID)->get();
        $dishes = Dish::all();

        return view('admin.dishes.update', compact('heads', 'dishes', 'upToDish', 'config'));
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
                $file->move(public_path() . '/files/dishes/', $filename);
            }
            Dish::where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'stock' => $request->stock,
                    'image' => $filename,
                    'price' => $request->price
                ]);
        } else {
            Dish::where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'stock' => $request->stock,
                    'price' => $request->price
                ]);
        }
        return redirect()->route('dish.edit');
        // return $this->edit();
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'idDel' => 'required',
        ]);
        foreach ($request->idDel as $dish) {
            Dish::where('id', '=', $dish)->delete();
        }
        return redirect()->route('dish.delete');
    }

    public function delete()
    {
        $heads = $this->getHeads();
        $config = $this->getConfig();
        $dishes = Dish::all();
        return view('admin.dishes.delete', compact('heads', 'dishes', 'config'));
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
