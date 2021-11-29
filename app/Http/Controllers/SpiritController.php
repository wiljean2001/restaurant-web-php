<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Spirit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SpiritController extends Controller
{
    public function index()
    {
        $heads = $this->getHeads();
        $config = $this->getConfig();
        $spirits = Spirit::all();
        return view('admin.spirits.show', compact('heads', 'spirits', 'config'));
    }

    public function create()
    {
        $time = date('m-d-Y h:i:s a');
        // back()->with('error', '');
        // back()->with('message', '');
        return view('admin.spirits.add', compact('time'));
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

        $spiritkObj = Spirit::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        if ($request->hasFile('image')) {
            $url = Storage::put('img/spirits', $request->file('image'));
            $spiritkObj->image()->create(['url' => $url]);
        }

        if ($spiritkObj->save()) {
            back()->with('message', 'Registro realizado exitosamente!.');
        } else {
            back()->with('error', 'No se pudo realizar el registro.');
        }

        return redirect()->route('spirit.create');
    }

    public function show() // Spirit $drinks
    {
        // $heads = $this->getHeads();
        // $config = $this->getConfig();
        // return view('admin.spirits.delete', compact('heads', 'Spirits', 'config'));
    }

    public function edit()
    {
        $heads = $this->getHeads();
        $config = $this->getConfig();
        $spirits = Spirit::all();
        return view('admin.spirits.update', compact('heads', 'spirits', 'config'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required'
        ]);

        $spirit = Spirit::where('id', $request->id)->first();
        $spirit->name = $request->name;
        $spirit->description = $request->description;
        $spirit->price = $request->price;
        $spirit->stock = $request->stock;
        // dd($dish);
        if ($request->hasFile('image')) {
            $image = Image::where('imageable_id', $spirit->id)
                ->where('imageable_type', 'App\Models\Spirit')->first();

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
                $spirit->image()->create(['url' => $url]);
            }
        }

        if ($spirit->save()) {
            back()->with('message', 'Actualizacion realizado exitosamente!.');
        } else {
            back()->with('error', 'No se pudo realizar el registro.');
        }

        // return $this->edit();
        return redirect()->route('spirit.edit');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'idDel' => 'required',
        ]);
        // recorrer array de ID`s
        foreach ($request->idDel as $spirit) {
            $image = Image::where('imageable_id', $spirit)
                ->where('imageable_type', 'App\Models\Spirit')->first();
            if ($image) {
                if (Storage::exists($image->url)) {
                    //Mover a una carpeta eliminado
                    // img/spirits/ => mantener el inicio de la url
                    // 11 = sustituir solo el nombre de la imagen url en la base de datos
                    // Tamaño del nombre de la imagen / url.
                    Storage::move($image->url, 'eliminados/' . Str::substr($image->url, 11, Str::length($image->url)));
                }
                $image->delete();
            }
            Spirit::where('id', '=', $spirit)->delete();
        }
        if ($request->idDel != null) {
            back()->with('message', 'Eliminación realizado exitosamente!.');
        } else {
            back()->with('error', 'Ningun licor selecionado.');
        }

        return redirect()->route('spirit.delete');
    }

    public function delete()
    {
        $heads = $this->getHeads();
        $config = $this->getConfig();
        $spirits = Spirit::all();
        return view('admin.spirits.delete', compact('heads', 'spirits', 'config'));
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
