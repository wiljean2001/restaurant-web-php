@extends('adminlte::page')
@section('title', 'bebida')

@section('content')
    <div class="w-100 d-flex">
        <div class="w-25 pr-3 pr-lg-3 py-3 py-lg-3 vh-100 overflow-scroll">
            <h2>Nuevos Pedidos</h2>
            @foreach ($orders as $order)
                <a href="{{ route('orders.new.now', $order->id) }}" class="text-decoration-none">
                    <div class="info-box bg-gradient-warning">
                        <span class="info-box-icon"> <i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Mesa: {{ $order->tables->num_table }}</span>
                            <span class="info-box-number">N° Pedidos: {{ $num_pedidos }}</span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 70%"></div>
                            </div>
                            <span class="progress-description">
                                {{ $order->hour . ' ' . $order->date }}
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="w-75 shadow-lg p-3 mb-5 mb-lg-5 mt-3 mt-lg-3 bg-body rounded container text-center">
            <nav class="d-flex justify-content-lg-start align-items-lg-baseline">
                <i class="fas fa-arrow-left fa-1x"></i>
                <h2 class="h5 ml-3 ml-lg-3">Orden: 123</h2>
            </nav>
            @if ($ordersNow == null)
                    <img src="{{ asset('img/table-phone.png') }}" alt="" class="w-100  p-5 p-lg-5">
            @else
                <div class="container-fluid">
                    <div class="bg-dark d-flex justify-content-lg-between p-3 p-lg-3">
                        <h2 class="h4">Hora</h2>
                        <h2 class="h4 text-danger">{{ date('h:i:s a') }}</h2>
                    </div>
                </div>
                <div class="p-3 p-lg-3">
                    <x-adminlte-datatable id="table1" :heads="$heads" head-theme="light" :config='$config' with-buttons
                        with-footer hoverable>
                        @foreach ($ordersNow as $order)
                        @foreach ($order->dish_Orders as $dishO)
                        <tr>
                            <td>
                                <div class="text-left">
                                    <h2 class="h5">Plato:</h2>
                                    <label for="dish-order">{{ $dishO->dishes->name }}</label>
                                </div>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endforeach
                        @endforeach
                    </x-adminlte-datatable>
                </div>
            @endif
        </div>
    </div>
    @extends('layouts.footers.footer')
@stop
