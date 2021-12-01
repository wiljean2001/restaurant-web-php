{{-- @extends('layouts.order') --}}
@extends('adminlte::page')
@section('title', 'Orden')

@section('content')

<div class="container">
    <h1 class="my-lg-2 my-2">ORDEN: </h1>
    <div class="mx-5 mx-lg-5">
        <x-adminlte-card title="PLASTOS" theme="maroon" theme-mode="outline" icon="fas fa-lg fa-bell" collapsible
            maximizable>
            {{-- Dish Table --}}
            <x-adminlte-datatable id="table1" :heads="$heads" theme="" head-theme="light" :config='$config' with-buttons
                with-footer hoverable>
                @if ($dishes==null)
                <tr>
                    <td rowspan="7">No hay platos solicitados</td>
                </tr>
                @else
                @foreach($dishes as $row)
                <tr>
                    <td>{!! $row->id !!}</td>
                    <td>{!! $row->name !!}</td>
                    <td>S/ {!! $row->price !!}</td>
                    <td>{!! $row->description !!}</td>
                    {{-- <td>
                        <img src="{!! asset('storage/'.$row->image->url) !!}" alt="imagen-plato" class=" w-50">
                    </td> --}}
                    <td>{!! $row->quantify !!} uds.</td>
                    <td>Mesa {!! $row->num_table !!}</td>
                    <td>S/ {!! $row->total !!}</td>
                    <td>
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fas fa-utensils"></i>
                        </button>
                        <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                            <i class="fas fa-drumstick-bite"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
                @endif
            </x-adminlte-datatable>
        </x-adminlte-card>

        <x-adminlte-card title="BEBIDAS" theme="success" theme-mode="outline" icon="fas fa-lg fa-bell" collapsible
            maximizable>
            {{-- Drink Table --}}
            <x-adminlte-datatable id="table2" :heads="$heads" theme="" head-theme="light" :config='$config' with-buttons
                with-footer hoverable>
                @if ($drinks==null)
                <tr>
                    <td rowspan="7">No hay bebidas solicitados</td>
                </tr>
                @else
                @foreach($drinks as $row)
                <tr>
                    <td>{!! $row->id !!}</td>
                    <td>{!! $row->name !!}</td>
                    <td>S/ {!! $row->price !!}</td>
                    <td>{!! $row->description !!}</td>
                    {{-- <td>
                        <img src="{!! asset('files/drinks/'.$row->image) !!}" alt="imagen-plato" class=" w-50">
                    </td> --}}
                    <td>{!! $row->quantify !!} uds.</td>
                    <td>Mesa {!! $table->num_table !!}</td>
                    <td>S/ {!! $row->total !!}</td>
                    <td>
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fas fa-mug-hot"></i>
                        </button>
                        <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                            <i class="far fa-lemon"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
                @endif
            </x-adminlte-datatable>
        </x-adminlte-card>

        <x-adminlte-card title="LICORES" theme="purple" theme-mode="outline" icon="fas fa-lg fa-bell" collapsible
            maximizable>
            {{-- Spirit Table --}}
            <x-adminlte-datatable id="table3" :heads="$heads" theme="" head-theme="light" :config='$config' with-buttons
                with-footer hoverable>
                @if ($spirits==null)
                <tr>
                    <td rowspan="7">No hay licores solicitados</td>
                </tr>
                @else
                @foreach($spirits as $row)
                <tr>
                    <td>{!! $row->id !!}</td>
                    <td>{!! $row->name !!}</td>
                    <td>S/ {!! $row->price !!}</td>
                    <td>{!! $row->description !!}</td>
                    {{-- <td>
                        <img src="{!! asset('files/spirits/'.$row->image) !!}" alt="imagen-plato" class=" w-50">
                    </td> --}}
                    <td>{!! $row->quantify !!} uds.</td>
                    <td>Mesa {!! $table->num_table !!}</td>
                    <td>S/ {!! $row->total !!}</td>
                    <td>
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fas fa-wine-bottle"></i>
                        </button>
                        <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                            <i class="fas fa-glass-martini-alt"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
                @endif
            </x-adminlte-datatable>
        </x-adminlte-card>
    </div>
    <form action="{{ route('menu-restaurant') }}" method="GET">
        @csrf
        {{-- <input type="text" name="endOrder" hidden value="yes"> --}}
        <x-adminlte-button class="btn-flotante px-3 py-2" label="FINALIZAR PEDIDO" theme="success"
            icon="fas fa-lg fa-save" name="endOrder" type="submit" />
    </form>
</div>
@stop