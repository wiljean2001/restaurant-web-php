@extends('adminlte::page')

@section('title', 'Mesa')

@section('content')
<div class="d-flex flex-row w-100 flex-wrap justify-content-center">
    <div class="w-100">
        <h1 class="my-lg-2 mt-3 mt-lg-3">REGISTRAR MESA</h1>
        <form action=" {{ route('table.create') }}" method="POST" class="d-flex flex-column"
            enctype="multipart/form-data">
            @csrf
            <div class="col-md-auto">
                <label for="name">Ingresar nombre de mesa</label>
                <div class="form-group">
                    <input type="text" class="form-control focused w-100" placeholder="A5" name="num_table" required
                        id="name">
                </div>
            </div>
            <div class="col-md-auto text-center mt-4 mt-lg-4">
                <input type="submit" class="btn bg-gradient-purple w-75 py-2 py-lg-2" name="register"
                    value="REGISTRAR MESA">
            </div>
        </form>
    </div>
    <div class="p-2 p-lg-2 table-responsive w-auto">
        <x-adminlte-datatable id="table3" :heads="$heads" head-theme="dark" :config='$config' with-buttons with-footer>
            @foreach($tables as $row)
            <tr>
                <td>{!! $row->id !!}</td>
                <td>{!! $row->num_table !!}</td>
                <td>
                    <div>
                        <x-adminlte-button id="{!! $row->id !!}" name="{!! $row->num_table !!}" icon="fas fa-pen-square"
                            label="Editar" data-toggle="modal" class="btn btn-primary modalTableEdit" theme="warning" />
                        <x-adminlte-button id="{!! $row->id !!}" icon="fas fa-pen-square" label="Eliminar"
                            data-toggle="modal" class="btn btn-primary modalTableDel" theme="warning" />
                    </div>
                </td>
            </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>
</div>
<!-- Modal ADMINLTE ----------  tables edit-->
<x-adminlte-modal id="ModalTablesEdit" title="Agregar plato al pedido" size="lg" theme="teal" icon="fas fa-bell"
    v-centered static-backdrop scrollable>
    <form action="{{ route('table.update') }}" method="POST" class="text-center">
        @csrf
        <div>
            <input type="text" name="id" id="idTable" hidden>
            <div class="form-floating mb-3 mx-3 mx-lg-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="A6" required name="nameTable">
                <label for="floatingInput">Ingresar nombre de mesa</label>
            </div>
        </div>
        <x-adminlte-button type="submit" class="mr-auto w-25" theme="success" label="Actualizar" />
    </form>
    <x-slot name="footerSlot">
        <x-adminlte-button theme="danger" label="Cerrar" data-dismiss="modal" />
    </x-slot>
</x-adminlte-modal>

<!-- Modal ADMINLTE ----------  tables destroy-->
<x-adminlte-modal id="ModalTablesDel" title="Desea eliminar la mesa?" size="ms" theme="maroon" icon="fas fa-bell"
    v-centered static-backdrop scrollable>
    <form action="{{ route('table.delete') }}" method="POST" class="text-center">
        @csrf
        <input type="text" name="id" id="idTableDel" hidden>
        <x-adminlte-button type="submit" class="mr-auto w-25" theme="success" label="Eliminar" />
    </form>

    <x-slot name="footerSlot">
        <x-adminlte-button theme="danger" label="Cerrar" data-dismiss="modal" />
    </x-slot>
</x-adminlte-modal>

@if (Session::has('message'))

<div aria-live="polite" aria-atomic="true"
    class="d-flex justify-content-end align-items-center w-100 mb-5 mb-lg-5 btn-flotante">
    <!-- Then put toasts within -->
    <div id="toast1" class="toast bg-green" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
        <div class="toast-header">
            <i class="far fa-check-circle green"></i>
            <strong class="mr-auto ml-1">Finalizado</strong>
            <small>{{ Time() }}</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session::get('message') }}
        </div>
    </div>
</div>
@endif

@if (Session::has('error'))
<div aria-live="polite" aria-atomic="true"
    class="d-flex justify-content-end align-items-center w-100 mb-5 mb-lg-5 btn-flotante">
    <!-- Then put toasts within -->
    <div id="toast1" class="toast bg-red" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
        <div class="toast-header ">
            <i class="fas fa-exclamation-triangle"></i>
            <strong class="mr-auto ml-1">Error</strong>
            <small>{{ time() }}</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session::get('error') }}
        </div>
    </div>
</div>
@endif

@stop
@extends('layouts.footers.footer')


@push('js')
<script>
    $('.modalTableEdit').click(function() {
      var id = this.id;
      var name = this.name;
      // table id
      $('#idTable').val(id);
      $('#floatingInput').val(name);
      
      $('#ModalTablesEdit').modal({
        show: true
      });
    });
$('.modalTableDel').click(function() {
      var id = this.id;
      // table id
      $('#idTableDel').val(id);
      $('#ModalTablesDel').modal({
        show: true
      });
    });
</script>
@endpush