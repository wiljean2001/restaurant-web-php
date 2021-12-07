@extends('adminlte::page')

@section('title', 'Mesa')
{{-- $table->integer('capacity')->nullable(false)->default(1);
            $table->boolean('state')->nullable(false)->default(false); --}}
@section('content')
    <div class="shadow-lg p-3 mb-5 mb-lg-5 mt-3 mt-lg-3 bg-body rounded container">
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
                        <label for="capacity">Ingresar capacidad</label>
                        <div class="form-group">
                            <input type="int" class="form-control focused w-100" placeholder="2" name="capacity" required
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
                <x-adminlte-datatable id="table3" :heads="$heads" head-theme="dark" :config='$config' with-buttons
                    with-footer>
                    @foreach ($tables as $row)
                        <tr>
                            <td>{!! $row->id !!}</td>
                            <td>{!! $row->num_table !!}</td>
                            <td>
                                @if ($row->state == true)
                                    Ocupado
                                @else
                                    disponible
                                @endif
                            </td>
                            <td>{!! $row->capacity !!}</td>
                            <td>
                                <div>
                                    <input type="text" value="{!! $row->state !!}" id="state_table" hidden>
                                    <input type="text" value="{!! $row->capacity !!}" id="capacity_table" hidden>
                                    <x-adminlte-button id="{!! $row->id !!}" name="{!! $row->num_table !!}"
                                        icon="fas fa-pen-square" label="Editar" data-toggle="modal"
                                        class="btn btn-primary modalTableEdit w-auto m-1 m-lg-1" theme="warning" />
                                    <x-adminlte-button id="{!! $row->id !!}" icon="fas fa-pen-square"
                                        label="Eliminar" data-toggle="modal"
                                        class="btn btn-primary modalTableDel w-auto m-1 m-lg-1" theme="warning" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </div>
        </div>
    </div>
    <!-- Modal  -----  tables edit-->
    <div class="modal fade" id="ModalTablesEdit" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Agregar plato al pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('table.update') }}" method="POST" class="text-center">
                        <div>
                            @csrf
                            <input type="text" name="id" id="idTable" hidden>
                            <div class="form-floating mb-3 mx-3 mx-lg-3">
                                <input type="text" class="form-control" id="numtable" placeholder="A6" required
                                    name="nameTable" disabled>
                                <label for="numtable">Ingresar nombre de mesa</label>
                            </div>
                            <div class="form-floating mb-3 mx-3 mx-lg-3">
                                <input type="number" class="form-control" id="capac_table" placeholder="6" required
                                    name="capacity">
                                <label for="capac_table">Capacidad</label>
                            </div>
                            <div>
                                <label for="stateTable">Estado</label>
                                <input type="checkbox" class="" id="stateTable" name="state" value="1">
                                <strong>Ocupado - disponible</strong>
                            </div>
                            <x-adminlte-button type="submit" class="mr-auto w-25" theme="success" label="Actualizar" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer text-right">
                </div>
            </div>
        </div>
    </div>
    <!-- Modal  ----------  tables destroy-->
    <div class="modal fade" id="ModalTablesDel" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">¿Desea eliminar la mesa?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('table.delete') }}" method="POST" class="text-center">
                        @csrf
                        <input type="text" name="id" id="idTableDel" hidden>
                        <x-adminlte-button type="submit" class="mr-auto w-25" theme="danger" label="Eliminar" />
                    </form>
                </div>
                <div class="modal-footer text-right">
                </div>
            </div>
        </div>
    </div>

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
            document.querySelector('#idTable').value = id;
            document.querySelector('#numtable').value = name;
            var state = document.querySelector('#state_table').value;
            var capacity = document.querySelector('#capacity_table').value;
            if (state == 1) {
                document.querySelector('#stateTable').checked = true;
            } else {
                document.querySelector('#stateTable').checked = false;
            }
            document.querySelector('#capac_table').value = capacity;

            $('#ModalTablesEdit').modal('show');
        });
        $('.modalTableDel').click(function() {
            var id = this.id;
            // table id
            document.querySelector('#idTableDel').value = id;
            $('#ModalTablesDel').modal('show');
        });
    </script>
@endpush
