@extends('layouts.master')
@section('title')
Gestión de Configuracion Globales<br />
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
        Gestión de Configuracion Globales
    </div>
</div>
<div class="table-responsive mt-4">
    <table id="configuracion_tbl" class="table table-striped" data-toggle="table" data-url="configuracion_global_list"
        data-buttons="btnAgregar" data-id-field="id" data-unique-id="id" data-search="true" data-search-align="left"
        data-height="500" data-show-refresh="true" data-show-toggle="true" data-show-columns="true"
        data-pagination="true" data-page-list="[10, 25, 50, 100, all]" data-locale="es-CL" data-icons-prefix="fas"
        data-icons="icons" data-toolbar="#sortable">
        <thead>
            <tr>
                <th data-field="id" data-sortable="true">ID</th>
                <th data-field="name" data-sortable="true">Nombre</th>
                <th data-field="tipo.nombre" data-sortable="true">Tipo</th>
                <th data-field="vista.vista" data-sortable="true">Vista</th>
                <th data-field="valor" data-sortable="true">Valor</th>
                <th data-field="duracion" data-sortable="true">Duración</th>
                <th data-field="email" data-sortable="true">Email notificación</th>
                <th data-field="activo" data-sortable="true" data-formatter="formatterActivo">Activa</th>
                <th data-field="descripcion" data-sortable="true">Descripción</th>


                {{-- Si no es supervisor muestrame esta columna --}}
                @unlessrole('supervisor')
                    <th data-field="actions" class="td-actions text-center" data-formatter="formatterAcciones">ACCIONES</th>
                @endunlessrole
            </tr>
        </thead>
    </table>

</div>

@include('configuracion.configuracion-modal')


@endsection
<script>
    var token = '{{ csrf_token() }}';
</script>
@section('script')
<script>
    var base = "{{ url('/') }}";
</script>
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/inline/ckeditor.js"></script> --}}
<script src="{{ URL::asset('assets/libs/@ckeditor/@ckeditor.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app/comunes/funciones.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app/comunes/tabla_config.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app/comunes/tabla_init.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app/configuracion/index.js') }}"></script>
@endsection
