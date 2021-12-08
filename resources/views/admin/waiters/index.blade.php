@extends('adminlte::page')
@section('plugins.TempusDominusBs4', true)
@section('title', 'Mesa')
@section('content')
    <div class="shadow-lg p-3 mb-5 mb-lg-5 mt-3 mt-lg-3 bg-body rounded container">
        <div class="d-flex flex-row w-100 flex-wrap justify-content-center">
            <div class="w-100">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            REGISTRAR MOZOS
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <form action="{{ route('waiter.register') }}" method="POST" class="d-flex flex-column"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-auto">
                                    <label for="name">DNI:</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control focused w-100" placeholder="Ej. 73889330"
                                            name="dni" required>
                                    </div>
                                    <label for="name">Nombre:</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control focused w-100" placeholder="Wilmer"
                                            name="name" required>
                                    </div>
                                    <label for="name">Apellidos:</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control focused w-100" placeholder="Ayala Garcia "
                                            name="lname" required>
                                    </div>
                                    <div class="form-group">
                                        <x-adminlte-input-date name="date_of_birth" label="Fecha de nacimiento"
                                            igroup-size="sm" :config="$config" placeholder="Choose a working day...">
                                            <x-slot name="appendSlot">
                                                <div class="input-group-text bg-dark">
                                                    <i class="fas fa-calendar-day"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input-date>
                                    </div>
                                </div>
                                <div class="col-md-auto text-center mt-4 mt-lg-4">
                                    <input type="submit" class="btn bg-gradient-purple w-75 py-2 py-lg-2" name="register"
                                        value="REGISTRAR MOZO">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-2 p-lg-2 table-responsive">
                <x-adminlte-datatable id="table3" :heads="$heads" head-theme="dark" :config='$configTable' with-buttons
                    with-footer>
                    @foreach ($waiters as $key => $row)
                        <tr>
                            <td>{!! $key + 1 !!}</td>
                            <td>{!! $row->dni !!}</td>
                            <td>{!! $row->name !!}</td>
                            <td>{!! $row->lname !!}</td>
                            <td>{!! $row->date_of_birth !!}</td>
                            <td>
                                <div>
                                    <x-adminlte-button id="{!! $row->id !!}" icon="fas fa-pen-square" label="Editar"
                                        data-toggle="modal" class="btn btn-primary modalWaiterEdit w-auto m-1 m-lg-1"
                                        theme="warning" />
                                    <x-adminlte-button id="{!! $row->id !!}" icon="fas fa-pen-square"
                                        label="Eliminar" data-toggle="modal"
                                        class="btn btn-primary modalWaiterDel w-auto m-1 m-lg-1" theme="warning" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </div>
        </div>
    </div>
    <!-- Modal  -----  waiter edit-->
    <div class="modal fade" id="ModalWaiterEdit" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Actualizar mozo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('waiter.update') }}" method="POST" class="d-flex flex-column"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-auto">
                            <input type="text" name="id" id="idWaiterEdit" hidden>
                            <label for="name">Nombre:</label>
                            <div class="form-group">
                                <input type="text" class="form-control focused w-100" placeholder="Wilmer" name="name"
                                    required id="nameWaiterEdit">
                            </div>
                            <label for="name">Apellidos:</label>
                            <div class="form-group">
                                <input type="text" class="form-control focused w-100" placeholder="Ayala Garcia"
                                    name="lname" required id="lnameWaiterEdit">
                            </div>
                            <div class="form-group">
                                <x-adminlte-input-date name="date_of_birth" label="Fecha de nacimiento" igroup-size="sm"
                                    :config="$config" placeholder="Selecciona la fecha de nacimiento..."
                                    id="date_of_birthEdit">
                                    <x-slot name="appendSlot">
                                        <div class="input-group-text bg-dark">
                                            <i class="fas fa-calendar-day"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input-date>
                            </div>
                        </div>
                        <div class="col-md-auto text-center mt-4 mt-lg-4">
                            <input type="submit" class="btn bg-gradient-purple w-75 py-2 py-lg-2" name="register"
                                value="ACTUALIZAR MOZO">
                        </div>
                    </form>
                </div>
                <div class="modal-footer text-right">
                </div>
            </div>
        </div>
    </div>
    <!-- Modal  ----------  waiter destroy-->
    <div class="modal fade" id="ModalWaiterDel" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">¿Desea eliminar al mozo?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('waiter.delete') }}" method="POST" class="d-flex flex-column"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id" id="idWaiterDel" hidden>
                        <div class="col-md-auto text-center mt-4 mt-lg-4">
                            <input type="submit" class="btn bg-gradient-danger w-75 py-2 py-lg-2" name="register"
                                value="ELIMINAR MOZO">
                        </div>
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
                    <small>{{ date('d-m-Y h:i:s a') }}</small>
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
                    <small>{{ date('d-m-Y h:i:s a') }}</small>
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
        $('.modalWaiterEdit').click(function() {
            var table = $('#table3').DataTable();
            var id = this.id;
            var row = $(this).parent().parent()[0];
            var data = table.row(row).data();
            document.querySelector('#idWaiterEdit').value = id;
            document.querySelector('#nameWaiterEdit').value = data[2];
            document.querySelector('#lnameWaiterEdit').value = data[3];
            document.querySelector('#date_of_birthEdit').value = data[4];
            // console.log(data[2]);
            $('#ModalWaiterEdit').modal('show');
        });
        $('.modalWaiterDel').click(function() {
            var id = this.id;
            // table id
            document.querySelector('#idWaiterDel').value = id;
            $('#ModalWaiterDel').modal('show');
        });
    </script>
@endpush
