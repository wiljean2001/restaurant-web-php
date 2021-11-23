@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@if ($layoutHelper->isLayoutTopnavEnabled())
    @php($def_container_class = 'container')
@else
    @php($def_container_class = 'container-fluid')
@endif
{{-- Default Content Wrapper --}}
@can('admin.auth')
    <div class="content-wrapper {{ config('adminlte.classes_content_wrapper', '') }}">
    @endcan
    {{-- Content Header --}}
    @can('admin.auth')
        @hasSection('content_header')
            <div class="content-header">
                <div class="{{ config('adminlte.classes_content_header') ?: $def_container_class }}">
                    @yield('content_header')
                </div>
            </div>
        @endif
    @endcan
    {{-- Main Content --}}
    @can('admin.auth')
        <div class="content">
            <div class="{{ config('adminlte.classes_content') ?: $def_container_class }}">
            @endcan
            @yield('content')
            @can('admin.auth')
            </div>
        </div>
    </div>
@endcan
