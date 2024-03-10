@extends('layouts.master')
@section('title')
	Bloqueos
@endsection
@section('css')
@endsection
@section('content')
@section('pagetitle')
	Bloqueos
@endsection
<meta name="_token" content="{{ csrf_token() }}">
<div class="uper">
	<div class="uper d-sm-none">
		<div class="card card-header">
			Gestión de Bloqueos
		</div>
	</div>
	<div class="table-responsive mt-4">
		<table id="bloqueos_tbl" data-url="listabloqueos" class="table table-striped" data-toggle="table"" data-search="true"
			data-search-accent-neutralise="true" data-pagination="true" data-page-list="[10, 20, 50, 100, 200, All]"
			data-unique-id="id" data-show-columns="true" data-filter-control="true" data-click-to-select="true"
			data-pagination="true" data-sortable="true" data-search-highlight="true" data-locale="es-CL" data-height="450"
            @can('crear bloqueos')
                data-buttons="btnAgregar"
            @endcan
            data-sort-name="id" data-search-align="left" data-icons-prefix="fas" data-icons="icons"
			>
			<thead>
				<tr>
					<th data-field="id" data-sortable="true">ID</th>
					<th data-field="nombre_bloqueo" data-sortable="true">Nombre Bloqueo</th>
					<th data-field="fecha_inicio" data-sortable="true" data-formatter="dateFormat">Fecha Inicio</th>
					<th data-field="hora_inicio" data-sortable="true" data-formatter="horaFormatter">Hora Inicio</th>
					<th data-field="fecha_fin" data-sortable="true" data-formatter="dateFormat">Fecha Fin</th>
					<th data-field="hora_fin" data-sortable="true" data-formatter="horaFormatter">Hora Fin</th>
					<th data-field="usuario_registro" data-sortable="true">Usuario</th>
					<th data-field="actions" class="td-actions text-center" data-click-to-select="false"
						data-formatter="listarReservasFormatter">ACCIONES</th>
				</tr>
			</thead>
		</table>
	</div>
	<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
		data-bs-backdrop="static" id="mdl-bloquear">
		<div class="modal-dialog modal-dialog-centered modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="blq_res">Bloquear Fecha</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="card-body">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 mb-3">
								<label for="clave_usuario_bl" class="col-form-label">Ingrese su clave<span class="requerido">*</span></label>
								<input type="password" class="form-control req" id="clave_usuario_bl" name="clave_usuario_ns">
							</div>
						</div>
						.<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6">
								<label for="fechainicio">Fecha Inicio<span class="requerido">*</span> </label>
								<input type="date" id="fechainicio" class="form-control">
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6">
								<label for="horainicio">Hora Inicio<span class="requerido">*</span> </label>
								<input type="time" id="horainicio" class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6">
								<label for="fechafin">Fecha Fin<span class="requerido">*</span> </label>
								<input type="date" id="fechafin" class="form-control">
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6">
								<label for="horafi1n">Hora Fin<span class="requerido">*</span> </label>
								<input type="time" id="horafin" class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<label for="nombrebloqueo">Nombre del bloqueo<span class="requerido">*</span> </label>
								<input type="text" id="nombrebloqueo" class="form-control">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="btn-an"
							title="Anular la reserva y cerrar la ventana">Anular</button>
						<button type="button" class="btn btn-success" id="btn-bl"
							title="Bloquear la reserva y cerrar la ventana">Bloquear</button>
						<button type="button" class="btn btn-secondary" id="btn-cerrar_bloquear" data-bs-dismiss="modal"
							data-bs-target="mdl-bloquear" aria-label="Close"
							title="Cerrar la ventana y descartar los cambios">Cerrar</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	@endsection
	<script>
		var token = '{{ csrf_token() }}';
	</script>
	@section('script')
		<script>
			var base = "{{ url('/') }}";
            var crear_bloqueo="{{auth()->user()->can('crear bloqueos')}}";
            var editar_bloqueo="{{auth()->user()->can('editar bloqueos')}}";

		</script>
		<script src="{{ URL::asset('/assets/js/app/comunes/tabla_config.js') }}"></script>
		<script src="{{ URL::asset('/assets/js/app/comunes/tabla_init.js') }}"></script>
		<script src="{{ URL::asset('/assets/js/app/reservas/bloqueos.js') }}"></script>
	@endsection
