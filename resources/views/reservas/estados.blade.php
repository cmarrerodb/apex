@extends('layouts.master')
@section('title')
	Gestión de estados de reservas
@endsection
@section('css')
	{{-- <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet"> --}}
@endsection
@section('content')
@section('pagetitle')
	Gestión de estados de reservas
@endsection
<meta name="_token" content="{{ csrf_token() }}">
<div class="uper">
	<div class="card card-header">
		Gestión de estados de reservas
	</div>
	<div class="row">
		<div class="col-md-7">
			<div class="row" id="agr_tipo">
				<div class="col-md-6">
					<label for="nuevo_tipo">Estado</label>
					<input type="text" id="nuevo_tipo" class="form-control text text-sm"
						placeholder="Introduzca un nuevo estado de reserva">
				</div>
				<div class="col-md-1 mt-2">
					<label for="agr_acc">&nbsp;</label>
					<button id="agr_acc" class="btn btn-primary btn-sm" title="Confirmar"><i class="fas fa-check"></i></button>
				</div>
				<div class="col-md-1 mt-2">
					<label for="agr_can">&nbsp;</label>
					<button id="agr_can" class="btn btn-dark btn-sm" title="Cancelar"><i class="fas fa-times"></i></button>
				</div>
			</div>
		</div>
	</div>
	<div class="table-responsive mt-4">
		<table id="tipos_tbl" data-url="/reservas/estadoslista" class="table table-striped" data-toggle="table"
			data-search="true" data-search-accent-neutralise="true" data-pagination="true"
			data-page-list="[10, 20, 50, 100, 200, All]" data-unique-id="id" data-show-columns="true" data-filter-control="true"
			data-click-to-select="true" data-pagination="true" data-sortable="true" data-search-highlight="true"
			data-locale="es-CL" data-height="450" data-buttons="btnAgregar" data-sort-name="id" data-search-align="left"
			data-icons-prefix="fas" data-icons="icons">
			<thead>
				<tr>
					<th data-field="id" data-sortable="true">ID</th>
					<th data-field="estado" class="tipoCol" data-sortable="true">Estado</th>
					<th data-field="acciones">Acciones</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
@endsection
<script>
	var token = '{{ csrf_token() }}';
</script>
@section('script')
<script>
	var base = "";
	//var base = "{{ url('/') }}";
</script>
<script src="/assets/js/app/comunes/tabla_config.js"></script>
<script src="/assets/js/app/comunes/tabla_init.js"></script>
<script src="/assets/js/app/reservas/estados.js"></script>
@endsection
