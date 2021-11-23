@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    @can('admin.auth')
        <div class="wrapper">
        @endcan
        @can('admin.auth')
            {{-- Top Navbar --}}
            @if ($layoutHelper->isLayoutTopnavEnabled())
                @include('adminlte::partials.navbar.navbar-layout-topnav')
            @else
                @include('adminlte::partials.navbar.navbar')
            @endif

            {{-- Left Main Sidebar --}}
            @if (!$layoutHelper->isLayoutTopnavEnabled())
                @include('adminlte::partials.sidebar.left-sidebar')
            @endif
        @endcan

        {{-- Content Wrapper --}}
        @empty($iFrameEnabled)
            @include('adminlte::partials.cwrapper.cwrapper-default')
        @else
            @include('adminlte::partials.cwrapper.cwrapper-iframe')
        @endempty

        @can('admin.auth')
            {{-- Footer --}}
            @hasSection('footer')
                @include('adminlte::partials.footer.footer')
            @endif

            {{-- Right Control Sidebar --}}
            @if (config('adminlte.right_sidebar'))
                @include('adminlte::partials.sidebar.right-sidebar')
            @endif
        @endcan
        @can('admin.auth')
        </div>
    @endcan
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
