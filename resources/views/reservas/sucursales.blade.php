@extends('layouts.master')
@section('title')
	Sucursales
@endsection
@section('css')
@endsection
@section('content')
@section('pagetitle')
	Sucursales
@endsection
<meta name="_token" content="{{ csrf_token() }}">
<div class="uper">
	<div class="card card-header">
		Sucursales
	</div>
	<form id="frmCrear">
		<div class="row">
			<div class="col-md-7">
				<div class="row" id="agr_sucursal">
					<div class="col-md-3">
						<label for="nuevo_sucursal">Sucursal</label>
						<input type="text" id="nuevo_sucursal" name="nuevo_sucursal" class="form-control text text-sm crear"
							placeholder="Introduzca una nueva sucursal" required>
					</div>
					<div class="col-md-3">
						<label for="fecha_inicio">Fecha Inicio</label>
						<input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control text text-sm crear"
							placeholder="Introduzca la fecha de inicio del calendario" required>
					</div>
					<div class="col-md-3">
						<label for="fecha_fin">Fecha Finalización</label>
						<input type="date" id="fecha_fin" name="fecha_fin" class="form-control text text-sm crear"
							placeholder="Introduzca la fecha de finalización del calendario" required>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-1 mt-2">
						<button type="button" id="agregar" class="btn btn-primary btn-sm form-control mb-3" title="Confirmar"
							onclick="crear();"><i class="fas fa-check"></i></button>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-1 mt-2">
						<button id="agr_can" class="btn btn-dark btn-sm form-control mb-3" title="Cancelar"><i
								class="fas fa-times"></i></button>
					</div>
				</div>
			</div>
		</div>
	</form>
	<div class="table-responsive mt-4">
		<table id="sucursales_tbl" data-url="sucursaleslista" class="table table-striped" data-toggle="table""
			data-search="true" data-search-accent-neutralise="true" data-pagination="true"
			data-page-list="[10, 20, 50, 100, 200, All]" data-unique-id="id" data-show-columns="true" data-filter-control="true"
			data-click-to-select="true" data-pagination="true" data-sortable="true" data-search-highlight="true"
			data-locale="es-CL" data-height="650"
            @can('cear sucursales')
                data-buttons="btnAgregar"
            @endcan
            data-sort-name="id" data-search-align="left"
			data-icons-prefix="fas" data-icons="icons">
			<thead>
				<tr>
					<th data-field="id" data-sortable="true">ID</th>
					<th data-field="sucursal" class="sucursalCol" data-sortable="true">Sucursal</th>
					<th data-field="fecha_inicio_calendario" class="sucursalCol" data-sortable="true" data-formatter="dateFormat">Fecha
						Inicio</th>
					<th data-field="fecha_fin_calendario" class="sucursalCol" data-sortable="true" data-formatter="dateFormat">Fecha
						Finalización</th>
					<th data-field="acciones" data-formatter="formatterAccion">ACCIONES</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<div class="validar-permisos">
    @can('editar sucursales')
        <div class="can-edit-sucursal"></div>
    @endcan

    @can('eliminar sucursales')
        <div class="can-delete-sucursal"></div>
    @endcan
   
</div>


@endsection
<script>
	var token = '{{ csrf_token() }}';
</script>
@section('script')
<script>
	var base = "{{ url('/') }}";
    var editar_sucursal = "{{auth()->user()->can('editar sucursales')}}";
    var eliminar_sucursal = "{{auth()->user()->can('eliminar sucursales')}}";

</script>
<script src="{{ URL::asset('/assets/js/app/comunes/tabla_config.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app/comunes/tabla_init.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app/reservas/sucursales.js') }}"></script>
@endsection
