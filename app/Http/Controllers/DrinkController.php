<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        return view('admin.drinks.add');
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

        $drinkObj = Drink::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        if ($request->hasFile('image')) {
            $url = Storage::put('img/drinks', $request->file('image'));
            $drinkObj->image()->create(['url' => $url]);
        }

        if ($drinkObj->save()) {
            back()->with('message', 'Registro realizado exitosamente!.');
        } else {
            back()->with('error', 'No se pudo realizar el registro.');
        }

        return redirect()->route('drink.create', $drinkObj);
    }

    public function show() // Drink $drinks
    {

        // $heads = $this->getHeads();
        // $config = $this->getConfig();
        // return view('admin.drinks.delete', compact('heads', 'drinks', 'config'));
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

        $drink = Drink::where('id', $request->id)->first();
        $drink->name = $request->name;
        $drink->description = $request->description;
        $drink->price = $request->price;
        $drink->stock = $request->stock;
        // dd($dish);
        if ($request->hasFile('image')) {
            $image = Image::where('imageable_id', $drink->id)
                ->where('imageable_type', 'App\Models\Drink')->first();

            $url = Storage::put('img/drinks', $request->file('image'));

            if ($image) {
                if (Storage::exists($image->url)) {
                    //Mover a una carpeta eliminado
                    // img/drinks/ => mantener el inicio de la url
                    // 11 = sustituir solo el nombre de la imagen url en la base de datos
                    // Tamaño del nombre de la imagen / url.
                    Storage::move($image->url, 'eliminados/' . Str::substr($image->url, 11, Str::length($image->url)));
                }

                $image->url = $url;
                $image->save();
            } else {
                $drink->image()->create(['url' => $url]);
            }
        }

        if ($drink->save()) {
            back()->with('message', 'Actualizacion realizado exitosamente!.');
        } else {
            back()->with('error', 'No se pudo realizar el registro.');
        }

        // return $this->edit();
        return redirect()->route('drink.edit');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'idDel' => 'required',
        ]);
        foreach ($request->idDel as $drink) {
            $image = Image::where('imageable_id', $drink)
                ->where('imageable_type', 'App\Models\Drink')->first();
            if ($image) {
                if (Storage::exists($image->url)) {
                    //Mover a una carpeta eliminado
                    // img/dishes/ => mantener el inicio de la url
                    // 11 = sustituir solo el nombre de la imagen url en la base de datos
                    // Tamaño del nombre de la imagen / url.
                    Storage::move($image->url, 'eliminados/' . Str::substr($image->url, 11, Str::length($image->url)));
                }
                $image->delete();
            }
            Drink::where('id', '=', $drink)->delete();
        }
        if ($request->idDel != null) {
            back()->with('message', 'Eliminación realizado exitosamente!.');
        } else {
            back()->with('error', 'Ninguna bebida selecionado.');
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
