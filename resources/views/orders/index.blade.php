@extends('adminlte::page')

@section('title', 'Orden')

@section('content')
    {{-- HEADER --}}
    <div class="header  bi-header h-auto">
        {{-- navbar-expand-lg --}}
        <nav class="navbar">
            <div class="container-fluid d-flex justify-content-between justify-content-lg-between">
                <a class="navbar-brand w-75"></a>
                {{-- <img class="w-75 max-w-xl"
                        src="{{ asset('favicon/logo-restaurant_white_250px.png') }}" alt=""> --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-bars fa-2x"></i>
                </button>
                <div class="collapse navbar-collapse text-right" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-light" aria-current="page" href="{{ route('login') }}">
                                <i class="fas fa-lock"></i>
                                <strong>Iniciar sesión</strong>
                            </a>
                            {{-- <a class="nav-link text-dark" href="{{ route('register-user') }}">
                                <i class="fas fa-user"></i>
                                <span>{{ __('Registrar') }}</span>
                            </a> --}}
                            {{-- <a class="nav-link active" aria-current="page" href="#">Home</a> --}}
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="pt-5 mb-lg-4 py-lg-5">
                <div class="row justify-content-center">
                    <div class="text-center col-lg-6 col-md-6 mt-md-5">
                        <h1 class="text-dark display-4">{{ __('Restaurante') }}</h1>
                        <h1 class="text-dark display-2">{{ __('Piedras Calientes') }}</h1>
                        <a href="#" id="to-button" class="w-50 btn btn-outline-primary py-lg-1">Menu digital <br>
                            <i class="fas fa-level-down-alt"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#fff" fill-opacity="1"
                    d="M0,128L34.3,117.3C68.6,107,137,85,206,80C274.3,75,343,85,411,101.3C480,117,549,139,617,138.7C685.7,139,754,117,823,128C891.4,139,960,181,1029,170.7C1097.1,160,1166,96,1234,74.7C1302.9,53,1371,75,1406,85.3L1440,96L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z">
                </path>
            </svg>
        </div>
    </div>

    {{-- MENU DROP DOWN --}}
    <div class="btn-flotante">
        <input type="checkbox" id="btn-mas">
        <div class="redes">
            <a href="{{ route('order.show') }}" title="Ver orden" data-bs-toggle="tooltip" data-bs-placement="left"
                id="tooltip">
                <i class="fas fa-eye"></i></a>
            <a href="{{ route('order.edit') }}" title="editar orden">
                <i class="fas fa-edit"></i></a>
            <a href="{{ route('order.delete') }}" title="eliminar orden">
                <i class="fas fa-minus-square"></i></a>
        </div>
        <div class="btn-mas">
            <label for="btn-mas" class="fa fa-plus"></label>
        </div>
    </div>
    {{-- menu order --}}
    <div class="bg-white container-lg">
        <nav id="navbar-example2" class="navbar navbar-light bg-white px-3" data-bs-spy="scroll">
            {{-- <a class="navbar-brand" href="#">Navbar</a> --}}
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" href="#platos">
                        <i class="fas fa-stream"></i> Ver platos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#bebidas">
                        <i class="fas fa-stream"></i> Ver bebidas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#licores">
                        <i class="fas fa-stream"></i> Ver licores</a>
                </li>
            </ul>
            <ul class="nav nav-pills d-flex flex-row flex-wrap justify-content-end">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Generar orden
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <form action="{{ route('order.create') }}" method="POST"
                                    class="d-flex flex-row flex-wrap justify-content-around align-items-lg-center">
                                    {{-- <li class="mr-4 mr-lg-4"> --}}
                                    @csrf
                                    <div class="form-floating mb-3 mx-3 mx-lg-3">
                                        <input type="text" class="form-control" id="floatingInput"
                                            placeholder="DNI: 73889330" name="dni_client">
                                        <label for="floatingInput">DNI</label>
                                    </div>
                                    <div class="form-floating mb-3 mx-3 mx-lg-3">
                                        <input type="text" class="form-control" id="floatingInput"
                                            placeholder="RUC: 0730070003557" name="ruc_client">
                                        <label for="floatingInput">RUC</label>
                                    </div>
                                    <div class="form-floating mb-3 mx-3 mx-lg-3">
                                        <input type="text" class="form-control" id="floatingInput"
                                            placeholder="Nombre: Wilmer Ayala García" name="name_client">
                                        <label for="floatingInput">Nombre</label>
                                    </div>
                                    <hr>
                                    <div class="form-floating">
                                        <select class="form-select" id="floatingSelectGrid"
                                            aria-label="Floating label select example" name="waiter_id">
                                            <option value="" selected>Seleccionar Mozo</option>
                                            @foreach ($waiters as $waiter)
                                                <option value="{{ $waiter->id }}">
                                                    {{ $waiter->name . ' ' . $waiter->lname }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="floatingSelectGrid">Mozo:</label>
                                    </div>
                                    <div class="mr-4 mr-lg-4">
                                        <x-adminlte-select name="idTable" label-class="text-lightblue" igroup-size="sm">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    {{ __('Mesas:') }}
                                                </div>
                                            </x-slot>
                                            @if (Session::has('tableID'))
                                                <option value="{{ Session::get('tableID') }}" selected>Mesa
                                                    {{ Session::get('tableID') }}</option>
                                            @endif
                                            @foreach ($tables as $table)
                                                <option value="{{ $table->id }}">Mesa {{ $table->num_table }}
                                                </option>
                                            @endforeach
                                        </x-adminlte-select>
                                        <input type="text" class="form-control bg-white" id="idOrder" name="isOrder"
                                            disabled>
                                    </div>
                                    <div class="nav-item">
                                        <x-adminlte-button type="submit" icon="fas fa-plus text-red" label="Crear orden"
                                            data-toggle="modal" class="btn btn-primary mr-5 mr-lg-5" name="submit" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </li>
            </ul>
        </nav>
    </div>

    {{-- Listar Platos / cards de platos --}}
    <div class="container-lg shadow-lg p-3 mb-5 mb-lg-5 mt-3 mt-lg-3 bg-body rounded text-center h-auto">
        <h1 class=" my-4" id="platos">Menu de platos</h1>
        <div class="d-flex flex-wrap flex-row justify-content-lg-around justify-content-center">
            @foreach ($dishes as $dish)
                <div class="card text-center" style="width: 22rem; margin-bottom: 20px;">
                    @if ($dish->image)
                        <img class="card-img-top" src="{{ asset('storage' . $dish->image->url) }}" alt="Plato a pedir">
                    @else
                        <img class="card-img-top h-50" src="{{ asset('img/dishes.png') }}" alt="Plato a pedir">
                        {{-- <img class="card-img-top h-50" src="{{ asset($dish->image->url) }}" alt="Plato a pedir"> --}}
                    @endif
                    <div class="card-body">
                        <h2 class="card-title h4">{{ $dish->name }}</h2>
                        <p class="card-text">{{ $dish->description }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><small class="text-muted">{{ $dish->stock }} Uds.</small></li>
                        <li class="list-group-item"><small class="text-muted">$/ {{ $dish->price }} </small></li>
                    </ul>
                    <div class="card-body">
                        <x-adminlte-button id="{{ $dish->id }}" name="{{ $dish->price }}"
                            icon="fas fa-plus text-red" label="Agregar" data-toggle="modal"
                            class="btn btn-primary modalDish" />
                        {{-- <button type="button" class="btn btn-success modalDish" data-bs-toggle="modal"
                            id="{{ $dish->id }}" name="{{ $dish->price }}">
                            <i class="fas fa-plus text-red">Agregar</i> --}}
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Listar Bebidas / cards de bebidas --}}
    <div class="shadow-lg p-3 mb-5 mb-lg-5 mt-3 mt-lg-3 bg-body rounded container-lg text-center">
        <h1 class=" my-4" id="bebidas">Menu de bebidas</h1>
        <div class="d-flex flex-wrap flex-row justify-content-lg-around justify-content-center">
            @foreach ($drinks as $drink)
                <div class="card" style="width: 22rem; margin-bottom: 20px">
                    @if ($drink->image)
                        <img class="card-img-top h-50" src="{{ asset('storage' . $drink->image->url) }}"
                            alt="Bebida a pedir">
                    @else
                        <img class="card-img-top h-50" src="{{ asset('img/drinks.png') }}" alt="Bebida a pedir">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $drink->name }}</h5>
                        <p class="card-text">{{ $drink->description }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><small class="text-muted">{{ $drink->stock }} Uds.</small></li>
                        <li class="list-group-item"><small class="text-muted">$/ {{ $drink->price }} </small></li>
                    </ul>
                    <div class="card-body">
                        <x-adminlte-button id="{{ $drink->id }}" name="{{ $drink->price }}"
                            icon="fas fa-plus text-red" label="Agregar" data-toggle="modal"
                            class="btn btn-primary modalDrink" />
                        {{-- <a href="#" class="card-link">Card link</a>
        <a href="#" class="card-link">Another link</a> --}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Listar Licores / cards de licores --}}
    <div class="shadow-lg p-3 mb-5 mb-lg-5 mt-3 mt-lg-3 bg-body rounded container-lg text-center">
        <h1 class=" my-4" id="licores">Menu de licores</h1>
        <div class="d-flex flex-wrap flex-row justify-content-lg-around justify-content-center">
            @foreach ($spirits as $spirit)
                <div class="card" style="width: 22rem; margin-bottom: 20px">
                    @if ($spirit->image)
                        <img class="card-img-top h-50" src="{{ asset('storage' . $spirit->image->url) }}"
                            alt="Licor a pedir">
                    @else
                        <img class="card-img-top h-50" src="{{ asset('img/spirits.png') }}" alt="Licor a pedir">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $spirit->name }}</h5>
                        <p class="card-text">{{ $spirit->description }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><small class="text-muted">{{ $spirit->stock }} Uds.</small>
                        </li>
                        <li class="list-group-item"><small class="text-muted">$/ {{ $spirit->price }} </small></li>
                    </ul>
                    <div class="card-body">
                        <x-adminlte-button id="{{ $spirit->id }}" name="{{ $spirit->price }}"
                            icon="fas fa-plus text-red" label="Agregar" data-toggle="modal"
                            class="btn btn-primary modalSpirit" />
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- paginacion --}}
    <div class="pagination justify-content-center m-lg-3 m-3">
        {{ $dishes->links() }}
    </div>
    <div class="container w-50">
        <div id="carouselExampleIndicators" class="carousel slide text-dark" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                    class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('img/spirits.png') }}" class="d-block w-100" alt="...">
                </div>
                @foreach ($recomend->slice(0, 2) as $rec)
                    <div class="carousel-item">
                        <img src="{{ asset('storage' . $rec->url) }}" class="d-block w-100" alt="...">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    {{-- Modal de bootstraps --}}
    <div class="modal fade" id="ModalDishes" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Agregar plato al pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dish.orders.store') }}" method="POST" class="text-center">
                        <div>
                            @csrf
                            <input type="text" name="id" id="idDi" hidden>
                            <input type="text" name="idOrder" id="idDiOrder" hidden>
                            <input type="text" name="priceDish" id="priceDish" hidden>
                            <div class="form-floating mb-3 mx-3 mx-lg-3">
                                <input type="number" class="form-control" id="floatingInput"
                                    placeholder="Cantidad a solicitar; Ejem.: 4" required name="quantify">
                                <label for="floatingInput">Cantidad</label>
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
    <div class="modal fade" id="ModalDrinks" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Agregar licor al pedido"</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('drink.orders.store') }}" method="POST" class="text-center">
                    <div class="modal-body">
                        <div>
                            @csrf
                            <input type="text" name="id" id="idDr" hidden>
                            <input type="text" name="idOrder" id="idDrOrder" hidden>
                            <input type="text" name="priceDrink" id="priceDrink" hidden>
                            <div class="form-floating mb-3 mx-3 mx-lg-3">
                                <input type="number" class="form-control" id="floatingInput"
                                    placeholder="Cantidad a solicitar, ejem.: 4" name="quantify" required>
                                <label for="floatingInput">Cantidad</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right">
                        <x-adminlte-button type="submit" class="mr-auto w-25" theme="success" label="Solicitar" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalSpirits" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Agregar plato al pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('spirit.orders.store') }}" method="POST" class="text-center">
                    <div class="modal-body">
                        <div>
                            @csrf
                            <input type="text" name="id" id="idSp" hidden>
                            <input type="text" name="idOrder" id="idSpOrder" hidden>
                            <input type="text" name="priceSpirit" id="priceSpirit" hidden>
                            <div class="form-floating mb-3 mx-3 mx-lg-3">
                                <input type="number" class="form-control" id="floatingInput"
                                    placeholder="Cantidad a solicitar, ejem.: 4" name="quantify" required>
                                <label for="floatingInput">Cantidad</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right">
                        <x-adminlte-button type="submit" class="mr-auto w-25" theme="success" label="Solicitar" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- menssages --}}
    @if (Session::has('message-order'))
        <div aria-live="polite" aria-atomic="true"
            class="d-flex justify-content-end align-items-center w-100 mb-2 mb-lg-2 btn-flotante">
            <!-- Then put toasts within -->
            <div id="toast1" class="toast bg-green" role="alert" aria-live="assertive" aria-atomic="true"
                data-delay="5000">
                <div class="toast-header">
                    <i class="far fa-check-circle green"></i>
                    <strong class="mr-auto ml-1">Finalizado</strong>
                    <small>{{ date('m-d-Y h:i:s a') }}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ Session::get('message-order') }}
                </div>
            </div>
        </div>
    @endif

    @if (Session::has('error-order'))
        <div aria-live="polite" aria-atomic="true"
            class="d-flex justify-content-end align-items-center w-100 mb-2 mb-lg-2 btn-flotante">
            <!-- Then put toasts within -->
            <div id="toast1" class="toast bg-red" role="alert" aria-live="assertive" aria-atomic="true"
                data-delay="5000">
                <div class="toast-header ">
                    <i class="fas fa-exclamation-triangle"></i>
                    {{-- <img src="{{ asset('favicon/dishx24.png') }}" class="rounded me-2" alt="icono-dish"> --}}
                    <strong class="mr-auto ml-1">Error</strong>
                    <small>{{ date('m-d-Y h:i:s a') }}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ Session::get('error-order') }}
                </div>
            </div>
        </div>
    @endif


    {{-- Message --}}
    @if (Session::has('message'))
        <div aria-live="polite" aria-atomic="true"
            class="d-flex justify-content-end align-items-center mb-5 mb-lg-5 w-auto">
            <!-- Then put toasts within -->
            <div id="toast1" class="toast btn-flotante w-auto" role="alert" aria-live="assertive" aria-atomic="true"
                data-delay="5000">
                <div class="toast-header">
                    <i class="far fa-check-circle green rounded me-2"></i>
                    <strong class="mr-auto ml-1">Finalizado</strong>
                    <small>{{ date('m-d-Y h:i:s a') }}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ Session::get('message') }}
                </div>
            </div>
        </div>
    @endif
    {{-- Message Error --}}
    @if (Session::has('error'))
        <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-end align-items-center mb-5 mb-lg-5">
            <!-- Then put toasts within -->
            <div id="toast1" class="toast btn-flotante w-auto" role="alert" aria-live="assertive" aria-atomic="true"
                data-delay="5000">
                <div class="toast-header bg-red ">
                    <i class="far fa-check-circle green"></i>
                    <strong class="mr-auto ml-1">Error</strong>
                    <small>{{ date('m-d-Y h:i:s a') }}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body bg-red-400">
                    {{ Session::get('error') }}
                </div>
            </div>
        </div>
    @endif
    @extends('layouts.footers.footer')
@stop
@section('js')
    <script>
        $(document).ready(function() {
            $('.modalDish').click(function() {
                var id = this.id;
                var name = this.name;
                document.querySelector('#idDi').value = id;
                var b = document.querySelector('#priceDish').value = name;
                @if (Session::has('orderId'))
                    var a = document.querySelector('#idDiOrder').value = {{ Session::get('orderId') }};
                @endif
                $('#ModalDishes').modal('show');
            });
            $('.modalDrink').click(function() {
                var id = this.id;
                var name = this.name;
                // dish id
                document.querySelector('#idDr').value = id;
                document.querySelector('#priceDrink').value = name;
                @if (Session::has('orderId'))
                    document.querySelector('#idDrOrder').value = {{ Session::get('orderId') }};
                @endif
                $('#ModalDrinks').modal('show');
            });
            $('.modalSpirit').click(function() {
                var id = this.id;
                var name = this.name;
                document.querySelector('#idSp').value = id;
                document.querySelector('#priceSpirit').value = name;
                @if (Session::has('orderId'))
                    document.querySelector('#idSpOrder').value = {{ Session::get('orderId') }};
                @endif
                $('#ModalSpirits').modal('show');
            });

            @if (Session::has('orderId'))
                document.querySelector('#idOrder').value = 'Generado';
                // document.querySelector('#idOrder').id = {{ Session::get('orderId') }};
            @endif
        });
    </script>
    <script>
        $('#to-button').on("click", function() {
            // presentar la cuenta de clicks realizados sobre el elemento con id "prueba"
            setTimeout(() => {
                window.scrollTo({
                    left: 0,
                    // top: (window.screen.height / 1.1),
                    top: window.innerHeight,
                    behavior: "smooth"
                });
            });
        });
    </script>
@stop
