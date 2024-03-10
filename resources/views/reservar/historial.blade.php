@extends('layouts.master')
@section('title')
	Historial de Reservas
@endsection
@section('css')
@endsection
@section('content')
@section('pagetitle')
	Historial de Reservas
@endsection
<meta name="_token" content="{{ csrf_token() }}">
<div class="uper">
	<div class="uper d-sm-none">
		<div class="card card-header">
			Historial de Reservas
		</div>
	</div>

    {{-- validaciones de vistas para permisos --}}
    <div class="valida_permisos">

        @unlessrole('supervisor')
            <div id="reserva_rollback_permiso"></div>
        @endunlessrole
        {{-- @can('rollback reserva')

        @endcan --}}

		@can('rollback historial')
			<div class="can-rollback-historial"></div>
		@endcan

    </div>


	<div class="table-responsive mt-4">
		<table id="historial_tbl" class="table" data-toggle="table" data-url="/reservar/historial_cambios"
			data-buttons="btnAgrCliente" data-id-field="id" data-unique-id="id" data-search="true" data-search-align="left"
			data-height="400" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-pagination="true"
			data-page-list="[10, 25, 50, 100, all]" data-locale="es-CL" data-icons-prefix="fas" data-icons="icons"
			data-row-style="filaEvento">
			<thead>
				<tr>
					<th data-field="id" data-sortable="true">ID</th>
					<th data-field="reserva_id" data-sortable="true">ID<br /> Reserva</th>
					<th data-field="nombre_cliente" data-sortable="true">Cliente</th>
					<th data-field="fecha_reserva" data-sortable="true" data-formatter="fechaFormatter">Fecha</th>
					<th data-field="hora_reserva" data-sortable="true" data-formatter="horaFormatter" >Hora</th>
					<th data-field="estado_previo" data-sortable="true">Estado<br />Previo</th>
					<th data-field="estado_actual" data-sortable="true">Estado<br />Actual</th>
					<th data-field="ttipo_cambio" data-sortable="true">Tipo<br />Cambio</th>
					<th data-field="fecha_cambio" data-sortable="true" data-formatter="fechaFormatter2">Fecha <br />Cambio</th>
					<th data-field="usuario" data-sortable="true">Usuario<br />Cambio</th>
					<th data-field="actions" class="td-actions text-center" data-click-to-select="false"
						data-formatter="listarHistorialFormatter">ACCIONES</th>
				</tr>
			</thead>
		</table>
	</div>
	<div class='container'>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 bg-warning">
				<div class="row">
					<div class="col-12 text-center">
						<h5>Registro Actual</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Fecha Reserva</strong></label>
							<label id="fecha_reserva_act"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Hora Reserva</strong></label><br />
							<label id="hora_reserva_act"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Tipo</strong></label><br />
							<label id="tipo_act"></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Estado Reserva</strong></label><br />
							<label id="testado_act"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Pax Reserva</strong></label><br />
							<label id="cantidad_pasajeros_act"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Cliente</strong></label><br />
							<label id="nombre_cliente_act"></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Correo</strong></label><br />
							<label id="email_cliente_act"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Teléfono</strong></label><br />
							<label id="telefono_cliente_act"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Empresa</strong></label><br />
							<label id="nombre_empresa_act"></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Hotel</strong></label><br />
							<label id="nombre_hotel_act"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Sucursal</strong></label><br />
							<label id="tsucursal_act"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Salón</strong></label><br />
							<label id="tsalon_act"></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Mesa</strong></label><br />
							<label id="tmesa_act"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Observaciones</strong></label><br />
							<label id="observaciones_act"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Usuario</strong></label><br />
							<label id="tusuario_registro_act"></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Nombre Adicional</strong></label><br />
							<label id="evento_nombre_adicional_act"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Pax</strong></label><br />
							<label id="evento_pax_act"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Idioma</strong></label><br />
							<label id="evento_idioma_act"></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Nombre Contacto</strong></label><br />
							<label id="evento_nombre_contacto_act"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Teléfono Contacto</strong></label><br />
							<label id="evento_telefono_contacto_act"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Correo Contacto</strong></label><br />
							<label id="evento_email_contacto_act"></label>
						</div>
					</div>
				</div>
			</div>
			<hr class="d-md-none" />
			<div class="col-xs-12 col-sm-12 col-md-6 bg-info">
				<div class="row">
					<div class="col-12 text-center">
						<h5>Registro Previo</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Fecha Reserva</strong></label>
							<label id="fecha_reserva_prv"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Hora Reserva</strong></label><br />
							<label id="hora_reserva_prv"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Tipo</strong></label><br />
							<label id="tipo_prv"></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Estado Reserva</strong></label><br />
							<label id="testado_prv"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Pax Reserva</strong></label><br />
							<label id="cantidad_pasajeros_prv"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Cliente</strong></label><br />
							<label id="nombre_cliente_prv"></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Correo</strong></label><br />
							<label id="email_cliente_prv"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Teléfono</strong></label><br />
							<label id="telefono_cliente_prv"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Empresa</strong></label><br />
							<label id="nombre_empresa_prv"></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Hotel</strong></label><br />
							<label id="nombre_hotel_prv"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Sucursal</strong></label><br />
							<label id="tsucursal_prv"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Salón</strong></label><br />
							<label id="tsalon_prv"></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Mesa</strong></label><br />
							<label id="tmesa_prv"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Observaciones</strong></label><br />
							<label id="observaciones_prv"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Usuario</strong></label><br />
							<label id="tusuario_registro_prv"></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Nombre Adicional</strong></label><br />
							<label id="evento_nombre_adicional_prv"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Pax</strong></label><br />
							<label id="evento_pax_prv"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Idioma</strong></label><br />
							<label id="evento_idioma_prv"></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Nombre Contacto</strong></label><br />
							<label id="evento_nombre_contacto_prv"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Teléfono Contacto</strong></label><br />
							<label id="evento_telefono_contacto_prv"></label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="form-group">
							<label><strong>Correo Contacto</strong></label><br />
							<label id="evento_email_contacto_prv"></label>
						</div>
					</div>
				</div>
			</div>
		@endsection
		<script>
			var token = '{{ csrf_token() }}';
		</script>
		@section('script')
			<script>
				var base = "{{ url('/') }}";
                var rollback_historial = "{{auth()->user()->can('rollback historial')}}";
			</script>
			<script src="{{ URL::asset('/assets/js/app/comunes/tabla_config.js') }}"></script>
			<script src="{{ URL::asset('/assets/js/app/comunes/tabla_init.js') }}"></script>
			<script src="{{ URL::asset('/assets/js/app/reservar/historial.js') }}"></script>
		@endsection
