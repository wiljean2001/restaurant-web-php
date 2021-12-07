{{-- @extends('layouts.order') --}}
@extends('adminlte::page')
@section('title', 'Orden')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-lg-between align-items-lg-center">
            <h1 class="my-lg-2 my-2">ACTUALIZAR ORDEN: </h1>
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
                                        <x-adminlte-button name="{!! $dish_o->quantify !!}" id="{!! $dish_o->id !!}"
                                            label="Editar" theme="warning" icon="fas fa-pen-square" data-toggle="modal"
                                            class="btn-dish-edit" />
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
                                        <x-adminlte-button name="{!! $drink_o->quantify !!}" id="{!! $drink_o->id !!}"
                                            label="Editar" theme="warning" icon="fas fa-pen-square" data-toggle="modal"
                                            class="btn-drink-edit" />
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
                                        <x-adminlte-button name="{!! $spirit_o->quantify !!}" id="{!! $spirit_o->id !!}"
                                            label="Editar" theme="warning" icon="fas fa-pen-square" data-toggle="modal"
                                            class="btn-spirit-edit" />
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
    {{-- Modals --}}
    <div class="modal fade" id="ModalDishEdit" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Modificar plato</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dish.orders.edit') }}" method="POST" class="text-center">
                        <div>
                            @csrf
                            <input type="text" name="idDiOrder" id="idDiO" hidden>
                            <div class="form-floating mb-3 mx-3 mx-lg-3">
                                <input type="number" class="form-control" id="quantifyDi"
                                    placeholder="Cantidad a solicitar; Ejem.: 4" required name="quantify">
                                <label for="quantifyDi">Cantidad</label>
                            </div>
                            <x-adminlte-button type="submit" class="mr-auto w-25" theme="success" label="Solicitar" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer text-right">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalDrinkEdit" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Modificar bebida</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('drink.orders.edit') }}" method="POST" class="text-center">
                        <div>
                            @csrf
                            <input type="text" name="idDrOrder" id="idDrO" hidden>
                            <div class="form-floating mb-3 mx-3 mx-lg-3">
                                <input type="number" class="form-control" id="quantifyDr"
                                    placeholder="Cantidad a solicitar; Ejem.: 4" required name="quantify">
                                <label for="quantifyDr">Cantidad</label>
                            </div>
                            <x-adminlte-button type="submit" class="mr-auto w-25" theme="success" label="Solicitar" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer text-right">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalSpiritEdit" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Modificar licor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('spirit.orders.edit') }}" method="POST" class="text-center">
                        <div>
                            @csrf
                            <input type="text" name="idSpOrder" id="idSpO" hidden>
                            <div class="form-floating mb-3 mx-3 mx-lg-3">
                                <input type="number" class="form-control" id="quantifySp"
                                    placeholder="Cantidad a solicitar; Ejem.: 4" required name="quantify">
                                <label for="quantifySp">Cantidad</label>
                            </div>
                            <x-adminlte-button type="submit" class="mr-auto w-25" theme="success" label="Solicitar" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer text-right">
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.btn-dish-edit').click(function() {
                // Capturamos el valor de quantify id para insertarlo en el input del modal
                var id = this.id; // id dish
                var name = this.name; // cuantify
                document.querySelector('#idDiO').value = id;
                document.querySelector('#quantifyDi').value = name;
                $('#ModalDishEdit').modal('show');
            });
            $('.btn-drink-edit').click(function() {
                // Capturamos el valor de quantify id para insertarlo en el input del modal
                var id = this.id; // id dish
                var name = this.name; // cuantify
                document.querySelector('#idDrO').value = id;
                document.querySelector('#quantifyDr').value = name;
                $('#ModalDrinkEdit').modal('show');
            });
            $('.btn-spirit-edit').click(function() {
                // Capturamos el valor de quantify id para insertarlo en el input del modal
                var id = this.id; // id dish
                var name = this.name; // cuantify
                document.querySelector('#idSpO').value = id;
                document.querySelector('#quantifySp').value = name;
                $('#ModalSpiritEdit').modal('show');
            });
        });
    </script>
@stop
