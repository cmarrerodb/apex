<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title> @yield('title') Barrica 94 - Reservas</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />  
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="_token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">
        @include('layouts.head-css')
    </head>
<body>
    <div class="container-fluid">
        <div class="card mt-4">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#general" role="tab"
                            title="Datos Generales">
                            <span class="d-block d-sm-none"><i class="fas fa-book-open"></i></span>
                            <span class="d-none d-sm-block">Datos Generales</span>
                        </a>
                    </li>
                    <li class="nav-item" style="visibility:hidden;" id="panel_eventos">
                        <a class="nav-link" data-bs-toggle="tab" href="#eventos" role="tab" title="Eventos">
                            <span class="d-block d-sm-none"><i class="fas fa-birthday-cake"></i></span>
                            <span class="d-none d-sm-block">Ficha Eventos</span>
                        </a>
                    </li>
                    <li class="nav-item" style="visibility:hidden;" id="panel_reservas">
                        <a class="nav-link" data-bs-toggle="tab" href="#reservas" role="tab" title="Reserva">
                            <span class="d-block d-sm-none"><i class="fas fa-birthday-cake"></i></span>
                            <span class="d-none d-sm-block">Reserva</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active" id="general" role="tabpanel">
                        <form id="frm-general" enctype="multipart/form-data">
                            <div class="row" style="background-color:#cafad7;">
                                <div class="col-xs-12 col-sm-12 col-md-3 mb-3">
                                    <label for="fecha_reserva" class="col-form-label">Fecha<span
                                            class="requerido">*</span></label>
                                    <input type="date" class="form-control req row_back1" id="fecha_reserva"
                                        name="fecha_reserva" tabindex="1">
                                    <div class="requerido" id="err_fecha_reserva"></div>
                                    <label for="hora_reserva" class="col-form-label">Hora<span
                                            class="requerido">*</span></label>
                                    <input type="time" class="form-control req row_back1" id="hora_reserva"
                                        name="hora_reserva" tabindex="2">
                                    <div class="requerido" id="err_hora_reserva"></div>
                                    <label for="sucursal" class="col-form-label">N° Pasajeros<span
                                            class="requerido">*</span></label>
                                    <input type="text" class="form-control req row_back1" id="pasajeros"
                                        name="pasajeros" tabindex="3">
                                    <div class="requerido" id="err_pasajros"></div>
                                    <label for="tipo">Tipo<span class="requerido">*</span></label><br />
                                    <select class="form-select req row_back1" id="tipo" tabindex="4"></select>
                                    <div class="requerido" id="err_tipo"></div>
                                    <hr style="visibility: hidden;" />
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3" style="background-color:#f8faca;">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <label for="cliente" class="col-form-label">Cliente<span
                                                    class="requerido">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control req row_back1"
                                                    list="listaClientes" id="cliente"
                                                    placeholder="Escriba para buscar..." tabindex="5">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-eye hist_cli" data-bs-target="#mdl-historial"
                                                            data-bs-toggle="modal"
                                                            style="cursor:pointer;display:none;"
                                                            title="Historial de reservas del cliente"
                                                            id="cons_res"></i>&nbsp;&nbsp;<span id="noshow_cliente"
                                                            class="hist_cli"
                                                            title="Cantidad de No Show del cliente en los últimos 6 meses"></span>&nbsp;&nbsp;
                                                        <i class="fas fa-user-edit hist_cli"
                                                            data-bs-target="#mdl-cliente" data-bs-toggle="modal"
                                                            style="cursor:pointer;display:none;"
                                                            title="Editar cliente" id="cons_cli"></i>
                                                        {{-- &nbsp;&nbsp;<label title="No Show de los ultimos 6 meses">6</label> --}}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="requerido" id="err_cliente"></div>
                                            <datalist id="listaClientes">
                                            </datalist>
                                            <label for="empresa" class="col-form-label">Empresa</label>
                                            <input type="text" class="form-control row_back1" list="listaEmpresas"
                                                id="empresa" placeholder="Escriba para buscar..." tabindex="6">
                                            <datalist id="listaEmpresas">
                                            </datalist>
                                            <label for="hotel" class="col-form-label">Hotel</label>
                                            <input type="text" class="form-control row_back1" list="listaHoteles"
                                                id="hotel" placeholder="Escriba para buscar..." tabindex="7">
                                            <datalist id="listaHoteles">
                                            </datalist>
                                            <label for="telefono" class="col-form-label">Teléfono<span
                                                    class="requerido">*</span></label>
                                            <input type="text" class="form-control req row_back1"
                                                list="listaTelefonos" id="telefono"
                                                placeholder="Escriba para buscar..." tabindex="8" maxlength="25">
                                            <div class="requerido" id="err_telefono"></div>
                                            <datalist id="listaTelefonos">
                                            </datalist>
                                            <label for="correo" class="col-form-label">Correo</label>
                                            <input type="text" class="form-control row_back1" list="listaCorreos"
                                                id="correo" placeholder="Escriba para buscar..." tabindex="9">
                                            <span class="requerido" id="err_correo"></span>
                                            <datalist id="listaCorreos">
                                            </datalist>
                                            <input type="text" class="form-control row_back1" id="correo1"
                                                placeholder="Escriba para buscar..." style="display:none;">
                                            <hr style="visibility: hidden;" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3" style="background-color:#a9c9fc;">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <label for="sucursal" class="col-form-label">Sucursal<span
                                                    class="requerido">*</span></label>
                                            <select id="sucursal" name="sucursal" class="form-control req"
                                                tabindex="10"></select>
                                            <div class="requerido" id="err_sucursal"></div>
                                            <label for="salon" class="col-form-label">Salón</label>
                                            <select id="salon" name="salon"
                                                class="form-control text text-sm crear" tabindex="11"></select>
                                            <div class="requerido" id="err_salon"></div>
                                            <label for="mesa" class="col-form-label">Mesa</label>
                                            <select id="mesa" name="mesa"
                                                class="form-control text text-sm crear" tabindex="12">

                                            </select>
                                            <div class="requerido" id="err_mesa"></div>
                                            </datalist>
                                            <label for="observaciones" class="col-form-label">Observaciones</label>
                                            <textarea id="observaciones" name="observaciones" class="form-control text text-sm crear" rows="10"
                                                tabindex="13"></textarea>
                                            <hr style="visibility: hidden;" />

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3" style="background-color:#fae5ca;;">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <label for="menu1" class="col-form-label">Menú 1</label>
                                            <div class="d-flex align-items-center">
                                                <input type="file" class="form-control" id="menu1"
                                                    name="menu1" accept=".pdf,.png,.jpg,.jpeg" />
                                                <button type="button" class="btn btn-danger clear_menu1 mx-2 btn-sm">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>

                                            <label for="sucursal" class="col-form-label">Menú 2</label>
                                            <div class="d-flex align-items-center">
                                                <input type="file" class="form-control" id="menu2"
                                                    name="menu2" accept=".pdf,.png,.jpg,.jpeg">
                                                <button type="button" class="btn btn-danger clear_menu2 mx-2 btn-sm">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>

                                            <label for="precuenta" class="col-form-label">Precuenta</label>
                                            <div class="d-flex align-items-center">
                                                <input type="file" class="form-control" id="precuenta"
                                                    name="precuenta">
                                                <button type="button"
                                                    class="btn btn-danger clear_precuenta mx-2 btn-sm">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>

                                            <label for="factura" class="col-form-label">Factura</label>
                                            <div class="d-flex align-items-center">
                                                <input type="file" class="form-control" id="factura"
                                                    name="factura" accept=".pdf,.png,.jpg,.jpeg">
                                                <button type="button"
                                                    class="btn btn-danger clear_factura mx-2 btn-sm">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>

                                            <label for="logo" class="col-form-label">Logo</label>
                                            <div class="d-flex align-items-center">
                                                <input type="file" class="form-control" id="logo"
                                                    name="logo" accept=".pdf,.png,.jpg,.jpeg">
                                                <button type="button" class="btn btn-danger clear_logo mx-2 btn-sm">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>

                                            <label for="otro" class="col-form-label">Otro</label>
                                            <div class="d-flex align-items-center">
                                                <input type="file" class="form-control" id="otro"
                                                    name="otro" accept=".pdf,.png,.jpg,.jpeg">
                                                <button type="button" class="btn btn-danger clear_otro mx-2 btn-sm">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>

                                            <hr style="visibility: hidden;" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="eventos" role="tabpanel">
                        <form id="frm-evento">
                            <div class="row" style="background-color:#cafad7;">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <label for="nombre_adicional" class="col-form-label">Nombre adicional</label>
                                    <input type="text" class="form-control row_back1" id="nombre_adicional"
                                        name="nombre_adicional" placeholder="Introduzca nombre adicional">
                                    <div class="requerido" id="err_nombre_adicional"></div>
                                    <label for="pax" class="col-form-label">Pax</label>
                                    <input type="text" class="form-control row_back1" id="pax"
                                        name="pax" placeholder="Introduzca Pax">
                                    <div class="requerido" id="err_pax"></div>
                                    <label for="nombre_contatos" class="col-form-label">Nombre Contacto</label>
                                    <input type="text" class="form-control row_back1" id="nombre_contacto"
                                        name="nombre_contacto" placeholder="Introduzca nombre contacto">
                                    <div class="requerido" id="err_pasajros"></div>
                                    <label for="telefono_contacto">Teléfono contacto</label><br />
                                    <input type="text" class="form-control row_back1" id="telefono_contacto"
                                        name="telefono_contacto" placeholder="Introduzca telefono contacto">
                                    <div class="requerido" id="err_tipo"></div>
                                    <label for="correo_contacto">Correo contacto</label><br />
                                    <input type="text" class="form-control row_back1" id="correo_contacto"
                                        name="correo_contacto" placeholder="Introduzca correo contacto">
                                    <div class="requerido" id="err_tipo"></div>
                                    <label for="idioma">Idioma</label><br />
                                    <input type="text" class="form-control row_back1" id="idioma"
                                        name="correo_contacto">
                                    <hr style="visibility: hidden;" />
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3" style="background-color:#f8faca;">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <label for="cristaleria" class="col-form-label">Cristaleria</label>
                                            <input type="text" class="form-control row_back1" id="cristaleria"
                                                placeholder="Introduzca los detalles de la cristaleria">
                                            <div class="requerido" id="err_cliente"></div>

                                            <label for="anticipo" class="col-form-label">Anticipo</label>
                                            <div class="input-group">
                                                <div class="input-group-text" id="btnGroupAddon0">$</div>
                                                <input type="text" class="form-control row_back1" id="anticipo"
                                                    placeholder="Introduzca el monto del anticipo">
                                            </div>

                                            <label for="valor_menu" class="col-form-label">Valor Menú</label>
                                            <div class="input-group">
                                                <div class="input-group-text" id="btnGroupAddon1">$</div>
                                                <input type="text" class="form-control row_back1" id="valor_menu"
                                                    placeholder="Introduzca el valor del menú">
                                            </div>

                                            <label for="total_s_propina" class="col-form-label">Total sin
                                                Propina</label>
                                            <div class="input-group">
                                                <div class="input-group-text" id="btnGroupAddon2">$</div>
                                                <input type="text" class="form-control" id="total_s_propina"
                                                    placeholder="Introduzca el total sin propina">
                                            </div>
                                            <div class="requerido" id="err_total_s_propina"></div>

                                            <label for="total_c_propina" class="col-form-label">Total con
                                                Propina</label>
                                            <div class="input-group">
                                                <div class="input-group-text" id="btnGroupAddon3">$</div>
                                                <input type="text" class="form-control" id="total_c_propina"
                                                    placeholder="Introduzca el total con propina">
                                            </div>
                                            <div class="requerido" id="err_total_s_propina"></div>
                                            <input type="text" style="display:none;">
                                            <hr style="visibility: hidden;" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2" style="background-color:#a9c9fc;">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <label for="pago_local" class="col-form-label">Pago en Local</label>
                                            <select id="pago_local" name="pago_local" class="form-control">
                                                <option value="" disabled selected>Seleccione</option>
                                                <option value="1">SI</option>
                                                <option value="2">NO</option>
                                            </select>
                                            <div class="requerido" id="err_pago_local"></div>
                                            <label for="audio" class="col-form-label">Audio</label>
                                            <select id="audio" name="audio"
                                                class="form-control text text-sm crear">
                                                <option value="" disabled selected>Seleccione</option>
                                                <option value="1">SI</option>
                                                <option value="2">NO</option>
                                            </select>
                                            <div class="requerido" id="err_audio"></div>
                                            <label for="video" class="col-form-label">Video</label>
                                            <select id="video" name="video"
                                                class="form-control text text-sm crear">
                                                <option value="" disabled selected>Seleccione</option>
                                                <option value="1">SI</option>
                                                <option value="2">NO</option>
                                            </select>
                                            <div class="requerido" id="err_video"></div>
                                            <label for="video_audio" class="col-form-label">Video con Audio</label>
                                            <select id="video_audio" name="video_audio" class="form-control">
                                                <option value="" disabled selected>Seleccione</option>
                                                <option value="1">SI</option>
                                                <option value="2">NO</option>
                                            </select>
                                            <div class="requerido" id="err_video_audio"></div>
                                            <label for="adicional" class="col-form-label">Adicional</label>
                                            <select id="adicional" name="adicional" class="form-control">
                                                <option value="" disabled selected>Seleccione</option>
                                                <option value="1">SI</option>
                                                <option value="2">NO</option>
                                            </select>
                                            <div class="requerido" id="err_adicional"></div>
                                            <label for="extra" class="col-form-label">Extra</label>
                                            <select id="extra" name="extra" class="form-control">
                                                <option value="" disabled selected>Seleccione</option>
                                                <option value="1">SI</option>
                                                <option value="2">NO</option>
                                            </select>
                                            <div class="requerido" id="err_extra"></div>
                                            <hr style="visibility: hidden;" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2" style="background-color:#fae5ca;;">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div id="dvextras" style="display:none;">
                                                <label for="autoriza" class="col-form-label">Autorizado por</label>
                                                <input type="text" class="form-control row_back1" id="autoriza"
                                                    placeholder="Nombre del usuario que autoriza">

                                                <label for="telefono_autoriza" class="col-form-label">Teléfono
                                                    Autoriza<span class="requerido">*</span></label>
                                                <input type="text" class="form-control row_back1 req"
                                                    id="telefono_autoriza"
                                                    placeholder="N° de teléfono de quién autoriza">
                                                <div class="requerido" id="err_telefono_autoriza"></div>

                                                <label for="monto_autorizado" class="col-form-label">Monto Máximo<span
                                                        class="requerido">*</label>
                                                <div class="input-group">
                                                    <div class="input-group-text" id="btnGroupAddon1">$</div>
                                                    <input type="number" class="form-control row_back1 req"
                                                        id="monto_autorizado" placeholder="Monto máximo autorizado">
                                                </div>
                                                <div class="requerido" id="err_monto_autorizado"></div>
                                            </div>

                                            <label for="menu_impreso" class="col-form-label">Menú Impreso</label>
                                            <select id="menu_impreso" name="menu_impreso" class="form-control">
                                                <option value="" disabled selected>Seleccione</option>
                                                <option value="1">SI</option>
                                                <option value="2">NO</option>
                                            </select>
                                            <div class="requerido" id="err_menu_impreso"></div>
                                            <label for="table_tent" class="col-form-label">Table Tent</label>
                                            <select id="table_tent" name="table_tent"
                                                class="form-control text text-sm crear">
                                                <option value="" disabled selected>Seleccione</option>
                                                <option value="1">SI</option>
                                                <option value="2">NO</option>
                                            </select>
                                            <div class="requerido" id="err_salon"></div>
                                            <label for="restriccion" class="col-form-label">Restricción
                                                Alimenticia</label>
                                            <select id="restriccion" name="restriccion"
                                                class="form-control text text-sm crear">
                                                <option value="" disabled selected>Seleccione</option>
                                                <option value="1">SI</option>
                                                <option value="2">NO</option>
                                            </select>
                                            <div class="requerido" id="err_restriccion"></div>
                                            <label for="detalle_restriccion" class="col-form-label">Detalle
                                                Restricción</label>
                                            <textarea id="detalle_restriccion" rows="7" name="detalle_restriccion" class="form-control text text-sm crear"
                                                disabled></textarea>
                                            <hr style="visibility: hidden;" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3" style="background-color:#e4ccfc">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <label for="decoracion" class="col-form-label">Decoración</label>
                                            <textarea id="decoracion" name="decoracion" class="form-control text text-sm crear"></textarea>
                                            <label for="ubicacion" class="col-form-label">Ubicación</label>
                                            <textarea id="ubicacion" name="ubicacion" class="form-control text text-sm crear"></textarea>
                                            <label for="monta" class="col-form-label">Monta</label>
                                            <textarea id="monta" name="monta" class="form-control text text-sm crear"></textarea>
                                            <label for="comentarios" class="col-form-label">Comentarios
                                                eventos</label>
                                            <textarea id="comentarios" name="comentarios" class="form-control text text-sm crear"></textarea>
                                            <hr style="visibility: hidden;" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="reservas" role="tabpanel">
                        <p class="mb-0">
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 offset-md-2 text-center">
                        <label for="clave">Introduzca su clave<span class="requerido">*</span></label>
                        <input id="clave" name="clave" type="password" class="form-control req"
                            placeholder="Introduzca su clave de usuario" tabindex="14">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 text-center">
                        <label for="btn_reerva" style="visibility:hidden;">Presione el boton</label>
                        <button id="btn_reerva" type="button" class="form-control btn btn-primary"
                            title="Presione para crear la reserva"> Crear
                            reserva</button>
                    </div>
                </div>
                {{--  --}}
            </div>
        </div>
        {{-- ********************************** --}}
        <!-- Modal mdl-historial-->
        <div class="modal fade" id="mdl-historial" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title-res_cliente"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive mt-4">
                            <table id="cli_reservas_tbl" class="table table-stripped" data-toggle="table"
                                data-id-field="id" data-unique-id="id" data-search="true" data-search-align="left"
                                data-height="360" data-pagination="true" data-page-list="[10, 25, 50, 100, all]"
                                data-locale="es-CL">
                                <thead>
                                    <tr>
                                        <th data-field="fecha_reserva" data-sortable="true"
                                            data-formatter="fechaFormatter">Fecha</th>
                                        <th data-field="testado" data-sortable="true">Estado</th>
                                        <th data-field="razon" data-sortable="true">Motivo<br />Cancelación</th>
                                        <th data-field="observacion_cancelacion" data-sortable="true">
                                            Observación<br />Cancelación</th>
                                        <th data-field="cantidad_pasajeros" data-sortable="true">PAX</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        {{-- <button type="button" class="btn btn-primary">Comprendido</button> --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- ********************************** --}}
        <!-- Modal mdl-cliente-->
        <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
            data-bs-backdrop="static" id="mdl-cliente">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-titlec">Editar Cliente ID: <span id="id_cli"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <p class="card-title-desc">Datos del cliente</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <a class="nav-link mb-2 active" id="v-pills-personal-tab"
                                            data-bs-toggle="pill" href="#v-pills-personal" role="tab"
                                            aria-controls="v-pills-personal" aria-selected="true">Datos personales</a>
                                        <a class="nav-link mb-2" id="v-pills-general-tab" data-bs-toggle="pill"
                                            href="#v-pills-general" role="tab" aria-controls="v-pills-general"
                                            aria-selected="false">Datos Generales</a>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-12 col-md-9">
                                    <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-personal" role="tabpanel"
                                            aria-labelledby="v-pills-personal-tab">
                                            <div class="row align-items-start">
                                                <div class="col-sm-12 col-xs-12 col-md-3">
                                                    <div>
                                                        <label for="crut">RUT</label><br />
                                                        <input type="text" class="form-control form-control-lg"
                                                            id="crut" name="crut"
                                                            placeholder="Introduzca el RUT del cliente">
                                                        <div class="resaltado1" id="error_formato_rut"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-xs-12 col-md-5">
                                                    <div>
                                                        <label for="cnombre">NOMBRE<span
                                                                class="requerido">*</span></label><br />
                                                        <input type="text" class="form-control form-control-lg"
                                                            id="cnombre" name="cnombre"
                                                            placeholder="Introduzca el nombre del cliente" required>
                                                        <div class="requerido" id="err_fecha_reserva"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-xs-12 col-md-4">
                                                    <div>
                                                        <label for="cfecha_nacimiento">FECHA NACIMIENTO</label><br />
                                                        <input type="date" class="form-control form-control-lg"
                                                            id="cfecha_nacimiento" name="cfecha_nacimiento"
                                                            placeholder="Introduzca el RUT del cliente">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row align-items-start">
                                                <div class="col-sm-12 col-xs-12 col-md-3">
                                                    <div>
                                                        <label for="ctelefono">TELÉFONO<span
                                                                class="requerido">*</span></label><br />
                                                        <input type="text" class="form-control form-control-lg"
                                                            id="ctelefono" name="ctelefono"
                                                            placeholder="Introduzca el teléfono del cliente"
                                                            pattern="^\+[0-9]{11}$" required>
                                                        <div class="requerido" id="error_ctelefono"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-xs-12 col-md-4">
                                                    <div>
                                                        <label for="cemail">CORREO</label><br />
                                                        <input type="email" class="form-control form-control-lg"
                                                            id="cemail" name="cemail"
                                                            placeholder="Introduzca el correo del cliente del cliente"
                                                            required>
                                                        <div class="resaltado1" id="error_correo"></div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-xs-12 col-md-5">
                                                    <div>
                                                        <label for="ccomuna">COMUNA</label><br />
                                                        <select class="form-select" id="ccomuna">
                                                        </select>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row align-items-start">
                                                <div class="col-sm-12 col-xs-12 col-md-6">
                                                    <div>
                                                        <label for="cdireccion">DIRECCIÓN</label><br />
                                                        <textarea id="cdireccion" class="form-control form-control-lg"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-xs-12 col-md-3">
                                                    <div>
                                                        <label for="ccategoria">CATEGORÍA</label><br />
                                                        <select class="form-select" id="ccategoria">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-xs-12 col-md-3">
                                                    <div>
                                                        <label for="ctipo">TIPO</label><br />
                                                        <select class="form-select" id="ctipo">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-general" role="tabpanel"
                                            aria-labelledby="v-pills-general-tab">

                                            <div class="row align-items-start">
                                                <div class="col-sm-12 col-xs-12 col-md-4">
                                                    <div>
                                                        <label for="cempresa">EMPRESA</label><br />
                                                        <input type="text" class="form-control form-control-lg"
                                                            id="cempresa" name="cempresa"
                                                            placeholder="Introduzca el nombre de la empresa">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-xs-12 col-md-4">
                                                    <div>
                                                        <label for="chotel">HOTEL</label><br />
                                                        <input type="text" class="form-control form-control-lg"
                                                            id="chotel" name="chotel"
                                                            placeholder="Introduzca el nombre del hotel">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-xs-12 col-md-4">
                                                    <div class="col-sm-12 col-xs-12 col-md-12">
                                                        <div>
                                                            <label for="creferencia">REFERENCIA</label><br />
                                                            <textarea id="creferencia" class="form-control form-control-lg" placeholder="Referencia"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row align-items-start">
                                                <div class="col-sm-12 col-xs-12 col-md-4">
                                                    <div>
                                                        <label for="cvino1">VINO FAVORITO 1</label><br />
                                                        <input type="text" class="form-control form-control-lg"
                                                            id="cvino1" name="cvino1"
                                                            placeholder="Introduzca el vino favorito del cliente (1) del cliente">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-xs-12 col-md-4">
                                                    <div>
                                                        <label for="cvino2">VINO FAVORITO 2</label><br />
                                                        <input type="text" class="form-control form-control-lg"
                                                            id="cvino2" name="cvino2"
                                                            placeholder="Introduzca el vino favorito del cliente (1) del cliente">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-xs-12 col-md-4">
                                                    <div>
                                                        <label for="cvino3">VINO FAVORITO 3</label><br />
                                                        <input type="text" class="form-control form-control-lg"
                                                            id="cvino3" name="cvino3"
                                                            placeholder="Introduzca el vino favorito del cliente (3) del cliente">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row align-items-start">
                                                {{-- <div class="col-sm-12 col-xs-12 col-md-12">
                                                    <div>
                                                        <label for="nombre">REFERENCIA</label><br />
                                                        <textarea id="referencia" class="form-control form-control-lg" placeholder="Referencia"></textarea>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-guardarc"
                            title="Cerrar la ventana y guardar cambios">Guardar</button>
                        <button type="button" class="btn btn-secondary" id="btn-cerrarc" data-bs-dismiss="modal"
                            aria-label="Close" title="Cerrar la ventana y descartar los cambios">Cerrar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        {{-- ********************************** --}}
    </div>
    </div>
    <div class="loader">
        <img src="{{ asset('assets/images/loader4.gif') }}" alt="loader"
            style="width: auto;margin-top: calc(50vh - 30px);">
    </div>

    @include('layouts.vendor-scripts2')    

</body>

</html>
