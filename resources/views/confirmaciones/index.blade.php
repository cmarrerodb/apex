@extends('layouts.master')
@section('title')
	Confirmaciones Automáticas
@endsection
@section('css')
@endsection
@section('content')
@section('pagetitle')
	Confirmaciones Automáticas
@endsection
<meta name="_token" content="{{ csrf_token() }}">
<div class="uper">
	<div class="card card-header d-none">
		Confirmaciones Automáticas
	</div>

<div class="accordion" id="accordionExample">
	<div class="accordion-item">
		<h2 class="accordion-header" id="headingOne">
			<button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
				aria-expanded="true" aria-controls="collapseOne">
				Filtros Avanzados (click para mostrar)
			</button>
		</h2>
		<div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
			data-bs-parent="#accordionExample">
			<div class="accordion-body">
				<div class="text-muted">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-3 form-group">
							<div class="mb-3">
								<div><label class='form-label'>Turno</label></div>
								<div class="o-switch btn-group" data-toggle="buttons" role="group">
									<label class="btn btn-primary active">
										<input type="radio" name="rd_turno" id="todas" autocomplete="off" checked value='todas'> Todas
									</label>
									<label class="btn btn-success">
										<input type="radio" name="rd_turno" id="tarde" autocomplete="off" value='tarde'> Tarde
									</label>
									<label class="btn btn-danger">
										<input type="radio" name="rd_turno" id="noche" autocomplete="off" value='noche'> Noche
									</label>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-3 form-group">
							<div class="mb-3">
								<label for="desde">Desde</label>
								<input type='date' id="desde" class="form-control">
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-3 form-group">
							<div class="mb-3">
								<label for="hasta">Hasta</label>
								<input type='date' id="hasta" class="form-control">
							</div>
						</div>

                        <div class="col-xs-12 col-sm-12 col-md-3 form-group">
                            <div class="mb-3">
                                <label for="sel_estados" class="form-label font-size-13 text-muted" multiple=false>Estado</label>
                                <select class="form-select "  data-trigger name="sel_estados" id="sel_estados" placeholder="Seleccione el Estado">
                                </select>

                            </div>
                        </div>

					</div>
					<div class="row">

						<div class="col-xs-12 col-sm-12 col-md-2 form-group">
							<div class="mb-3">
								<label for="sel_sucursal" class="form-label font-size-13 text-muted" multiple=false>Sucursal</label>
								<select class="form-control fondo1" data-trigger name="sel_sucursal" id="sel_sucursal"
									placeholder="Seleccione la sucursal">
								</select>
							</div>
						</div>

                        <div class="col-xs-12 col-sm-12 col-md-2 form-group">
                            <div class="mb-3">
                                <label for="btn_filtrar" class="form-label font-size-13 text-muted">&nbsp;</label><br />
                                <button id="btn_filtrar" class="btn btn-primary btn-sm" title="Presione para filtrar"><i
                                        class="mdi mdi-filter"></i></button>
                                {{-- </div> --}}
                                <button id="desfiltrar" class="btn btn-dark btn-sm" title="Presione para eliminar filtro"><i
                                        class="mdi mdi-filter-off"></i></button>
                            </div>
                        </div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
{{-- ******************************************* --}}
{{-- Fin Acordeon --}}
	<div class="table-responsive mt-4">

		<table id="confirmaciones_tbl" data-url="confirmacioneslist"  async="true" class="table table-striped" data-toggle="table" data-search="true"
			data-search-accent-neutralise="true" data-pagination="true" data-page-list="[10, 20, 50, 100, 200, All]"
			data-unique-id="id" data-filter-control="true" data-click-to-select="true"
			data-show-refresh="true" data-show-toggle="true"
			data-pagination="true" data-sortable="true" data-search-highlight="true" data-locale="es-CL" data-min-height="300" data-height="650"
            @can('crear configuraciones automaticas')
			    data-buttons="btnAgregar"
            @endcan
            data-sort-name="id" data-search-align="left" data-icons-prefix="fas" data-icons="icons">
			<thead>
				<tr>
					{{-- <th data-field="id" data-sortable="true">ID</th> --}}
					<th data-field="sucursal" data-sortable="true">Sucursal</th>
					{{-- <th data-field="fecha_confirmacion" data-sortable="true" data-formatter="fechaFormatter">Fecha</th> --}}
					 <th data-field="fecha_confirmacion" data-sortable="true" data-formatter="fechaFormatter" data-searchable="true" data-search-custom="customDateSearch">Fecha</th>
					<th data-field="turno" data-sortable="true">Turno</th>
					<th data-field="pax" data-sortable="true">Pax</th>
					<th data-field="estado" data-sortable="true">Estado</th>
					<th data-field="acciones">ACCIONES</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
	data-bs-backdrop="static" id="mdl-confirmacion">
	<div class="modal-dialog modal-dialog-centered modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12 col-xs-12 col-md-6">
							<label for ="finicio">Inicio<span class="requerido">*</span></label>
							<input type="date" id="finicio" name="finicio" class="form-control" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" required>
							<span id="error_finicio" class="requerido"></span>
						</div>
						<div class="col-sm-12 col-xs-12 col-md-6">
							<div id="fin">
								<label for ="ffin">Fin<span class="requerido">*</span></label>
								<input type="date" id="ffin" name="ffin" class="form-control" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" required>
								<span id="error_ffin" class="requerido"></span>
							</div>
						</div>
					</div>
					<div class="row mt-x">
						<div class="col-sm-12 col-xs-12 col-md-7">
							<label for ="turno">Turno<span class="requerido">*</span></label><br/>
							<div class="btn-group" role="group" id="turno" aria-label="Basic radio toggle button group">
								<input type="radio" class="btn-check" name="btnTurno" id="btnTarde" autocomplete="off" title="Filtrar turno de la mañana" value="1" checked>
								<label class="btn btn-success" for="btnTarde">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tarde&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
								<input type="radio" class="btn-check" name="btnTurno" id="btnNoche" autocomplete="off" title="Filtrar turno de la tarde" value="2">
								<label class="btn btn-danger" for="btnNoche">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Noche&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							</div>
						</div>

						<div class="col-sm-12 col-xs-12 col-md-4">
							<label for ="sucursal">Sucursal<span class="requerido">*</span></label>
							<select id="sucursal" class="form-control" required>
								@foreach ($sucursales as $sucursal)
									@php $selected = @$sucursal['sucursal']=='VIVO' ? ' selected ': '' @endphp
									<option value="{{ $sucursal['id'] }}" {{$selected}}>{{ $sucursal['sucursal'] }}</option>
								@endforeach
							</select>
							<span id="error_sucursal" class="requerido"></span>
						</div>
						<div class="col-sm-12 col-xs-12 col-md-6">
							<label for ="pax">Pax Máximo<span class="requerido">*</span></label>
							<input type="number" id="pax" class="form-control" placeholder = 'Introduzca el pax máximo' required>
							<span id="error_pax" class="requerido"></span>
						</div>
						<div class="col-sm-12 col-xs-12 col-md-6">
							<label for ="clave_usuario">Clave<span class="requerido">*</span></label>
							<input type="password" id="clave_usuario" class="form-control" required value = ' '>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="btn-guardar" title="Cerrar la ventana y guardar cambios"
					>Guardar</button>
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
<script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app/comunes/tabla_config.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app/comunes/funciones.js') }}"></script>
{{-- <script src="{{ URL::asset('/assets/js/app/comunes/tabla_init.js') }}"></script> --}}
<script src="{{ URL::asset('/assets/js/app/confirmaciones/index.js') }}"></script>
@endsection
