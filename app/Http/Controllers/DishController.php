<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        // back()->with('error', '');
        // back()->with('message', '');
        return view('admin.dishes.add');
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
        $dishObj = Dish::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        if ($request->hasFile('image')) {
            $url = Storage::put('img/dishes', $request->file('image'));
            $dishObj->image()->create(['url' => $url]);
        }

        if ($dishObj->save()) {
            back()->with('message', 'Registro realizado exitosamente!.');
        } else {
            back()->with('error', 'No se pudo realizar el registro.');
        }

        return redirect()->route('dish.create');
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

    public function update(Request $request)
    {
        // Se valida los request para cada campo.
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required'
        ]);

        $dish = Dish::where('id', $request->id)->first();
        $dish->name = $request->name;
        $dish->description = $request->description;
        $dish->price = $request->price;
        $dish->stock = $request->stock;
        // dd($dish);
        if ($request->hasFile('image')) {
            $image = Image::where('imageable_id', $dish->id)
                ->where('imageable_type', 'App\Models\Dish')->first();

            $url = Storage::put('img/dishes', $request->file('image'));

            if ($image) {
                if (Storage::exists($image->url)) {
                    //Mover a una carpeta eliminado
                    // img/dishes/ => mantener el inicio de la url
                    // 11 = sustituir solo el nombre de la imagen url en la base de datos
                    // Tamaño del nombre de la imagen / url.
                    Storage::move($image->url, 'eliminados/' . Str::substr($image->url, 11, Str::length($image->url)));
                }

                $image->url = $url;
                $image->save();
            } else {
                $dish->image()->create(['url' => $url]);
            }
        }

        if ($dish->save()) {
            back()->with('message', 'Actualizacion realizado exitosamente!.');
        } else {
            back()->with('error', 'No se pudo realizar la actualización.');
        }

        return redirect()->route('dish.edit', $dish);
        // return $this->edit();
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'idDel' => 'required',
        ]);
        foreach ($request->idDel as $dish) {
            $image = Image::where('imageable_id', $dish)
                ->where('imageable_type', 'App\Models\Dish')->first();
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
            Dish::where('id', '=', $dish)->delete();
        }
        if ($request->idDel != null) {
            back()->with('message', 'Eliminación realizado exitosamente!.');
        } else {
            back()->with('error', 'Ningun plato selecionado.');
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
