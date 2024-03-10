@extends('layouts.master')
@section('title')
	Gestión de Mesas
@endsection
@section('css')
@endsection
@section('content')
@section('pagetitle')
	Gestión de Mesas
@endsection
<meta name="_token" content="{{ csrf_token() }}">
<div class="container-fluid">
<div class="uper">
	<div class="card card-header">
		Gestión de Mesas
	</div>
	<form id="frmCrear" method="POST">
		<div class="row">
			<div class="col-md-7">
				<div class="row" id="agr_mesa">
					<div class="col-xs-12 col-sm-12 col-md-5">
						<label for="sucursal">Sucursal</label>
						<select id="sucursal" name="sucursal" class="form-control text text-sm crear"></select>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-5">
						<label for="salon">Salón</label>
						<select id="salon" name="salon" class="form-control text text-sm crear"></select>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-5">
						<label for="nueva_mesa">Mesa</label>
						<input type="number" id="nuevo_mesa" name="nuevo_mesa" class="form-control text text-sm crear"
							placeholder="Introduzca número de mesa">
					</div>
					<div class="col-xs-12 col-sm-12 col-md-5">
						<label for="capacidad">Capacidad</label>
						<input type="number" id="capacidad" name="capacidad" class="form-control text text-sm crear"
							placeholder="Introduzca la capacidad de la mesa">
					</div>

					<div class="col-xs-12 col-sm-12 col-md-1 mt-2">
						<button type="button" id="agregar" class="btn btn-primary btn-sm form-control mb-3" title="Confirmar"><i
								class="fas fa-check"></i></button>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-1 mt-2">
						<button id="agr_can" class="btn btn-dark btn-sm form-control mb-3" title="Cancelar"><i
								class="fas fa-times"></i></button>
					</div>
				</div>
			</div>
		</div>
</div>
</div>
</form>
<div class="table-responsive mt-4">
	<table id="mesas_tbl" data-url="mesaslista" class="table table-striped" data-toggle="table" data-search="true"
		data-search-accent-neutralise="true" data-pagination="true" data-page-list="[10, 20, 50, 100, 200, All]"
		data-unique-id="id" data-show-columns="true" data-filter-control="true" data-click-to-select="true"
		data-pagination="true" data-sortable="true" data-search-highlight="true" data-locale="es-CL" data-height="650"
		@can('crear mesas')
            data-buttons="btnAgregar"
        @endcan
        data-sort-name="id" data-search-align="left" data-icons-prefix="fas" data-icons="icons">
		<thead>
			<tr>
				<th data-field="mesa_id" data-sortable="true">ID</th>
				<th data-field="sucursal" class="mesaCol" data-sortable="true">Sucursal</th>
				<th data-field="salon" class="mesaCol" data-sortable="true">Salón</th>
				<th data-field="mesa" class="mesaCol" data-sortable="true">Mesa</th>
				<th data-field="capacidad" class="mesaCol" data-sortable="true">Capacidad</th>
				<th data-field="acciones">Acciones</th>
			</tr>
		</thead>
	</table>
</div>
</div>
</div>


{{-- Modal Mesa Editar  --}}
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
    id="mdl-mesa">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="mesa_id" id="mesa_id">
                        <div class="col-xs-12 col-md-6 mb-3">
                            <label for="edit_sucursal_id" class="form-label">Sucursal <span class="requerido">*</span></label>
                            <select class="form-select list-sucursales" name="edit_sucursal_id" id="edit_sucursal_id">
                            </select>
                        </div>

                        <div class="col-xs-12 col-md-6 mb-3">
                            <label for="edit_salon_id" class="form-label">Salon <span class="requerido">*</span></label>
                            <select class="form-select list-salones" name="edit_salon_id" id="edit_salon_id">
                            </select>
                        </div>

                        <div class="col-xs-12 col-md-6 mb-3">
                            <label for="edit_mesa" class="form-label">Mesa <span class="requerido">*</span></label>
                            <input type="number" class="form-control" name="edit_mesa" id="edit_mesa">
                        </div>

                        <div class="col-xs-12 col-md-6 mb-3">
                            <label for="edit_capacidad" class="form-label">Capacidad </label>
                            <input type="number" class="form-control" name="edit_capacidad" id="edit_capacidad">
                        </div>

                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-guardar" title="Cerrar la ventana y guardar cambios"
                    disabled>Guardar</button>
                <button type="button" class="btn btn-secondary" id="btn-cerrar" data-bs-dismiss="modal" aria-label="Close"
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
</script>
<script src="{{ URL::asset('/assets/js/app/comunes/funciones.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app/comunes/tabla_config.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app/comunes/tabla_init.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app/reservas/mesas.js') }}"></script>
@endsection
