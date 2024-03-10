@extends('layouts.master')
@section('title')
Inicio
@endsection
@section('content')
@section('pagetitle')
Inicio
@endsection
<meta name="_token" content="{{ csrf_token() }}">

<div class="d-flex justify-content-between flex-wrap">

    <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-2 col-xl-2 mb-2">
        <label for="">Sucursal</label>
        <select class="form-select" id="selSucursal" aria-label="Default select example">
        </select>
    </div>

    <div class=" col-12 col-xs-12 col-sm-12 col-md-3 col-lg-2 col-xl-2 ">
        <label for="">Fecha</label>
        <input type="date" class="form-control" id="fecha" name="fecha">
    </div>

    <div class="mt-x">

        <div class="btn-group " role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="btnTurno" id="btnTodos" autocomplete="off"
                title="Mostrar todos los turnos" value=3>
            <label class="btn btn-primary" for="btnTodos"
                checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Todos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="radio" class="btn-check" name="btnTurno" id="btnManana" autocomplete="off"
                title="Filtrar turno de la mañana" value=1>
            <label class="btn btn-success"
                for="btnManana">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tarde&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="radio" class="btn-check" name="btnTurno" id="btnTarde" autocomplete="off"
                title="Filtrar turno de la tarde" value=2>
            <label class="btn btn-danger"
                for="btnTarde">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Noche&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        </div>

    </div>

    <div class="col-xl-2 mb-3 mt-x ">

        <div class="row">
            <div class="col-12">
                <button class="btn btn-success btn-md">Consumo del cliente</button>
                

            </div>
        </div>
    </div>


    <div class="d-flex ">
        <div class=" mb-1 ">
            <div>Total Pax</div>
            <div class="redondo ">
                <p id="total_pax"></p>
            </div>
        </div>

    </div>

</div>



{{-- ******************************************* --}}
{{-- Inicio Acordeon --}}
<div class="accordion" id="accordionExample">
    {{-- <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Filtros Avanzados (click para mostrar)
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="text-muted">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 form-group">
                            <div class="mb-3">
                                <label for="bsqClientes">Clientes</label>
                                <select id="bsqClientes" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 form-group">
                            <div class="mb-3">
                                <label for="bsqTelefono">Teléfono</label>
                                <select id="bsqTelefono" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 form-group">
                            <div class="mb-3">
                                <label for="bsqCorreo">Correo</label>
                                <select id="bsqCorreo" class="form-control">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 form-group">
                            <label for="bsqEmpresa">Empresa</label>
                            <select id='bsqEmpresa' class="form-control"></select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 form-group">
                            <label for="bsqHotel">Hotel</label>
                            <select id='bsqHotel' class="form-control"></select>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- ******************************************* --}}
    {{-- Fin Acordeon --}}
    {{-- data-url="reservar/list_fecha/{{ now()->format('Y-m-d') }}" --}}
    {{-- data-url="/reservar/get_reservas_sucursal_fecha/2/{{ now()->format('Y-m-d') }}" --}}

    <div id="toolbar">
        <form class="form-inline">
            <div class="form-group">
                <select id="estado_filter" class="form-select ">
                    <option value="">Seleccione Estado</option>
                    @if (count($estados)>0)
                        @foreach ($estados as $item)
                            @if ($item->id !=4 && $item->id !=7 && $item->id !=8)
                                <option value="{{$item->estado}}">{{$item->estado}}</option>                            
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>
        </form>
    </div>

    {{-- Validacion de permisos  --}}
    <div class="validar-permisos">

        @can('editar reservas')
            <div class="can-edit-reserva"></div>
        @endcan

        @can('cancelar reservas')
        <div class="can-cancelar-reserva"></div>
        @endcan

        @can('no-show reservas')
        <div class="can-no-show-reserva"></div>
        @endcan
        {{-- @role('administrador')
            <div class="can-edit-reserva"></div>
        @endrole --}}
    </div>

    <div class="row">
        <div class="table-responsive mt-4">
            <table id="reservas_tbl" async="true" class="table " 
                data-toggle="table" 
                data-id-field="id"
                data-url="reservar/list_fecha/{{ now()->format('Y-m-d') }}" 
                data-unique-id="id"
                data-search="true"
                data-search-align="left" 
                data-toolbar="#toolbar" 
                data-min-height="300" 
                data-height="650" 
                data-show-refresh="true"
                data-show-toggle="true" 
                data-show-columns="true"           
                data-locale="es-CL" 
                data-icons-prefix="fas" 
                data-icons="icons"
                data-pagination="true"
                data-page-list="[1000,2000,All]"
                {{-- data-side-pagination="server" --}}
                data-row-style="filaEvento" 
                data-buttons="btnAgregar">
                <thead>
                    <tr>
                        <th data-field="id" data-formatter="botonesFormatter"></th>
                        {{-- <th data-field="id" data-sortable="true" data-formatter="editarFormatter">Modificar</th>
                        <th data-field="id" data-sortable="true" data-formatter="verFormatter">Ver</th> --}}
                        <th data-field="nombre_cliente" data-sortable="true">
                            Cliente</th>
                        <th data-field="telefono_cliente" data-sortable="true">Teléfono</th>
                        <th data-field="email_cliente" data-sortable="true">Correo</th>
                        <th data-field="nombre_empresa" data-sortable="true">Empresa</th>
                        <th data-field="nombre_hotel" data-sortable="true">Hotel</th>
                        <th data-field="fecha_reserva" data-sortable="true" data-formatter="fechaFormatter">Fecha</th>
                        <th data-field="hora_reserva" data-sortable="true" data-formatter="horaFormatter">Hora</th>
                        <th data-field="cantidad_pasajeros" data-sortable="true">Pax</th>
                        <th data-field="tsucursal" data-sortable="true">Sucursal</th>
                        <th data-field="tsalon" data-sortable="true">Salón</th>
                        <th data-field="tmesa" data-sortable="true">Mesa</th>
                        <th data-field="testado" data-sortable="true">Estado</th>
                        <th data-field="tipo" data-sortable="true">Tipo</th>
                        <th data-field="archivo_1" data-formatter="menuFormatter">Menú 1</th>
                        <th data-field="archivo_2" data-formatter="menuFormatter">Menú 2</th>
                        <th data-field="observaciones" data-sortable="true" data-formatter="obsFormatter">Observaciones</th>
                        <th data-field="evento_nombre_adicional" data-sortable="true">Nombre <br />evento</th>
                        <th data-field="evento_pax" data-sortable="true">Pax</th>
                        <th data-field="evento_valor_menu" data-sortable="true">Valor<br />Menú</th>
                        <th data-field="evento_total_sin_propina" data-sortable="true">Total S/ <br />Propina</th>
                        <th data-field="evento_total_propina" data-sortable="true">Total C/ <br />Propina</th>
                        <th data-field="evento_nombre_contacto" data-sortable="true">Contacto</th>
                        <th data-field="evento_email_contacto" data-sortable="true">Correo <br />Contacto</th>
                        <th data-field="evento_telefono_contacto" data-sortable="true">Tel </br>Contacto</th>
                        <th data-field="evento_anticipo" data-sortable="true">Anticipo</th>
                        <th data-field="tevento_paga_en_local" data-sortable="true">Paga en <br />local</th>
                        <th data-field="tevento_audio" data-sortable="true">Audio</th>
                        <th data-field="tevento_video" data-sortable="true">Video</th>
                        <th data-field="tevento_video_audio" data-sortable="true">Video y Audio</th>
                        <th data-field="tevento_restriccion_alimenticia" data-sortable="true">Restricción <br /></th>
                        <th data-field="evento_ubicacion" data-sortable="true">Ubicación</th>
                        <th data-field="evento_monta" data-sortable="true">Monta</th>
                        <th data-field="evento_detalle_restriccion" data-sortable="true">Detalle <br /></th>
                        <th data-field="ambiente" data-sortable="true">Ambiente</th>
                        <th data-field="evento_comentarios" data-sortable="true">Comentario</th>
                        <th data-field="evento_idioma" data-sortable="true">Idioma</th>
                        <th data-field="evento_cristaleria" data-sortable="true">Cristaleria</th>
                        <th data-field="evento_decoracion" data-sortable="true">Decoración</th>
                        <th data-field="evento_mesa_soporte_adicional" data-sortable="true">Soporte Adicional</th>
                        <th data-field="evento_extra_permitido" data-sortable="true">Extra <br />Permitido</th>
                        <th data-field="evento_menu_impreso" data-sortable="true">Menú <br />Impreso</th>
                        <th data-field="evento_table_tent" data-sortable="true">Table Tent</th>
                        <th data-field="evento_logo" data-sortable="true">Logo</th>
                        <th data-field="usuario_confirmacion" data-sortable="true">Usuario <br />Confirmación</th>
                        <th data-field="usuario_rechazo" data-sortable="true">Usuario <br />Rechazo</th>
                        <th data-field="fecha_confirmacion" data-sortable="true">Fecha <br />Confirmación</th>
                        <th data-field="fecha_rechazo" data-sortable="true">Fecha <br />Rechazo</th>
                        <th data-field="razon_rechazo" data-sortable="true">Razón <br />Rechazo</th>
                        <th data-field="razon" data-sortable="true">Razón <br />Cancelación</th>
                        <th data-field="observacion_cancelacion" data-sortable="true">Observación<br />Cancelación</th>
                        {{-- <th data-field="actions" class="td-actions text-center" data-click-to-select="false"
                            data-formatter="listarReservasFormatter">ACCIONES</th> --}}
                        <th data-field="id" data-formatter="accionesFormatter">ACCIONES</th>
                        {{-- <th data-formatter="botonCFormatter"></th>
                        <th data-formatter="botonNsFormatter"></th> --}}
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    {{-- mdl-noshow --}}
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
                                <label for="clave_usuario_ns" class="col-form-label">Ingrese su clave<span
                                        class="requerido">*</span></label>
                                <input type="password" class="form-control req" id="clave_usuario_es"
                                    name="clave_usuario_ns">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="btn-cancelar_ns"
                        title="Marcar la reserva como No Show y cerrar la ventana">Aplicar</button>
                    <button type="button" class="btn btn-secondary" id="btn-cerrar_ns" data-bs-dismiss="modal"
                        aria-label="Close" title="Cerrar la ventana y descartar los cambios">Cerrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    {{-- mdl-reserva --}}
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
    {{-- mdl-cancelar --}}
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
                                <label for="clave_usuario" class="col-form-label">Ingrese su clave<span
                                        class="requerido">*</span></label>
                                <input type="password" class="form-control req" id="clave_usuario" name="clave_usuario">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <label for="raz_canc">Razón de la Cancelación<span
                                        class="requerido">*</span></label><br />
                                <select class="form-select req" id="raz_canc"></select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <label for="obs_canc" class="col-form-label">Observación Cancelación</label>
                                <textarea id="obs_canc" name="obs_canc"
                                    class="form-control text text-sm crear"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="btn-cancelar1"
                        title="Cancelar la reserva y cerrar la ventana">Aplicar</button>
                    <button type="button" class="btn btn-secondary" id="btn-cerrar" data-bs-dismiss="modal"
                        aria-label="Close" title="Cerrar la ventana y descartar los cambios">Cerrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    {{-- mdl-rechazo --}}
    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
        data-bs-backdrop="static" id="mdl-rechazo">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rec_res"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <label for="clave_usuario-r" class="col-form-label">Ingrese su clave<span
                                        class="requerido">*</span></label>
                                <input type="password" class="form-control req" id="clave_usuario-r"
                                    name="clave_usuario-r">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <label for="raz_rechazo">Razón del Rechazo<span class="requerido">*</span></label><br />
                                <textarea class="form-select req" id="raz_rechazo"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="btn-rechazar"
                        title="Cancelar la reserva y cerrar la ventana">Aplicar</button>
                    <button type="button" class="btn btn-secondary" id="btn-cerrar_r" data-bs-dismiss="modal"
                        aria-label="Close" title="Cerrar la ventana y descartar los cambios">Cerrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    {{-- mdl-historial --}}
    
    {{-- @include('inicio.historial') --}}

    <!-- /.modal -->
    {{-- mdl-estado --}}
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
                                <label for="clv" class="col-form-label">Ingrese su clave<span
                                        class="requerido">*</span></label>
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
                    <button type="button" class="btn btn-secondary" id="btn-cerrar_es" data-bs-dismiss="modal"
                        aria-label="Close" title="Cerrar la ventana y descartar los cambios">Cerrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    {{-- @include('inicio.modals.modal-crear-reserva') --}}


    
    @include('components.mdl-vreserva')
    @include('components.modal-vreserva-aceptar')

    @include('inicio.historial')




    @endsection

    @section('script')
    <script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app/comunes/tabla_config.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets/js/app/comunes/tabla_init.js') }}"></script> --}}
    <script src="{{ URL::asset('assets/js/app/comunes/funciones.js') }}"></script>

    <script src="{{ URL::asset('assets/js/app/inicio/index.js') }}"></script>
    
    <script type="text/javascript">
        var base = "{{ url('/') }}";
		let date = new Date();
		let day = date.getDate();
		let month = date.getMonth() + 1;
		let year = date.getFullYear();
		if (month < 10) month = "0" + month;
		if (day < 10) day = "0" + day;
		let today = year + "-" + month + "-" + day;
		document.getElementById("fecha").value = today;
    </script>
    @endsection
