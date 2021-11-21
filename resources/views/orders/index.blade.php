@extends('layouts.order')

@section('content')

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
{{-- Listar Platos --}}
<div class="container text-center card w-80 mb-lg-5 mb-5">
  <h1 class=" my-4">Menu de platos</h1>
  <div class="d-flex flex-wrap flex-row justify-content-lg-between justify-content-center">
    @foreach ($dishes as $dish)

    <div class="card" style="width: 22rem; margin-bottom: 20px">
      <img class="card-img-top h-50" src="{{ asset('files/dishes/' . $dish->image) }}" alt="Plato a pedir">
      <div class="card-body">
        <h4 class="card-title">{{ $dish->name }}</h4>
        <p class="card-text">{{ $dish->description }}</p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><small class="text-muted">{{ $dish->stock }} Uds.</small></li>
        <li class="list-group-item"><small class="text-muted">$/ {{ $dish->price }} </small></li>
        {{-- <li class="list-group-item">A second item</li>
        <li class="list-group-item">A third item</li> --}}
      </ul>
      <div class="card-body">
        <button id="{{ $dish->id }}" type="button" class="btn btn-primary mymodal" data-toggle="modal">
          <i class="fas fa-plus text-red"></i>
          <label for="Solicitar">Agregar</label>
        </button>
        {{-- <a href="#" class="card-link">Card link</a>
        <a href="#" class="card-link">Another link</a> --}}
      </div>
    </div>
    @endforeach

  </div>
  {{-- paginacion --}}
  <div class="pagination justify-content-center m-lg-3 m-3">
    {{ $dishes->links() }}
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('order.dish.store') }}" method="POST">
        <div class="modal-body">
          @csrf
          <input type="text" name="id" id="id" hidden>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Solicitar</button>
        </div>
      </form>
    </div>
  </div>
</div>


{{-- Listar Sugerencias --}}

{{-- Listar Bebidas --}}
<div class="container text-center card w-80 mb-lg-5 mb-5">
  <h1 class=" my-4">Menu de bebidas</h1>

  <div class="d-flex flex-wrap flex-row justify-content-lg-between mb-lg-3">
    @foreach ($drinks as $drink)

    <div class="card" style="width: 22rem;">
      <img class="card-img-top h-50" src="{{ asset('files/drinks/' . $drink->image) }}" alt="Plato a pedir">
      <div class="card-body">
        <h5 class="card-title">{{ $drink->name }}</h5>
        <p class="card-text">{{ $drink->description }}</p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><small class="text-muted">{{ $drink->stock }} Uds.</small></li>
        {{-- <li class="list-group-item">A second item</li>
        <li class="list-group-item">A third item</li> --}}
      </ul>
      <div class="card-body">
        <a href="">
          <i class="fas fa-plus text-red"></i>
        </a>
        <button type="button" class="btn btn-default my-1" data-container="body" data-toggle="popover"
          data-placement="left" data-content="{{ $drink->description }}">
          <i class="fas fa-info"></i>
        </button>
        {{-- <a href="#" class="card-link">Card link</a>
        <a href="#" class="card-link">Another link</a> --}}
      </div>
    </div>
    @endforeach

  </div>
  {{-- paginacion --}}
  <div class="pagination justify-content-center m-lg-3 m-3">
    {{ $drinks->links() }}
  </div>
</div>

{{-- Listar Licores --}}
<div class="container text-center card w-80 mb-lg-5 mb-5">
  <h1 class=" my-4">Menu de licores</h1>

  <div class="d-flex flex-wrap flex-row justify-content-lg-between mb-lg-3">
    @foreach ($spirits as $spirit)

    <div class="card" style="width: 22rem;">
      <img class="card-img-top h-50" src="{{ asset('files/spirits/' . $spirit->image) }}" alt="Plato a pedir">
      <div class="card-body">
        <h5 class="card-title">{{ $spirit->name }}</h5>
        <p class="card-text">{{ $spirit->description }}</p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><small class="text-muted">{{ $spirit->stock }} Uds.</small></li>
        {{-- <li class="list-group-item">A second item</li>
        <li class="list-group-item">A third item</li> --}}
      </ul>
      <div class="card-body">
        <a href="">
          <i class="fas fa-plus text-red"></i>
        </a>
        <button type="button" class="btn btn-default my-1" data-container="body" data-toggle="popover"
          data-placement="left" data-content="{{ $spirit->description }}">
          <i class="fas fa-info"></i>
        </button>
        {{-- <a href="#" class="card-link">Card link</a>
        <a href="#" class="card-link">Another link</a> --}}
      </div>
    </div>
    @endforeach

  </div>
  {{-- paginacion --}}
  <div class="pagination justify-content-center m-lg-3 m-3">
    {{ $spirits->links() }}
  </div>
</div>
@endsection
@section('js')
<script>
  $(document).ready(function() {
    $('.mymodal').click(function() {
        var id = this.id;
        $('#id').val(id);
        $('#exampleModal').modal({ 
            show: true 
        });

    });
  });
</script>
<script>
  $('#to-button').on("click", function () {
    // presentar la cuenta de clicks realizados sobre el elemento con id "prueba"
    setTimeout(() => {
        window.scrollTo({
            left: 0,
            top: (window.screen.height/1.1),
            behavior: "smooth"
        });
    });
  });
</script>
@endsection