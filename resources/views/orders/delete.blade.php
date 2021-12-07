{{-- @extends('layouts.order') --}}
@extends('adminlte::page')
@section('title', 'Orden')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-lg-between align-items-lg-center">
            <h1 class="my-lg-2 my-2">ELIMINAR ORDEN: </h1>
            <a href="{{ route('menu-restaurant') }}"><i class="fas fa-chevron-circle-left fa-3x"></i></a>
        </div>
        <div class="mx-5 mx-lg-5">
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
                                        <form action="{{ route('dish.orders.delete') }}" method="POST">
                                            @csrf
                                            <input type="text" name="idDishO" value="{!! $dish_o->id !!}" hidden>
                                            <x-adminlte-button label="Eliminar" theme="outline-danger"
                                                icon="fas fa-pen-square" type="submit" />
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </x-adminlte-datatable>
                @endforeach
            </x-adminlte-card>
        </div>
        <div class="mx-5 mx-lg-5">
            <x-adminlte-card title="BEBIDAS" theme="success" theme-mode="outline" icon="fas fa-lg fa-bell" collapsible
                maximizable>
                @foreach ($drinks_o as $key => $order)
                    {{-- Drink Table --}}
                    <x-adminlte-datatable id="table2" :heads=" $headsFood" head-theme="light" :config='$config' with-buttons
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
                                        <form action="{{ route('drink.orders.delete') }}" method="POST">
                                            @csrf
                                            <input type="text" name="idDrinkO" value="{!! $drink_o->id !!}" hidden>
                                            <x-adminlte-button label="Eliminar" theme="outline-danger"
                                                icon="fas fa-pen-square" type="submit" />
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </x-adminlte-datatable>
                @endforeach
            </x-adminlte-card>
        </div>
        <div class="mx-5 mx-lg-5 mb-5 mb-lg-5">
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
                                        <form action="{{ route('spirit.orders.delete') }}" method="POST">
                                            @csrf
                                            <input type="text" name="idSpiritO" value="{!! $spirit_o->id !!}" hidden>
                                            <x-adminlte-button label="Eliminar" theme="outline-danger"
                                                icon="fas fa-pen-square" type="submit" />
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </x-adminlte-datatable>
                @endforeach
            </x-adminlte-card>
        </div>
        <div class="mx-5 mx-lg-5 mb-5 mb-lg-5 d-flex justify-content-lg-around">
            <div>
                <label for="">Total a pagar: S/</label>
                <input type="text" value="{{ $total }}" disabled>
            </div>
        </div>
    </div>
@stop
