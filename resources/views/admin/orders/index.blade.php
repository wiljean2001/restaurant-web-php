@php
$total = null;
$num_pedidos = null;
@endphp
@extends('adminlte::page')
@section('title', 'Pedidos')

@section('content')
    <div class="w-100 d-flex">
        <div class="w-25 pr-3 pr-lg-3 py-3 py-lg-3 vh-100 overflow-scroll" id="new-orders-div">
            <h2>Nuevos Pedidos</h2>
            @foreach ($orders as $order)
                @foreach ($order->dish_Orders as $dishO)
                    @php
                        $num_pedidos++;
                    @endphp
                @endforeach
                @foreach ($order->drink_Orders as $drinkO)
                    @php
                        $num_pedidos++;
                    @endphp
                @endforeach
                @foreach ($order->spirit_Orders as $spiritO)
                    @php
                        $num_pedidos++;
                    @endphp
                @endforeach
                <a href="{{ route('orders.new.now', $order->id) }}" class="text-decoration-none">
                    <div class="info-box bg-gradient-warning flex-wrap">
                        <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Mesa: {{ $order->tables->num_table }}</span>
                            <span class="info-box-number">N° Pedidos: {{ $num_pedidos }}</span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 70%"></div>
                            </div>
                            <span class="progress-description">
                                {{ $order->hour }}
                            </span>
                            <span class="progress-description">
                                {{ $order->date }}
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="w-75 shadow-lg p-3 mb-5 mb-lg-5 mt-3 mt-lg-3 bg-body rounded container text-center">
            <nav class="d-flex justify-content-lg-start align-items-lg-baseline">
                <a href="{{ route('orders.new') }}"><i class="fas fa-arrow-left fa-1x"></i></a>
                <h2 class="h5 ml-3 ml-lg-3">Pedido:</h2>
            </nav>
            @if ($ordersNow == null)
                <img src="{{ asset('img/table-phone.png') }}" alt="" class="w-100  p-5 p-lg-5">
            @else
                <div class="container-fluid">
                    <div class="bg-gradient-light d-flex justify-content-lg-between justify-content-between p-3 p-lg-3">
                        <h2 class="h4">Hora</h2>
                        <strong class="h4 text-red">{{ $ordersNow[0]->hour }}</strong>
                    </div>
                </div>
                <div class="p-3 p-lg-3">
                    <x-adminlte-datatable id="table1" :heads="$heads" head-theme="light" :config='$config' with-buttons
                        hoverable>
                        @foreach ($ordersNow as $order)
                            @foreach ($order->dish_Orders as $dishO)
                                @php
                                    $total += $dishO->price;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="text-left">
                                            <h2 class="h5">Plato:</h2>
                                            <label for="dish-order">{{ $dishO->dishes->name }}</label>
                                        </div>
                                    </td>
                                    <td>{{ $dishO->quantify }}</td>
                                    <td>
                                        <strong>S/ {{ $dishO->price }}</strong>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach ($order->drink_Orders as $drinkO)
                                @php
                                    $total += $drinkO->price;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="text-left">
                                            <h2 class="h5">Bebida:</h2>
                                            <label for="dish-order">{{ $drinkO->drinks->name }}</label>
                                        </div>
                                    </td>
                                    <td>{{ $drinkO->quantify }}</td>
                                    <td>
                                        <strong>S/ {{ $drinkO->price }}</strong>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach ($order->spirit_Orders as $spiritO)
                                @php
                                    $total += $spiritO->price;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="text-left">
                                            <h2 class="h5">Licor:</h2>
                                            <label for="dish-order">{{ $spiritO->spirits->name }}</label>
                                        </div>
                                    </td>
                                    <td>{{ $spiritO->quantify }}</td>
                                    <td>
                                        <strong>S/ {{ $spiritO->price }}</strong>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </x-adminlte-datatable>
                    <div class="my-3 my-lg-3">
                        <div class="d-flex justify-content-lg-end justify-content-end  mx-5 mx-lg-5 opacity-50">
                            <span class="h6 mr-4 mr-lg-4">Mesa</span>
                            <span class="h6">{{ $ordersNow[0]->tables->num_table }}</span>
                        </div>
                        <div class="d-flex justify-content-lg-end mx-5 mx-lg-5 justify-content-end align-items-center">
                            <span class="h6 mr-4 mr-lg-4 opacity-50">Total:</span>
                            <span class="h5">S/ {{ $total }}</span>
                        </div>
                        <div
                            class="d-flex justify-content-lg-end mx-5 mx-lg-5 justify-content-end my-2 my-lg-2 align-items-center">
                            <form action="{{ route('orders.new.now.final') }}" method="POST">
                                @csrf
                                <input type="text" value="{{ $ordersNow[0]->id }}" name="order_id" hidden>
                                <button type="submit" class="btn-outline-success px-4 py-2 border-none">FINALIZADO</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @extends('layouts.footers.footer')
@stop


@section('js')
    {{-- Función actualizar --}}
    <script type="text/javascript">
        function actualizar() {
            location.reload(true);
        }
        // Función para actualizar cada 4 segundos(4000 milisegundos)
        setInterval("actualizar()", 10000);
    </script>
@stop
