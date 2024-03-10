@extends('layouts.master')
@section('title')
Gestión de Permisos<br />
@endsection
@section('css')
@endsection
@section('content')
@section('pagetitle')
Permisos
@endsection
<meta name="_token" content="{{ csrf_token() }}">
<div class="uper d-sm-none">
    <div class="card card-header">
        Gestión de Permisos
    </div>
</div>
<div class="table-responsive mt-4">
    <table id="permisos_tbl" class="table table-striped" data-toggle="table" data-url="permisos_list"
        @can('crear permisos')
            data-buttons="btnAgrPermiso"
        @endcan
         data-id-field="id" data-unique-id="id" data-search="true" data-search-align="left"
        data-height="650" data-show-refresh="true" data-show-toggle="true" data-show-columns="true"
        data-pagination="true" data-page-list="[10, 25, 50, 100, all]" data-locale="es-CL" data-icons-prefix="fas"
        data-icons="icons" data-toolbar="#sortable">
        <thead>
            <tr>
                <th data-field="id" data-sortable="true">ID</th>
                <th data-field="name" data-sortable="true">NOMBRE</th>
                {{-- Si no es supervisor muestrame esta columna --}}
                @unlessrole('supervisor')
                    <th data-field="actions" class="td-actions text-center" data-formatter="formatterAcciones">ACCIONES</th>
                @endunlessrole
            </tr>
        </thead>
    </table>

</div>

@include('permisos.permisos-modal')

@endsection
<script>
    var token = '{{ csrf_token() }}';
</script>
@section('script')
<script>
    var base = "{{ url('/') }}";
    var editar_permisos = "{{auth()->user()->can('editar permisos')}}";
    var eliminar_permisos = "{{auth()->user()->can('eliminar permisos')}}";


</script>
<script src="{{ URL::asset('/assets/js/app/permisos/permisos.js') }}"></script>
@endsection
