@extends('layouts.master')
@section('title')
	Extras
@endsection
@section('css')
@endsection
@section('content')
@section('pagetitle')
	Extras
@endsection
<meta name="_token" content="{{ csrf_token() }}">
<div class="uper">
	<div class="uper d-sm-none">
		<div class="card card-header">
			Extras
		</div>
	</div>
	<div class="table-responsive mt-4">
		<table id="extras_tbl" data-url="listaextras" class="table table-striped" data-toggle="table"" data-search="true"
			data-search-accent-neutralise="true" data-pagination="true" data-page-list="[10, 20, 50, 100, 200, All]"
			data-unique-id="id" data-show-columns="true" data-show-toggle="true" data-filter-control="true"
			data-click-to-select="true" data-pagination="true" data-sortable="true" data-search-highlight="true"
			data-locale="es-CL" data-height="450" data-buttons="btnAgregar" data-sort-name="id" data-search-align="left"
			data-icons-prefix="fas" data-icons="icons">
			<thead>
				<tr>
					<th data-field="id" data-sortable="true">ID</th>
					<th data-field="nombre_cliente" data-sortable="true">Cliente</th>
					<th data-field="fecha_reserva" data-sortable="true" data-formatter="dateFormat">Fecha<br />Reserva</th>
					<th data-field="hora_reserva" data-sortable="true" data-formatter="horaFormatter">Hora<br />Reserva</th>
					<th data-field="tsucursal" data-sortable="true">Sucursal</th>
					<th data-field="tsalon" data-sortable="true">Salón</th>
					<th data-field="tmesa" data-sortable="true">Mesa</th>
					<th data-field="tusuario_registro" data-sortable="true">Usuario<br />Registro</th>
					<th data-field="telefono_autoriza" data-sortable="true">Teléfono</th>
					<th data-field="monto_autorizado" data-sortable="true">Monto</th>
					<th data-field="created_at" data-sortable="true" data-formatter="formatearFecha">Fecha<br />Autorización</th>
				</tr>
			</thead>
		</table>
	</div>
@endsection
<script>
	var token = '{{ csrf_token() }}';
</script>
@section('script')
	<script>
		var base = "{{ url('/') }}";
	</script>
	a
	<script src="{{ URL::asset('/assets/js/app/reservas/extras.js') }}"></script>
@endsection
