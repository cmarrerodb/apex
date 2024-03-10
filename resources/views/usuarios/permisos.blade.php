@extends('layouts.master')
@section('title')
Gestión de Roles<br />
@endsection
@section('css')
@endsection
@section('content')
@section('pagetitle')
Usuarios
@endsection
<meta name="_token" content="{{ csrf_token() }}">
<div class="uper d-sm-none">
    <div class="card card-header">
        Gestión de Roles
    </div>
</div>
<div class="table-responsive mt-4">
    <table id="roles_tbl" class="table table-striped" data-toggle="table" data-url="list"
        data-buttons="btnAgrCliente" data-id-field="id" data-unique-id="id" data-search="true" data-search-align="left"
        data-height="460" data-show-refresh="true" data-show-toggle="true" data-show-columns="true"
        data-pagination="true" data-page-list="[10, 25, 50, 100, all]" data-locale="es-CL" data-icons-prefix="fas"
        data-icons="icons" data-toolbar="#sortable">
        <thead>
            <tr>
                <th data-field="id" data-sortable="true">ID</th>
                <th data-field="name" data-sortable="true">NOMBRE</th>
                <th data-field="email" data-sortable="true">EMAIL</th>
                <th data-field="accions" data-formatter="formatterRole" >Rol</th>
                <th data-field="actions" data-formatter="notiReserva" data-sortable="true" >Notificacion Reserva</th>
                <th data-field="actions" data-formatter="notiPrereserva" data-sortable="true">Notificacion Prereserva</th>
                <th data-field="actions" data-formatter="giftcardVer" data-sortable="true" >Ver Giftcard</th>
                <th data-field="actions" data-formatter="giftcardCrear" data-sortable="true">Crear Giftcard</th>
                <th data-field="actions" data-formatter="giftcardCrear" data-sortable="true">Anular Giftcard</th>
                {{-- Si no es supervisor muestrame esta columna --}}
                @unlessrole('supervisor')
                    <th data-field="actions" class="td-actions text-center" data-formatter="formatterAcciones">ACCIONES</th>
                @endunlessrole
            </tr>
        </thead>
    </table>

</div>

{{-- @include('usuarios.usuarios-modal') --}}

@endsection
<script>
    var token = '{{ csrf_token() }}';
</script>
@section('script')
<script>
    var base = "{{ url('/') }}";
</script>
<script src="{{ URL::asset('/assets/js/app/usuarios/roles.js') }}"></script>
@endsection
