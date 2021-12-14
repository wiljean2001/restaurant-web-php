{{-- @extends('adminlte::auth.register') --}}

@extends('adminlte::page')
@section('title', 'Orden')

@section('content')
    <div class="container card mt-5 mt-lg-5">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Registrar nuevo usuario</p>
            <form action="{{ route('register.new.user') }}" method="post">
                @csrf
                @method('POST')
                <input type="number" name="idRole" value="1" hidden>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Nombre completo" required name="name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" required name="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Contraseña" required name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Repetir contraseña" required
                        name="password_confirmation">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">

                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
    </div>
    </div>
    <div class="d-flex justify-content-end">
        <a href="{{ route('role.show') }}"><i class="fas fa-chevron-circle-left fa-3x"></i></a>
    </div>
@stop
@extends('layouts.footers.footer')
