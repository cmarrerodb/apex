@extends('layouts.master')
@section('title')
	Gestión de Comensales
@endsection
@section('css')
@endsection
@section('content')
@section('pagetitle')
	Comensales
@endsection

<div class="uper d-sm-none">
	<div class="card card-header">
		Gestión de Comensales
	</div>
</div>

<div class="table-responsive mt-4">
	<table id="comesales_tbl" class="table table-striped" data-toggle="table" data-url="list"        
        data-id-field="id" data-unique-id="id" data-search="true" data-search-align="left"
		data-height="650" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-pagination="true"
		data-page-list="[10, 25, 50, 100, all]" data-locale="es-CL" data-icons-prefix="fas" data-icons="icons"
		data-toolbar="#sortable">
		<thead>
			<tr>
				<th data-field="id" data-sortable="true">ID</th>
                <th data-field="registro_hash" data-sortable="true">Código Hash</th>
                <th data-field="mesa.mesa" data-sortable="true">Mesa</th>
				<th data-field="nombre" data-sortable="true">Nombre</th>
				<th data-field="apellido" data-sortable="true">Apellido</th>
				<th data-field="birth_day" data-sortable="true">Fecha<br />Nacimiento</th>
				<th data-field="telefono">Teléfono.</th>			
				<th data-field="email" data-sortable="true">Correo</th>
                <th data-field="parent_registro_hash" data-sortable="true">Padre Código Hash</th>				
				<th data-formatter="formatterAccion">ACCIONES</th>
			</tr>
		</thead>
	</table>
</div>

@include('comensales.modals.modal-editar')

@endsection
<script>
	var token = '{{ csrf_token() }}';
</script>
@section('script')
<script>
	var base = "{{ url('/') }}";
</script>
<script src="{{ URL::asset('/assets/js/app/comunes/funciones.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app/comunes/tabla_config.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app/comensales/index.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/imask/imask.min.js') }}"></script>


@endsection
