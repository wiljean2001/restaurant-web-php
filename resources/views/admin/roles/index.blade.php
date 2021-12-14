@extends('adminlte::page')

@section('title', 'Roles')

@section('content')
    <div class="d-flex flex-wrap flex-row justify-content-around">
        <div class="text-center container">
            <h1 class="py-lg-2 py-2 text-left">MOSTRAR ROLES Y USUARIOS</h1>
            <form action="{{ route('role.update') }}" method="POST">
                @csrf
                <table class="table text-left  px-5 px-lg-5 table-responsive-lg">
                    <thead>
                        <tr>
                            <th scope="col">Usuario</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Cambiar rol</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $row)
                            <tr>
                                <td>{!! $row->userName !!}</td>
                                <td>{!! $row->userEmail !!}</td>
                                <td>{!! $row->rolName !!}</td>
                                <td>
                                    <input type="number" name="idUser[]" value="{!! $row->userID !!}" hidden>
                                    <select class="form-select" name="uptoRol[]">
                                        @foreach ($roles as $rol)
                                            @if ($rol->name == $row->rolName)
                                                <option value="{!! $rol->id !!}" selected>{!! $rol->name !!}
                                                </option>
                                            @else
                                                <option value="{!! $rol->id !!}">{!! $rol->name !!}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <x-adminlte-button type="submit" label="GUARDAR CAMBIOS" theme="warning" icon="fas fa-pen-square" />
            </form>
        </div>
    </div>

    <div class="mt-4 mt-lg-4">
        <a href="{{ route('register-user') }}" class="btn btn-xs btn-default text-primary mx-1 shadow text-right"
            title="Edit">
            <i class="fas fa-user-plus"></i>
            {{ __('Registrar Usuario') }}
        </a>
        <a href="" class="btn btn-xs btn-default text-primary mx-1 shadow text-right" title="Edit">
            <i class="fas fa-user-edit"></i>
            {{ __('Editar Usuario') }}
        </a>
    </div>
@stop
@extends('layouts.footers.footer')


@section('js')
@stop
