@extends('layouts.master')
@section('title')
	Gestión de salones
@endsection
@section('css')
@endsection
@section('content')
@section('pagetitle')
	Salones
@endsection
<meta name="_token" content="{{ csrf_token() }}">
<div class="uper">
	<div class="card card-header">
		Gestión de salones
	</div>
	<form id="frmCrear">
		<div class="row">
			<div class="col-md-7">
				<div class="row" id="agr_salon">
					<div class="col-md-5">
						<label for="sucursal">Sucursal</label>
						<select id="sucursal" name="sucursal" class="form-control text text-sm crear"></select>
					</div>
					<div class="col-md-5">
						<label for="nuevo_salon">Salón</label>
						<input type="text" id="nuevo_salon" name="nuevo_salon" class="form-control text text-sm crear"
							placeholder="Introduzca el nuevo salón" required>
					</div>
					<div class="col-md-1 mt-2">
						<button id="agr_acc" class="btn btn-primary btn-sm form-control" title="Confirmar"><i
								class="fas fa-check"></i></button>
					</div>
					<div class="col-md-1 mt-2">
						<button id="agr_can" class="btn btn-dark btn-sm form-control" title="Cancelar"><i
								class="fas fa-times"></i></button>
					</div>
				</div>
			</div>
		</div>
	</form>
	<div class="table-responsive mt-4">
		<table id="salones_tbl" data-url="saloneslista" class="table table-striped" data-toggle="table" data-search="true"
			data-search-accent-neutralise="true" data-pagination="true" data-page-list="[10, 20, 50, 100, 200, All]"
			data-unique-id="id" data-show-columns="true" data-filter-control="true" data-click-to-select="true"
			data-pagination="true" data-sortable="true" data-search-highlight="true" data-locale="es-CL" data-height="650"
			@can('crear salones')
                data-buttons="btnAgregar"
            @endcan
            data-sort-name="id" data-search-align="left" data-icons-prefix="fas" data-icons="icons">
			<thead>
				<tr>
					<th data-field="id" data-sortable="true">ID</th>
					<th data-field="salon" class="salonCol" data-sortable="true">Salón</th>
					<th data-field="sucursal" class="salonCol" data-sortable="true">Sucursal</th>
					<th data-field="acciones">ACCIONES</th>
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
	var base = "{{ url('/') }}";
</script>
<script src="{{ URL::asset('/assets/js/app/comunes/tabla_config.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app/comunes/tabla_init.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app/reservas/salones.js') }}"></script>
@endsection
