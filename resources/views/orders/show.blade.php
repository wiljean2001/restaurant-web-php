{{-- @extends('layouts.order') --}}
@extends('adminlte::page')
@section('title', 'Orden')

@section('content')
    <div class="container-lg">
        <div class="d-flex justify-content-lg-between justify-content-between align-items-lg-center">
            <h1 class="my-lg-2 my-2">ORDEN: </h1>
            <a href="{{ route('menu-restaurant') }}"><i class="fas fa-chevron-circle-left fa-3x"></i></a>
        </div>
        <div class="mx-3 mx-lg-3">
            <x-adminlte-card title="PLASTOS" theme="maroon" theme-mode="outline" icon="fas fa-lg fa-bell" collapsible
                maximizable>
                @foreach ($dishes_o as $key => $order)
                    {{-- Dish Table --}}
                    <x-adminlte-datatable id="table1" :heads="$headsFood" head-theme="light" :config='$config' with-buttons
                        with-footer hoverable>
                        @if ($dishes_o == null)
                            <tr>
                                <td rowspan="7">No hay platos solicitados</td>
                            </tr>
                        @else
                            @foreach ($order->dish_Orders as $key => $dish_o)
                                <tr>
                                    <td>{!! $key + 1 !!}</td>
                                    <td>S/ {!! $dish_o->price !!}</td>{{-- Total --}}
                                    <td>{!! $dish_o->quantify !!} uds.</td>
                                    <td>{!! $dish_o->dishes->name !!}</td>
                                    <td>{!! $dish_o->dishes->description !!}</td>
                                    <td>$/ {!! $dish_o->dishes->price !!}</td>
                                    <td>
                                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="">
                                            <i class="fas fa-utensils"></i>
                                        </button>
                                        <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="">
                                            <i class="fas fa-drumstick-bite"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </x-adminlte-datatable>
                @endforeach
            </x-adminlte-card>
        </div>
        <div class="mx-3 mx-lg-3">
            <x-adminlte-card title="BEBIDAS" theme="success" theme-mode="outline" icon="fas fa-lg fa-bell" collapsible
                maximizable>
                @foreach ($drinks_o as $key => $order)
                    {{-- Drink Table --}}
                    <x-adminlte-datatable id="table2" :heads="$headsFood" head-theme="light" :config='$config' with-buttons
                        with-footer hoverable>
                        @if ($drinks_o == null)
                            <tr>
                                <td rowspan="7">No hay platos solicitados</td>
                            </tr>
                        @else
                            @foreach ($order->drink_Orders as $key => $drink_o)
                                <tr>
                                    <td>{!! $key + 1 !!}</td>
                                    <td>S/ {!! $drink_o->price !!}</td>{{-- Total --}}
                                    <td>{!! $drink_o->quantify !!} uds.</td>
                                    <td>{!! $drink_o->drinks->name !!}</td>
                                    <td>{!! $drink_o->drinks->description !!}</td>
                                    <td>$/ {!! $drink_o->drinks->price !!}</td>
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
                @endforeach
            </x-adminlte-card>
        </div>
        <div class="mx-3 mx-lg- mb-5 mb-lg-5">
            <x-adminlte-card title="LICORES" theme="purple" theme-mode="outline" icon="fas fa-lg fa-bell" collapsible
                maximizable>
                @foreach ($spirits_o as $key => $order)
                    {{-- Spirit Table --}}
                    <x-adminlte-datatable id="table3" :heads="$headsFood" head-theme="light" :config='$config' with-buttons
                        with-footer hoverable>
                        @if ($spirits_o == null)
                            <tr>
                                <td rowspan="7">No hay platos solicitados</td>
                            </tr>
                        @else
                            @foreach ($order->spirit_Orders as $key => $spirit_o)
                                <tr>
                                    <td>{!! $key + 1 !!}</td>
                                    <td>S/ {!! $spirit_o->price !!}</td>{{-- Total --}}
                                    <td>{!! $spirit_o->quantify !!} uds.</td>
                                    <td>{!! $spirit_o->spirits->name !!}</td>
                                    <td>{!! $spirit_o->spirits->description !!}</td>
                                    <td>$/ {!! $spirit_o->spirits->price !!}</td>
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
                @endforeach
            </x-adminlte-card>
        </div>
        <div class="mx-5 mx-lg-5 mb-5 mb-lg-5 d-flex justify-content-lg-around flex-wrap">
            <div>
                <label for="">Total a pagar: S/</label>
                <input type="text" value="{{ $total }}" disabled>
            </div>
            <div>
                <label for="">Mozo: </label>
                <input type="text" value="{{ $mozo[0]->name . ' ' . $mozo[0]->lname }}" disabled>
            </div>
            <div>
                <label for="">Mesa: </label>
                <input type="text" value="{{ $table[0]->num_table }}" disabled>
            </div>
            <div>
                <label for="">Fecha: </label>
                <input type="text" value="{!! $dishes_o[0]->date !!}" disabled>
            </div>
        </div>
        <form action="{{ route('order.finalized') }}" method="POST">
            @csrf
            <div class="btn-flotante px-3 py-2">
                <x-adminlte-button label="FINALIZAR PEDIDO" theme="success" icon="fas fa-lg fa-save" name="endOrder"
                    type="submit" />
            </div>
        </form>
    </div>
@stop
