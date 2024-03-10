@extends('layouts.master')
@section('title')
	Administrar
@endsection
@section('css')
@endsection
@section('content')
@section('pagetitle')
	Administrar
@endsection
{{-- /////////////////////////////// --}}
{{-- Inicio Acordeon --}}
<div class="uper d-sm-none">
	<div class="card card-header">
		Administrar
	</div>
</div>
<div class="d-flex justify-content-between flex-wrap ">
   
	<div class="mb-1 ">
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
	<div class="col-10 col-sm-10 col-md-4 col-lg-2 form-group">
		<div class="mb-1">
			<label for="desde">Desde</label>
			<input type='date' id="desde" class="form-control">
		</div>
	</div>
	<div class="mt-31">		
		<button id="btn-limpia-desde" type="button" class="btn  btn-primary" title="Limpiar Fecha Desde " >
			<i class="fas fa-eraser"></i>			
		</button>
	</div>
	

	<div class="col-10 col-sm-10 col-md-4 col-lg-2 form-group">
		<div class="mb-1">
			<label for="hasta">Hasta</label>
			<input type='date' id="hasta" class="form-control">
		</div>
	</div>

	<div class="mt-31">		
		<button id="btn-limpia-hasta" type="button" class="btn  btn-primary" title="Limpiar Fecha Hasta" >
			<i class="fas fa-eraser"></i>			
		</button>
	</div>

	<div class="col-12 col-sm-12 col-md-4 col-lg-2">
		<div class="mb-1">
			<label for="sel_estados" class="form-label font-size-13 text-muted">Estados</label>			
			<select id="sel_estados" name='testado' class=" form-select" multiple>
			</select>
		</div>
	</div>

	<div class="col-12 col-sm-12 col-md-4 col-lg-2 form-group">
		<div class="mb-1">
			<label for="sel_tipos" class="form-label font-size-13 text-muted">Tipos</label>
			<select id="sel_tipos" name='tipo' class="form-select list-tipos" multiple>
			</select>
		</div>
	</div>

	<div class="mb-1">
        <div>Total Pax</div>
        <div class="redondo">
            <p id="total_pax"></p>
        </div>
    </div>

</div>


<div class="d-flex justify-content-between flex-wrap">

	<div class="col-12 col-sm-12 col-md-4 col-lg-2 form-group">
		<div class="mb-1">
			<label for="sel_sucursal" class="form-label font-size-13 text-muted" multiple=false>Sucursal</label>
			<select class="form-select" data-trigger name="sel_sucursal" id="sel_sucursal"
				placeholder="Seleccione la sucursal">
			</select>
		</div>
	</div>

	<div class="col-12 col-sm-12 col-md-4 col-lg-2 form-group salones">
		<div class="mb-1">
			<label for="sel_salones" class="form-label font-size-13 text-muted" multiple=false>Salones</label>
			<select id="sel_salones" class="form-select" multiple>
			</select>
		</div>
	</div>	

	<div class="col-12 col-sm-12 col-md-4 col-lg-2 form-group mesas">
		<div class="mb-1">
			<label for="sel_mesas" class="form-label font-size-13 text-muted">Mesas</label>
			<select id="sel_mesas" class="form-select" multiple>
			</select>
		</div>
	</div>
	<div class="col-12 col-sm-12 col-md-4 col-lg-2 form-group">
		<div class="mb-1">
			{{-- <label for="sel_clientes" class="form-label font-size-13 text-muted">Cliente</label>
			<select id="sel_clientes" class="form-select list-clientes" multiple> --}}
			<label for="sel_clientes_v2" class="form-label font-size-13 text-muted">Cliente</label>
			<input type="text" class="form-control" name="sel_clientes_v2" id="sel_clientes_v2">
	
			{{-- <select id="sel_clientes" class="form-select list-clientes"> --}}

			</select>
		</div>
	</div>

	<div class="col-12 col-sm-12 col-md-4 col-lg-2 form-group">
		<div class="mb-1">
			<label for="sel_cancelacion" class="form-label font-size-13 text-muted" multiple=false>Razón cancelación</label>
			<select class="form-select  list-razones" data-trigger name="list-razones" id="sel_cancelacion" placeholder="Seleccione...">
			</select>
		</div>
	</div>

	<div class="mb-1">
		<label for="btn_filtrar" class="form-label font-size-13 text-muted">&nbsp;</label><br />
		<button id="btn_filtrar" class="btn btn-primary " title="Presione para filtrar"><i class="mdi mdi-filter"></i></button>
		<button id="desfiltrar" class="btn btn-dark " title="Presione para eliminar filtro"><i class="mdi mdi-filter-off"></i></button>
	</div>
    {{-- <div class="col-md-11"> --}}
        {{-- <div class="accordion" id="accordionExample">
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
                                <div class="col-xs-12 col-sm-12 col-md-4 form-group">
                                    <div class="mb-1">
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
                                    <div class="mb-1">
                                        <label for="desde">Desde</label>
                                        <input type='date' id="desde" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 form-group">
                                    <div class="mb-1">
                                        <label for="hasta">Hasta</label>
                                        <input type='date' id="hasta" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-3 form-group">
                                    <div class="mb-1">
                                        <label for="sel_estados" class="form-label font-size-13 text-muted">Estados</label>
                                        <select id="sel_estados" name='testado' class="select-multiple" multiple>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 form-group">
                                    <div class="mb-1">
                                        <label for="sel_tipos" class="form-label font-size-13 text-muted">Tipos</label>
                                        <select id="sel_tipos" name='tipo' class="select-multiple" multiple>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2 form-group">
                                    <div class="mb-1">
                                        <label for="sel_sucursal" class="form-label font-size-13 text-muted" multiple=false>Sucursal</label>
                                        <select class="form-control fondo1" data-trigger name="sel_sucursal" id="sel_sucursal"
                                            placeholder="Seleccione la sucursal">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 form-group salones">
                                    <div class="mb-1">
                                        <label for="sel_salones" class="form-label font-size-13 text-muted" multiple=false>Salones</label>
                                        <select id="sel_salones">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-3 form-group mesas">
                                    <div class="mb-1">
                                        <label for="sel_mesas" class="form-label font-size-13 text-muted">Mesas</label>
                                        <select id="sel_mesas" multiple>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 form-group">
                                    <div class="mb-1">
                                        <label for="sel_clientes" class="form-label font-size-13 text-muted">Cliente</label>
                                        <select id="sel_clientes" multiple=false>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 form-group">
                                    <div class="mb-1">
                                        <label for="sel_cancelacion" class="form-label font-size-13 text-muted" multiple=false>Razón cancelación</label>
                                        <select class="form-control fondo1" data-trigger name="sel_cancelacion" id="sel_cancelacion"
                                            placeholder="Seleccione la sucursal">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2 form-group">
                                    <div class="mb-1">
                                        <label for="btn_filtrar" class="form-label font-size-13 text-muted">&nbsp;</label><br />
                                        <button id="btn_filtrar" class="btn btn-primary btn-sm" title="Presione para filtrar"><i
                                                class="mdi mdi-filter"></i></button>
                                        
                                        <button id="desfiltrar" class="btn btn-dark btn-sm" title="Presione para eliminar filtro"><i
                                                class="mdi mdi-filter-off"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
		
        {{-- ******************************************* --}}
        {{-- Fin Acordeon --}}
        {{-- /////////////////////////////// --}}
    {{-- </div> --}}
</div>




<meta name="_token" content="{{ csrf_token() }}">
<div class="uper">
	{{-- <div class="uper d-sm-none">
		<div class="card card-header">
			CRM
		</div>
	</div> --}}
	<div class="table-responsive mt-1">
		{{-- <table id="reservas_tbl"
			class="table"
			data-toggle="table"
			data-url="reservar/list"
			data-buttons="btnAgrCliente"
			data-id-field="id"
			data-unique-id="id"
			data-search="true"
			data-search-align="left"
			data-height="460"
			data-show-refresh="true"
			data-show-toggle="true"
			data-show-columns="true"
			data-pagination="true"
			data-page-list="[10, 25, 50, 100, all]"
			data-locale="es-CL"
			data-icons="icons"
			data-row-style="filaEvento"
			data-show-export=true
			data-export-types="['xlsx']"> --}}

		<table id="reservas_tbl"
			class="table"
			data-toggle="table"
			data-url="reservar/list?fecha={{ date('Y-m-d') }}"
			data-id-field="id"
			data-unique-id="id"
			{{-- data-search="true" --}}
			data-search-align="left"
            data-min-height="300"
            data-height="650"
			data-show-refresh="true"
			data-show-toggle="true"
			data-show-columns="true"
            data-show-export="true"
            data-export-types="['excel']"
			data-pagination="true"
			data-page-list="[1000, 2000, All]"
			data-locale="es-CL"
			data-icons-prefix="fas"
			data-icons="icons"
			data-row-style="filaEvento">
			<thead>
				<tr>
                    <th data-formatter="botoneraFormatter"></th>   
					{{-- <th width="20%" data-field="fecha_reserva" data-sortable="true" data-formatter="formatFechaChile">Fecha</th> --}}
					<th data-field="fecha_reserva" data-sortable="true" >Fecha <br> Reserva S/F</th>					
					<th data-field="fecha_reserva_formato" data-sortable="true" data-formatter="fechaReservaFormatter">Fecha Reserva</th>
					<th data-field="hora_reserva" data-sortable="true" data-formatter="horaFormatter">Hora</th>
					<th data-field="tsucursal" data-sortable="true" >Sucursal</th>
					<th data-field="nombre_cliente" data-sortable="true">Cliente</th>
					<th data-field="telefono_cliente" data-sortable="true">Teléfono</th>
					<th data-field="cantidad_pasajeros" data-sortable="true" data-formatter="paxFormatter">Pax</th>
					<th data-field="tipo" data-sortable="true">Tipo</th>
					<th data-field="tmesa" data-sortable="true" data-formatter="mesaFormatter">Mesa</th>
					<th data-field="tsalon" data-sortable="true" data-formatter="salonFormatter">Salón</th>
					<th data-field="testado" data-sortable="true" data-formatter="estadoFormatter">Estado</th>
					<th data-field="razon" data-sortable="true">Razón <br />Cancelación</th>
					<th data-field="observacion_cancelacion" data-sortable="true" data-formatter="obsCancelaFormatter">Observación<br />Cancelación</th>
					<th data-field="ambiente" data-sortable="true">Ambiente</th>
					<th data-field="observaciones" data-sortable="true" data-formatter="obsFormatter">Observaciones</th>
					<th data-field="fecha_rechazo" data-sortable="true">Fecha <br />Rechazo</th>
					<th data-field="tusuario_rechazo" data-sortable="true">Usuario <br />Rechazo</th>

					{{-- <th data-field="usuario_rechazo" data-sortable="true">Usuario <br />Rechazo</th> --}}
					<th data-field="razon_rechazo" data-sortable="true">Razón <br />Rechazo</th>
					<th data-field="fecha_confirmacion" data-sortable="true" data-formatter="fechaFormatter2">Fecha <br />Aceptación</th>
					<th data-field="tusuario_confirmacion" data-sortable="true">Usuario <br />Aceptación</th>
					<th data-field="nombre_empresa" data-sortable="true">Empresa</th>
					<th data-field="nombre_hotel" data-sortable="true">Hotel</th>
					<th data-field="email_cliente" data-sortable="true">Correo</th>
					{{-- <th data-field="cambios" data-sortable="true">Cambios</th> --}}
					<th data-field="archivo_1" data-sortable="true" data-formatter="imageFormatter">Menú 1</th>
					<th data-field="archivo_2" data-sortable="true" data-formatter="imageFormatter">Menú 2</th>
					<th data-field="evento_nombre_adicional" data-sortable="true">Nombre <br />evento</th>
					<th data-field="evento_pax" data-sortable="true">Pax</th>
					<th data-field="evento_valor_menu" data-sortable="true">Valor<br />Menú</th>
					<th data-field="evento_total_sin_propina" data-sortable="true">Total S/ <br />Propina</th>
					<th data-field="evento_total_propina" data-sortable="true">Total C/ <br />Propina</th>
					<th data-field="evento_nombre_contacto" data-sortable="true">Contacto</th>
					<th data-field="evento_email_contacto" data-sortable="true">Correo <br />Contacto</th>
					<th data-field="evento_telefono_contacto" data-sortable="true">Tel <br />Contacto</th>
					<th data-field="evento_anticipo" data-sortable="true">Anticipo</th>
					<th data-field="tevento_paga_en_local" data-sortable="true">Paga en <br />local</th>
					<th data-field="tevento_audio" data-sortable="true">Audio</th>
					<th data-field="tevento_video" data-sortable="true">Video</th>
					<th data-field="tevento_video_audio" data-sortable="true">Video y Audio</th>
					<th data-field="tevento_restriccion_alimenticia" data-sortable="true">Restricción <br /></th>
					<th data-field="evento_ubicacion" data-sortable="true">Ubicación</th>
					<th data-field="evento_monta" data-sortable="true">Monta</th>
					<th data-field="evento_detalle_restriccion" data-sortable="true">Detalle <br /></th>
					<th data-field="evento_comentarios" data-sortable="true">Comentario</th>
					<th data-field="evento_idioma" data-sortable="true">Idioma</th>
					<th data-field="evento_cristaleria" data-sortable="true">Cristaleria</th>
					<th data-field="evento_decoracion" data-sortable="true">Decoración</th>
					<th data-field="evento_mesa_soporte_adicional" data-sortable="true">Soporte Adicional</th>
					<th data-field="evento_extra_permitido" data-sortable="true">Extra <br />Permitido</th>
					<th data-field="evento_menu_impreso" data-sortable="true">Menú <br />Impreso</th>
					<th data-field="evento_table_tent" data-sortable="true">Table Tent</th>
					<th data-field="evento_logo" data-sortable="true" data-formatter="imageFormatter">Logo</th>
					<th data-field="cantidad_pasajeros" data-sortable="true">Pax SF</th>
					
					{{-- <th data-field="actions" class="td-actions text-center" data-click-to-select="false" data-formatter="listarReservasFormatter">ACCIONES</th> --}}
				</tr>
			</thead>
		</table>
	</div>
	<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
		data-bs-backdrop="static" id="mdl-reserva">
		<div class="modal-dialog modal-dialog-centered modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Reserva</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="card-body">
						<p class="card-title-desc">Reserva</p>

					</div>
				</div>
				<div class="modal-footer">
					{{-- <button type="button" class="btn btn-primary" id="btn-guardar" title="Cerrar la ventana y guardar cambios"
						disabled>Guardar</button>
					<button type="button" class="btn btn-secondary" id="btn-cerrar" data-bs-dismiss="modal" aria-label="Close"
						title="Cerrar la ventana y descartar los cambios">Cerrar</button> --}}
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
		data-bs-backdrop="static" id="mdl-cancelar">
		<div class="modal-dialog modal-dialog-centered modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="can_res"></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="card-body">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 mb-3">
								<label for="clave_usuario" class="col-form-label">Ingrese su clave<span class="requerido">*</span></label>
								<input type="password" class="form-control req" id="clave_usuario" name="clave_usuario">
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 mb-3">
								<label for="raz_canc">Razón de la Cancelación<span class="requerido">*</span></label><br />
								<select class="form-select req" id="raz_canc"></select>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 mb-3">
								<label for="obs_canc" class="col-form-label">Observación Cancelación</label>
								<textarea id="obs_canc" name="obs_canc" class="form-control text text-sm crear"></textarea>
							</div>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" id="btn-cancelar"
						title="Cancelar la reserva y cerrar la ventana">Aplicar</button>
					<button type="button" class="btn btn-secondary" id="btn-cerrar" data-bs-dismiss="modal" aria-label="Close"
						title="Cerrar la ventana y descartar los cambios">Cerrar</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
		data-bs-backdrop="static" id="mdl-noshow">
		<div class="modal-dialog modal-dialog-centered modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="nsh_res"></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="card-body">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 mb-3">
								<label for="clave_usuario_ns" class="col-form-label">Ingrnse su clave<span class="requerido">*</span></label>
								<input type="password" class="form-control req" id="clave_usuario_es" name="clave_usuario_ns">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" id="btn-cancelar_ns"
						title="Marcar la reserva como No Show y cerrar la ventana">Aplicar</button>
					<button type="button" class="btn btn-secondary" id="btn-cerrar_ns" data-bs-dismiss="modal" aria-label="Close"
						title="Cerrar la ventana y descartar los cambios">Cerrar</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	{{-- @include('crm.historial') --}}

	<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
		data-bs-backdrop="static" id="mdl-estado">
		<div class="modal-dialog modal-dialog-centered modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="est_res"></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="card-body">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 mb-3">
								<label for="clv" class="col-form-label">Ingrese su clave<span class="requerido">*</span></label>
								<input type="password" class="form-control req" id="clv" name="clv">
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 mb-3">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 mb-3">
										<label for="estado">Estado<span class="requerido">*</span></label><br />
										<select class="form-select req" id="estado"></select>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" id="btn-cancelar_es"
						title="Marcar la reserva como No Show y cerrar la ventana">Aplicar</button>
					<button type="button" class="btn btn-secondary" id="btn-cerrar_es" data-bs-dismiss="modal" aria-label="Close"
						title="Cerrar la ventana y descartar los cambios">Cerrar</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
		data-bs-backdrop="static" id="mdl-registro">
		<div class="modal-dialog modal-dialog-centered modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="reg_res"></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="card-body">
						<table id="registro_tbl" class="table table-striped" data-toggle="table" data-buttons="btnAgrCliente"
							data-id-field="id" data-unique-id="id" data-search="true" data-show-refresh="true" data-show-toggle="true"
							data-show-columns="true" data-locale="es-CL" data-icons-prefix="fas" data-icons="icons">
							<thead>
								<tr>
									<th data data-field="id">id</th>
									<th data data-field="fecha_reserva">fecha_reserva</th>
									<th data data-field="razon_cancelacion">razon_cancelacion</th>
									<th data data-field="observacion_cancelacion">observacion_cancelacion</th>
									<th data data-field="hora_reserva">hora_reserva</th>
									<th data data-field="nombre_cliente">nombre_cliente</th>
									<th data data-field="nombre_empresa">nombre_empresa</th>
									<th data data-field="fecha_ultima_modificacion">fecha_ultima_modificacion</th>
									<th data data-field="usuario_ultima_modificacion">usuario_ultima_modificacion</th>
									<th data data-field="nombre_hotel">nombre_hotel</th>
									<th data data-field="cantidad_pasajeros">cantidad_pasajeros</th>
									<th data data-field="telefono_cliente">telefono_cliente</th>
									<th data data-field="tipo_reserva">tipo_reserva</th>
									<th data data-field="email_cliente">email_cliente</th>
									<th data data-field="salon">salon</th>
									<th data data-field="mesa">mesa</th>
									<th data data-field="estado">estado</th>
									<th data data-field="observaciones">observaciones</th>
									<th data data-field="usuario_registro">usuario_registro</th>
									<th data data-field="clave_usuario">clave_usuario</th>
									<th data data-field="sucursal">sucursal</th>
									<th data data-field="dianoche">dianoche</th>
									<th data data-field="archivo_1" data-formatter="imageFormatter">archivo_1</th>
									<th data data-field="archivo_2" data-formatter="imageFormatter">archivo_2</th>
									<th data data-field="archivo_3" data-formatter="imageFormatter">archivo_3</th>
									<th data data-field="archivo_4" data-formatter="imageFormatter">archivo_4</th>
									<th data data-field="archivo_5" data-formatter="imageFormatter">archivo_5</th>
									<th data data-field="cliente_id">cliente_id</th>
									<th data data-field="evento_nombre_adicional">evento_nombre_adicional</th>
									<th data data-field="evento_pax">evento_pax</th>
									<th data data-field="evento_valor_menu">evento_valor_menu</th>
									<th data data-field="evento_total_sin_propina">evento_total_sin_propina</th>
									<th data data-field="evento_total_propina">evento_total_propina</th>
									<th data data-field="evento_email_contacto">evento_email_contacto</th>
									<th data data-field="evento_telefono_contacto">evento_telefono_contacto</th>
									<th data data-field="evento_anticipo">evento_anticipo</th>
									<th data data-field="evento_paga_en_local">evento_paga_en_local</th>
									<th data data-field="evento_audio">evento_audio</th>
									<th data data-field="evento_video">evento_video</th>
									<th data data-field="evento_video_audio">evento_video_audio</th>
									<th data data-field="evento_restriccion_alimenticia">evento_restriccion_alimenticia</th>
									<th data data-field="evento_ubicacion">evento_ubicacion</th>
									<th data data-field="evento_monta">evento_monta</th>
									<th data data-field="evento_detalle_restriccion">evento_detalle_restriccion</th>
									<th data data-field="ambiente">ambiente</th>
									<th data data-field="usuario_confirmacion">usuario_confirmacion</th>
									<th data data-field="usuario_rechazo">usuario_rechazo</th>
									<th data data-field="fecha_confirmacion">fecha_confirmacion</th>
									<th data data-field="fecha_rechazo">fecha_rechazo</th>
									<th data data-field="razon_rechazo">razon_rechazo</th>
									<th data data-field="evento_comentarios">evento_comentarios</th>
									<th data data-field="evento_nombre_contacto">evento_nombre_contacto</th>
									<th data data-field="evento_idioma">evento_idioma</th>
									<th data data-field="evento_cristaleria">evento_cristaleria</th>
									<th data data-field="evento_decoracion">evento_decoracion</th>
									<th data data-field="evento_mesa_soporte_adicional">evento_mesa_soporte_adicional</th>
									<th data data-field="evento_extra_permitido">evento_extra_permitido</th>
									<th data data-field="evento_menu_impreso">evento_menu_impreso</th>
									<th data data-field="evento_table_tent">evento_table_tent</th>
									<th data data-field="evento_logo" data-formatter="imageFormatter">evento_logo</th>
									<th data data-field="created_at">created_at</th>
									<th data data-field="updated_at">updated_at</th>
									<th data data-field="deleted_at">deleted_at</th>
								</tr>
							</thead>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" id="btn-cancelar_es"
							title="Marcar la reserva como No Show y cerrar la ventana">Aplicar</button>
						<button type="button" class="btn btn-secondary" id="btn-cerrar_es" data-bs-dismiss="modal"
							aria-label="Close" title="Cerrar la ventana y descartar los cambios">Cerrar</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->


	</div>

	<!-- Modal -->

	<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
		data-bs-backdrop="static" id="mdl-clave">
		<div class="modal-dialog modal-dialog-centered modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Introduzca su clave</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form>
						<div class="form-group">
							<label for="ex-clave" class="col-form-label">Clave:</label>
							<input type="password" class="form-control" id="ex-clave">
						</div>
					</form>
				</div><!-- /.modal-content -->
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" id="btn-continuar_clv"
						title="Verificar usuario y clave y continuar">Continuar</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"
						title="Cerrar la ventana y descartar los cambios">Cerrar</button>
				</div>
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div>

    <div class="tipo">
        <input type="hidden" name="" id="tipo_update" value="" >
    </div>

    @include('crm.modal-pax')
    @include('crm.modal-mesas')
    @include('crm.modal-estados')
    @include('crm.modal-obs')
    @include('crm.modal-rechazo')
	@include('crm.modal-salones')
	{{-- @include('crm.modal-aceptar') --}}
	@include('components.modal-vreserva-aceptar')

	@include('components.mdl-vreserva')

@endsection
<script>
	var token = '{{ csrf_token() }}';
</script>
@section('script')
	<script>
		var base = "{{ url('/') }}";
        var editar_reserva="{{auth()->user()->can('editar reservas')}}";
        var cancelar_reserva="{{auth()->user()->can('cancelar reservas')}}";
        var rechazar_reserva="{{auth()->user()->can('rechazar reservas')}}";
		var today = "{{ date('Y-m-d') }}";
	</script>

	<script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
	<script src="{{ URL::asset('/assets/js/app/comunes/tabla_config.js') }}"></script>
	{{-- <script src="{{ URL::asset('/assets/js/app/comunes/tabla_init.js') }}"></script> --}}
	<script src="{{ URL::asset('/assets/js/app/comunes/funciones.js') }}"></script>
	<script src="{{ URL::asset('/assets/js/app/crm/index.js') }}"></script>
@endsection
