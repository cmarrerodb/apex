@extends('layouts.master')
@section('title')
    Calendar
@endsection
@section('content')
@section('pagetitle')
    Calendar
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/selectpicker/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/colorpicker/picker.css') }}">
    <style>
        .popper,
        .tooltip {
            position: absolute;
            z-index: 9999;
            background: #FFC107;
            color: black;
            width: 150px;
            border-radius: 3px;
            box-shadow: 0 0 2px rgba(0, 0, 0, 0.5);
            padding: 10px;
            text-align: center;
        }

        .style5 .tooltip {
            background: #1E252B;
            color: #FFFFFF;
            max-width: 200px;
            width: auto;
            font-size: .8rem;
            padding: .5em 1em;
        }

        .popper .popper__arrow,
        .tooltip .tooltip-arrow {
            width: 0;
            height: 0;
            border-style: solid;
            position: absolute;
            margin: 5px;
        }

        .tooltip .tooltip-arrow,
        .popper .popper__arrow {
            border-color: #FFC107;
        }

        .style5 .tooltip .tooltip-arrow {
            border-color: #1E252B;
        }

        .popper[x-placement^="top"],
        .tooltip[x-placement^="top"] {
            margin-bottom: 5px;
        }

        .popper[x-placement^="top"] .popper__arrow,
        .tooltip[x-placement^="top"] .tooltip-arrow {
            border-width: 5px 5px 0 5px;
            border-left-color: transparent;
            border-right-color: transparent;
            border-bottom-color: transparent;
            bottom: -5px;
            left: calc(50% - 5px);
            margin-top: 0;
            margin-bottom: 0;
        }

        .popper[x-placement^="bottom"],
        .tooltip[x-placement^="bottom"] {
            margin-top: 5px;
        }

        .tooltip[x-placement^="bottom"] .tooltip-arrow,
        .popper[x-placement^="bottom"] .popper__arrow {
            border-width: 0 5px 5px 5px;
            border-left-color: transparent;
            border-right-color: transparent;
            border-top-color: transparent;
            top: -5px;
            left: calc(50% - 5px);
            margin-top: 0;
            margin-bottom: 0;
        }

        .tooltip[x-placement^="right"],
        .popper[x-placement^="right"] {
            margin-left: 5px;
        }

        .popper[x-placement^="right"] .popper__arrow,
        .tooltip[x-placement^="right"] .tooltip-arrow {
            border-width: 5px 5px 5px 0;
            border-left-color: transparent;
            border-top-color: transparent;
            border-bottom-color: transparent;
            left: -5px;
            top: calc(50% - 5px);
            margin-left: 0;
            margin-right: 0;
        }

        .popper[x-placement^="left"],
        .tooltip[x-placement^="left"] {
            margin-right: 5px;
        }

        .popper[x-placement^="left"] .popper__arrow,
        .tooltip[x-placement^="left"] .tooltip-arrow {
            border-width: 5px 0 5px 5px;
            border-top-color: transparent;
            border-right-color: transparent;
            border-bottom-color: transparent;
            right: -5px;
            top: calc(50% - 5px);
            margin-left: 0;
            margin-right: 0;
        }

        /* #calendar{
            min-width: 900px;
            width: 100%;            
            overflow-x: scroll;
            
        } */       
        
        @media (max-width: 800px) {
            /* Estilos para pantallas con ancho menor o igual a 768px */

            #cal{
                min-width: 800px;
                width: 100%;            
                overflow-x: scroll;
            }

        }


        /* .ui-colorpicker{ margin-top: 20% !mportant; margin-left: 5% !mportant; } */
	</style>
@endsection
@include('components.mdl-vreserva')
{{-- Todo: faltando la edicion de la reserva 10-01-24 --}}

<meta name="_token" content="{{ csrf_token() }}">
<div class="">
    <div class="row">
        {{-- <div class="col-xs-12 col-sm-12 col-md-1 offset-md-2 ">
			<div class="mb-3">
				<button class="btn btn-primary" id ="filtrarEventos">filtro</button>
			</div>
		</div> --}}
        <div class="d-flex align-items-end justify-content-end col-md-12 mb-3">
            <i id="expanderCalendario" class="fas fa-expand-arrows-alt" title="Expandir el calendario"></i>
        </div>
        
    </div>


    <div class="row">
        <div class="col-xl-3 d-none d-sm-block" id='cont'>
            <div class="row">
                {{-- <div class="col-xs-12">
                    <span class="text-danger">Test de cambios Felix  </span>
                </div> --}}
                    

                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="mb-3">
                        <label for="selEstado" class="form-label font-size-13 text-muted">Estados</label><br />
                        <select id="selEstado" class="selectpicker" data-live-search="true" multiple>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6  form-group">
                    <div class="mb-3">
                        <label for="selSucursal" class="form-label font-size-13 text-muted" multiple=false>Sucursal</label>
                        <select class="form-control fondo1" data-trigger name="selSucursal" id="selSucursal"
                            placeholder="Seleccione la sucursal">
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 mb-2">
                    <label for="selTurno" class="form-label">Turno</label>
                    <select class="form-control" id="selTurno">
                        <option selected>Todas</option>
                        <option value=1>Tarde</option>
                        <option value=2>Noche</option>
                    </select>
                </div>               

            </div>           


            <div class="card card-h-100">
                <div class="card-body">
                    <a href="{{ url('/') }}/reservar/reservar" id="crear_reservas"
                        class="form-control btn btn-primary mb-3 ">Crear reserva</a>
                    <div>Tipos de Reservas</div>
                    <div id="external-events">
                        <br>
                        @foreach ($actionTypes as $actionType)
                            <div class="external-event row fc-event {{ $actionType->color_class }} action-list"
                                data-class="{{ $actionType->color_class }}">
                                {{-- <input type="checkbox" name="" id="{{ $actionType->color_class }}" checked> --}}
                                @php $valor = $actionType->estado @endphp
                                <div class="col-9">
                                    <input type="checkbox" name="" id="{{ $actionType->color_class }}"
                                        title="{{ $actionType->estado }}"
                                        @if ($valor == 'EVENTO') checked 
									@else 
										'' @endif>
                                    {{ $actionType->estado }}
                                </div>
                                <div class="col-3">
                                    <span class="cant_tipo" id = "{{ 'det_' . $actionType->estado }}"
                                        style="background-color:#000;color:#fff;font-weight:bold;padding:4px;display:flex;justify-content:flex-end;border: 2px solid white;"></span>
                                </div>
                            </div>
                        @endforeach
                        <hr />
                        <div class="row flex-column flex-md-row justify-content-center align-items-center">
                            <div class="col-12 col-md-6 mb-3 mb-md-0">
                                <button type="button" class="btn btn-primary btn-xl w-100" id="marcarTipos"
                                    title="Selecciona todos los tipos de reservas"><span
                                        style="font-size:90% !important;">TODOS</span></button>
                            </div>
                            <div class="col-12 col-md-6">
                                <button type="button" class="btn btn-dark btn-xl w-100" id="desmarcarTipos"
                                    title = "Deselecciona todos los tipos de reservas y sólo deja EVENTO"><span
                                        style="font-size:90% !important;">EVENTOS</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->

        {{-- <div id="calendar"></div> --}}

        <div class="col-xl-9 px-0 px-sm-1" id='cal'>
            <div class="card  card-h-100">
                <div class="row p-2 d-flex justify-content-around " id="select-wrapper">
                    <div id="popover-content">
                    </div>
                    <div id="calendar"></div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
</div>
<div style='clear:both'></div>

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

    @can('crear bloqueos')
        <div class="can-crear-bloqueo"></div>
    @endcan
</div>

<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" id="mdl-cancelar">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="can_res">Cancelar Reserva</h5>
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
                            <textarea id="obs_canc" name="obs_canc" class="form-control text text-sm crear"></textarea>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btn-cancelar"
                    title="Cancelar la reserva y cerrar la ventana">Aplicar</button>
                <button type="button" class="btn btn-secondary" id="btn-cerrar" data-bs-dismiss="modal"
                    aria-label="Close" title="Cerrar la ventana y descartar los cambios">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" id="mdl-noshow">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nsh_res">No Show</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                            <label for="clave_usuario_ns" class="col-form-label">Ingrnse su clave<span
                                    class="requerido">*</span></label>
                            <input type="password" class="form-control req" id="clave_usuario_es"
                                name="clave_usuario_ns">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btn-ns"
                    title="Marcar la reserva como No Show y cerrar la ventana">Aplicar</button>
                <button type="button" class="btn btn-secondary" id="btn-cerrar_ns" data-bs-dismiss="modal"
                    aria-label="Close" title="Cerrar la ventana y descartar los cambios">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" id="mdl-bloquear">
    <div class="modal-dialog  modal-md">
    {{-- <div class="modal-dialog modal-dialog-centered modal-md"> --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="blq_res">Bloquear Fecha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                            <label for="clave_usuario_bl" class="col-form-label">Ingrese su clave<span
                                    class="requerido">*</span></label>
                            <input type="password" class="form-control req" id="clave_usuario_bl"
                                name="clave_usuario_ns">
                        </div>
                    </div>
                    .<div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label for="fechainicio">Fecha Inicio<span class="requerido">*</span> </label>
                            <input type="date" id="fechainicio" class="form-control">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label for="horainicio">Hora Inicio<span class="requerido">*</span> </label>
                            <input type="time" id="horainicio" class="form-control" step="1monitor"
                                value='00:00'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label for="fechafin">Fecha Fin<span class="requerido">*</span> </label>
                            <input type="date" id="fechafin" class="form-control">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label for="horafi1n">Hora Fin<span class="requerido">*</span> </label>
                            <input type="time" id="horafin" class="form-control" step="1monitor"
                                value = '23:59'>
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
                    <button type="button" class="btn btn-danger" id="btn-bl"
                        title="Bloquear la reserva y cerrar la ventana">Bloquear</button>
                    <button type="button" class="btn btn-secondary" id="btn-cerrar_bloquear"
                        data-bs-dismiss="modal" data-bs-target="mdl-bloquear" aria-label="Close"
                        title="Cerrar la ventana y descartar los cambios">Cerrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <input type="hidden" id="current_route" name="current_route" value="{{ URL()->current() }}">

@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app/comunes/funciones.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/bootstrap-select/default-es_CL.js') }}"></script>
    <script src="{{ URL::asset('assets/js/fullcalendar.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/selectpicker/bootstrap-select.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app/calendario/index.js') }}"></script>
    <script src="{{ URL::asset('assets/js/colorpicker/picker.js') }}"></script>
    <script>
        var currentRoute = $('#current_route').val();
    </script>
    <script>
        @if (Session::has('message'))
            var icon = '{{ session('message.success') }}';
            var mensaje = '{{ session('message.msg') }}';
            Swal.fire({
                title: 'Mensaje',
                text: mensaje,
                icon: icon,
                timer: 2000,
                timerProgressBar: true
            });
        @endif
        var base = "{{ url('/') }}";
    </script>
@endsection
