{{-- @extends('layouts.order') --}}
@extends('adminlte::page')
@section('title', 'Orden')

@section('css')
<link rel="stylesheet" href="{{ asset('css/order.css') }}">
@stop
@section('content')
{{-- HEADER --}}
<div class="header py-0 py-lg-0 bi-header h-auto">
  <nav class="nav justify-content-end py-lg-4 py-4 px-lg-3 px-3">
    <a class="nav-link text-dark outline-white" href="{{ route('login') }}">
      <i class="fas fa-lock"></i>
      <span>{{ __('Iniciar sesión') }}</span>
    </a>
    <a class="nav-link text-dark" href="{{ route('register') }}">
      <i class="fas fa-user"></i>
      <span>{{ __('Registrar') }}</span>
    </a>
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
    <a href="{{ route('order.show', Session::get('tableID')) }}"><i class="fas fa-eye"></i></a>
    <a href="#"><i class="fas fa-minus-square"></i></a>
    <a href="#"><i class="fas fa-edit"></i></a>
  </div>
  <div class="btn-mas">
    <label for="btn-mas" class="fa fa-plus"></label>
  </div>
</div>
{{-- menu order --}}
<div class="bg-white">
  <nav id="navbar-example2" class="navbar navbar-light bg-white px-3" data-bs-spy="scroll">
    {{-- <a class="navbar-brand" href="#">Navbar</a> --}}
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link" href="#scrollspyHeading1">
          <i class="fas fa-stream"></i> Ver platos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#scrollspyHeading2">
          <i class="fas fa-stream"></i> Ver bebidas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#scrollspyHeading3">
          <i class="fas fa-stream"></i> Ver licores</a>
      </li>
    </ul>
    <ul class="nav nav-pills ">
      <form action="{{ route('order.create') }}" method="POST" class="d-flex flex-row flex-wrap justify-content-around">
        @csrf
        <li class="nav-item mr-4 mr-lg-4">
          <x-adminlte-select name="idTable" label-class="text-lightblue" igroup-size="sm">
            <x-slot name="prependSlot">
              <div class="input-group-text">
                {{ __('Mesas:') }}
              </div>
            </x-slot>
            @if (Session::has('tableID'))
            <option value="{{ Session::get('tableID') }}" selected>Mesa {{ Session::get('tableID') }}</option>
            @endif

            @foreach ($tables as $table)
            @if ($table->state == false)
            <option value="{{ $table->id }}">Mesa {{ $table->num_table }}</option>
            @endif
            @endforeach
          </x-adminlte-select>
        </li>
        <li class="nav-item mr-4 mr-lg-4">
          <x-adminlte-input name="isOrder" igroup-size="sm" disabled class="bg-white" id="isOrder">
            <x-slot name="prependSlot">
              <div class="input-group-text">
                {{ __('Orden:') }}
              </div>
            </x-slot>
          </x-adminlte-input>
        </li>
        <li class="nav-item">
          <x-adminlte-button type="submit" icon="fas fa-plus text-red" label="Crear orden" data-toggle="modal"
            class="btn btn-primary mr-5 mr-lg-5" name="submit" />
        </li>
      </form>
    </ul>
  </nav>
</div>

{{-- Listar Platos / cards de platos --}}
<div class="container text-center card w-80 mb-lg-5 mb-5">
  <h1 class=" my-4" id="scrollspyHeading1">Menu de platos</h1>
  <div class="d-flex flex-wrap flex-row justify-content-lg-between justify-content-center">
    @foreach ($dishes as $dish)

    <div class="card text-center" style="width: 22rem; margin-bottom: 20px;">
      <img class="card-img-top" src="{{ asset('files/dishes/' . $dish->image) }}" alt="Plato a pedir">
      <div class="card-body">
        <h2 class="card-title h4">{{ $dish->name }}</h2>
        <p class="card-text">{{ $dish->description }}</p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><small class="text-muted">{{ $dish->stock }} Uds.</small></li>
        <li class="list-group-item"><small class="text-muted">$/ {{ $dish->price }} </small></li>
      </ul>
      <div class="card-body">
        <x-adminlte-button id="{{ $dish->id }}" name="{{ $dish->price }}" icon="fas fa-plus text-red" label="Agregar"
          data-toggle="modal" class="btn btn-primary modalDish" />
        {{-- <a href="#" class="card-link">Card link</a>
        <a href="#" class="card-link">Another link</a> --}}
      </div>
    </div>
    @endforeach

  </div>
</div>

{{-- Listar Sugerencias --}}
{{-- --}}

{{-- Listar Bebidas / cards de bebidas --}}
<div class="container text-center card w-80 mb-lg-5 mb-5">
  <h1 class=" my-4" id="scrollspyHeading2">Menu de bebidas</h1>

  <div class="d-flex flex-wrap flex-row justify-content-lg-between justify-content-center">
    @foreach ($drinks as $drink)

    <div class="card" style="width: 22rem; margin-bottom: 20px">
      <img class="card-img-top h-50" src="{{ asset('files/drinks/' . $drink->image) }}" alt="Plato a pedir">
      <div class="card-body">
        <h5 class="card-title">{{ $drink->name }}</h5>
        <p class="card-text">{{ $drink->description }}</p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><small class="text-muted">{{ $drink->stock }} Uds.</small></li>
        <li class="list-group-item"><small class="text-muted">$/ {{ $drink->price }} </small></li>
      </ul>
      <div class="card-body">
        <x-adminlte-button id="{{ $dish->id }}" name="{{ $drink->price }}" icon="fas fa-plus text-red" label="Agregar"
          data-toggle="modal" class="btn btn-primary modalDrink" />
        {{-- <a href="#" class="card-link">Card link</a>
        <a href="#" class="card-link">Another link</a> --}}
      </div>
    </div>
    @endforeach

  </div>
</div>

{{-- Listar Licores / cards de licores --}}
<div class="container text-center card w-80 mb-lg-5 mb-5">
  <h1 class=" my-4" id="scrollspyHeading3">Menu de licores</h1>

  <div class="d-flex flex-wrap flex-row justify-content-lg-between justify-content-center">
    @foreach ($spirits as $spirit)

    <div class="card" style="width: 22rem; margin-bottom: 20px">
      <img class="card-img-top h-50" src="{{ asset('files/spirits/' . $spirit->image) }}" alt="Plato a pedir">
      <div class="card-body">
        <h5 class="card-title">{{ $spirit->name }}</h5>
        <p class="card-text">{{ $spirit->description }}</p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><small class="text-muted">{{ $spirit->stock }} Uds.</small></li>
        <li class="list-group-item"><small class="text-muted">$/ {{ $spirit->price }} </small></li>
      </ul>
      <div class="card-body">
        <x-adminlte-button id="{{ $dish->id }}" name="{{ $spirit->price }}" icon="fas fa-plus text-red" label="Agregar"
          data-toggle="modal" class="btn btn-primary modalSpirit" />
        {{-- <a href="#" class="card-link">Card link</a>
        <a href="#" class="card-link">Another link</a> --}}
      </div>
    </div>
    @endforeach

  </div>
</div>
{{-- paginacion --}}
<div class="pagination justify-content-center m-lg-3 m-3">
  {{ $spirits->links() }}
</div>

{{-- Message --}}
@if (Session::has('message'))
<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-end align-items-center mb-5 mb-lg-5 w-auto">
  <!-- Then put toasts within -->
  <div id="toast1" class="toast btn-flotante w-auto" role="alert" aria-live="assertive" aria-atomic="true"
    data-delay="5000">
    <div class="toast-header">
      <i class="far fa-check-circle green rounded me-2"></i>
      <strong class="mr-auto ml-1">Finalizado</strong>
      <small>{{ date('m-d-Y h:i:s a'); }}</small>
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
      <small>{{ date('m-d-Y h:i:s a'); }}</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body bg-red-400">
      {{ Session::get('error') }}
    </div>
  </div>
</div>
@endif

<!-- Modal ADMINLTE ----------  Para platos -->
<x-adminlte-modal id="ModalDishes" title="Agregar plato al pedido" size="lg" theme="teal" icon="fas fa-bell" v-centered
  static-backdrop scrollable>
  <form action="{{ route('dish.orders.store') }}" method="POST" class="text-center">
    <div>
      @csrf
      <input type="text" name="id" id="idDi" hidden>
      <input type="text" name="idOrder" id="idDiOrder" hidden>
      <input type="text" name="priceDish" id="priceDish" hidden>
      <div class="form-floating mb-3 mx-3 mx-lg-3">
        <input type="number" class="form-control" id="floatingInput" placeholder="Cantidad a solicitar; Ejem.: 4"
          required name="quantify">
        <label for="floatingInput">Cantidad</label>
      </div>
    </div>
    <x-adminlte-button type="submit" class="mr-auto w-25" theme="success" label="Solicitar" />
  </form>
  <x-slot name="footerSlot">
    <x-adminlte-button theme="danger" label="Cerrar" data-dismiss="modal" />
  </x-slot>
</x-adminlte-modal>

<!-- Modal ADMINLTE ----------  Para bebidas -->
<x-adminlte-modal id="ModalDrinks" title="Agregar bebida al pedido" size="lg" theme="teal" icon="fas fa-bell" v-centered
  static-backdrop scrollable>
  <form action="{{ route('drink.orders.store') }}" method="POST" class="text-center">
    <div>
      @csrf
      <input type="text" name="id" id="idDr" hidden>
      <input type="text" name="idOrder" id="idDrOrder" hidden>
      <input type="text" name="priceDrink" id="priceDrink" hidden>
      <div class="form-floating mb-3 mx-3 mx-lg-3">
        <input type="number" class="form-control" id="floatingInput" placeholder="Cantidad a solicitar, ejem.: 4"
          name="quantify" required>
        <label for="floatingInput">Cantidad</label>
      </div>
    </div>
    <x-adminlte-button type="submit" class="mr-auto w-25" theme="success" label="Solicitar" />
  </form>
  <x-slot name="footerSlot">
    <x-adminlte-button theme="danger" label="Cerrar" data-dismiss="modal" />
  </x-slot>
</x-adminlte-modal>

<!-- Modal ADMINLTE ----------  Para licores -->
<x-adminlte-modal id="ModalSpirits" title="Agregar licor al pedido" size="lg" theme="teal" icon="fas fa-bell" v-centered
  static-backdrop scrollable>
  <form action="{{ route('spirit.orders.store') }}" method="POST" class="text-center">
    <div>
      @csrf
      <input type="text" name="id" id="idSp" hidden>
      <input type="text" name="idOrder" id="idSpOrder" hidden>
      <input type="text" name="priceSpirit" id="priceSpirit" hidden>
      <div class="form-floating mb-3 mx-3 mx-lg-3">
        <input type="number" class="form-control" id="floatingInput" placeholder="Cantidad a solicitar, ejem.: 4"
          name="quantify" required>
        <label for="floatingInput">Cantidad</label>
      </div>
    </div>
    <x-adminlte-button type="submit" class="mr-auto w-25" theme="success" label="Solicitar" />
  </form>
  <x-slot name="footerSlot">
    <x-adminlte-button theme="danger" label="Cerrar" data-dismiss="modal" />
  </x-slot>
</x-adminlte-modal>

@stop
@extends('layouts.footers.footer')

@section('js')

<script>
  $(document).ready(function() {
    $('.modalDish').click(function() {
      var id = this.id;
      var name = this.name;
      // dish id
      $('#idDi').val(id);
      $('#priceDish').val(name);
      // dish orders id
      $('#idDiOrder').val({{ Session::get('orderId') }});
      $('#ModalDishes').modal({
        show: true
      });
    });
    $('.modalDrink').click(function() {
      var id = this.id;
      var name = this.name;
      $('#idDr').val(id);
      $('#priceDrink').val(name);
      $('#idDrOrder').val({{ Session::get('orderId') }});
      $('#ModalDrinks').modal({
          show: true
      });
    });
    $('.modalSpirit').click(function() {
      var id = this.id;
      var name = this.name;
      $('#idSp').val(id);
      $('#priceSpirit').val(name);
      $('#idSpOrder').val({{ Session::get('orderId') }});
      $('#ModalSpirits').modal({
          show: true
      });
    });
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
  $('#to-dish').on("click", function() {

  });
  $('#to-drink').on("click", function() {

  });
  $('#to-spirit').on("click", function() {
    this.scrollIntoView(true);
  });
</script>

<script>
  $(document).ready(function() {
    var idOrder = {{ Session::get('orderId') }};
      $("#idOrder").val(idOrder);
      if (idOrder) {
        $("#isOrder").val('Generado');
      }
      $('.toast').toast('show');
  });
</script>
@stop