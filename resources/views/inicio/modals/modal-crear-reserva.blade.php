<!-- Modal -->
<div class="modal fade" id="mdl-crear-vreserva" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Crear un nueva reserva</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#ngeneral" role="tab"
                            title="Datos Generales">
                            <span class="d-block d-sm-none"><i class="fas fa-book-open"></i></span>
                            <span class="d-none d-sm-block">Datos Generales</span>
                        </a>
                    </li>
                    <li class="nav-item" style="visibility:hidden;" id="npanel_eventos">
                        <a class="nav-link" data-bs-toggle="tab" href="#neventos" role="tab" title="Eventos">
                            <span class="d-block d-sm-none"><i class="fas fa-birthday-cake"></i></span>
                            <span class="d-none d-sm-block">Ficha Eventos</span>
                        </a>
                    </li>
                    <li class="nav-item" style="visibility:hidden;" id="npanel_reservas">
                        <a class="nav-link" data-bs-toggle="tab" href="#reservas" role="tab" title="Reserva">
                            <span class="d-block d-sm-none"><i class="fas fa-birthday-cake"></i></span>
                            <span class="d-none d-sm-block">Reserva</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active" id="ngeneral" role="tabpanel">
                        <form id="frm-ngeneral" enctype="multipart/form-data">
                            <div class="row" style="background-color:#cafad7;">
                                <div class="col-xs-12 col-sm-12 col-md-3 mb-3">
                                    <label for="nfecha_reserva" class="col-form-label">Fecha<span
                                            class="requerido">*</span></label>
                                    <input type="date" class="form-control req row_back1" id="nfecha_reserva"
                                        name="nfecha_reserva" tabindex="1">
                                    <div class="requerido" id="err_nfecha_reserva"></div>
                                    <label for="nhora_reserva" class="col-form-label">Hora<span
                                            class="requerido">*</span></label>
                                    <input type="time" class="form-control req row_back1" id="nhora_reserva"
                                        name="nhora_reserva" tabindex="2">
                                    <div class="requerido" id="err_nhora_reserva"></div>
                                    <label for="npasajeros" class="col-form-label">N° Pasajeros<span class="requerido">*</span></label>
                                    <input type="text" class="form-control req row_back1" id="npasajeros" name="npasajeros" tabindex="3">
                                    <div class="requerido" id="err_npasajeros"></div>
                                    <label for="ntipo">Tipo<span class="requerido">*</span></label><br />
                                    <select class="form-select req row_back1" id="ntipo" tabindex="4"></select>
                                    <div class="requerido" id="err_ntipo"></div>
                                    <hr style="visibility: hidden;" />
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3" style="background-color:#f8faca;">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <label for="ncliente" class="col-form-label">Cliente<span class="requerido">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control req row_back1" list="listaClientes" id="ncliente" placeholder="Escriba para buscar..." tabindex="5">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-eye hist_cli" data-bs-target="#mdl-historial" data-bs-toggle="modal" style="cursor:pointer;display:none;" title="Historial de reservas del cliente" id="cons_res"> </i>
                                                         &nbsp;&nbsp;
                                                        <span id="noshow_cliente" class="hist_cli" title="Cantidad de No Show del cliente en los últimos 6 meses"></span>
                                                        &nbsp;&nbsp; <i class="fas fa-user-edit hist_cli" data-bs-target="#mdl-cliente" data-bs-toggle="modal" style="cursor:pointer;display:none;" title="Editar cliente" id="cons_cli"></i>
                                                        {{-- &nbsp;&nbsp;<label title="No Show de los ultimos 6 meses">6</label> --}}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="requerido" id="err_ncliente"></div>
                                            <datalist id="listaClientes">
                                            </datalist>
                                            <label for="nempresa" class="col-form-label">Empresa</label>
                                            <input type="text" class="form-control row_back1" list="listaEmpresas"
                                                id="nempresa" placeholder="Escriba para buscar..." tabindex="6">
                                            <datalist id="listaEmpresas">
                                            </datalist>
                                            <label for="nhotel" class="col-form-label">Hotel</label>
                                            <input type="text" class="form-control row_back1" list="listaHoteles" id="nhotel" placeholder="Escriba para buscar..." tabindex="7">
                                            <datalist id="listaHoteles">
                                            </datalist>
                                            <label for="ntelefono" class="col-form-label">Teléfono<span class="requerido">*</span></label>
                                            <input type="text" class="form-control req row_back1" list="listaTelefonos" id="ntelefono" placeholder="Escriba para buscar..." tabindex="8">
                                            <div class="requerido" id="err_ntelefono"></div>
                                            <datalist id="listaTelefonos">
                                            </datalist>
                                            <label for="ncorreo" class="col-form-label">Correo</label>
                                            <input type="text" class="form-control row_back1" list="listaCorreos"
                                                id="ncorreo" placeholder="Escriba para buscar..." tabindex="9">
                                            <span class="requerido" id="err_ncorreo"></span>
                                            <datalist id="listaCorreos">
                                            </datalist>
                                            <input type="text" class="form-control row_back1" id="ncorreo1"
                                                placeholder="Escriba para buscar..." style="display:none;">
                                            <hr style="visibility: hidden;" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3" style="background-color:#a9c9fc;">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <label for="nsucursal" class="col-form-label">Sucursal<span
                                                    class="requerido">*</span></label>
                                            <select id="nsucursal" name="nsucursal" class="form-control req"
                                                tabindex="10"></select>
                                            <div class="requerido" id="err_nsucursal"></div>
                                            <label for="nsalon" class="col-form-label">Salón</label>
                                            <select id="nsalon" name="nsalon"
                                                class="form-control text text-sm crear" tabindex="11"></select>
                                            <div class="requerido" id="err_nsalon"></div>
                                            <label for="nmesa" class="col-form-label">Mesa</label>
                                            <select id="nmesa" name="nmesa" class="form-control text text-sm crear" tabindex="12">
                                            </select>
                                            <div class="requerido" id="err_nmesa"></div>
                                            </datalist>
                                            <label for="nobservaciones" class="col-form-label">Observaciones</label>
                                            <textarea id="nobservaciones" name="observaciones" class="form-control text text-sm crear" tabindex="13"></textarea>
                                            <hr style="visibility: hidden;" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3" style="background-color:#fae5ca;;">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <label for="nmenu1" class="col-form-label">Menú 1</label>
                                            <div class="d-flex align-items-center">
                                                <input type="file" class="form-control" id="nmenu1"
                                                    name="nmenu1" accept=".pdf,.png,.jpg,.jpeg" />
                                                <button type="button" class="btn btn-danger clear_menu1 mx-2 btn-sm">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>

                                            <label for="nmenu2" class="col-form-label">Menú 2</label>
                                            <div class="d-flex align-items-center">
                                                <input type="file" class="form-control" id="nmenu2"
                                                    name="nmenu2" accept=".pdf,.png,.jpg,.jpeg">
                                                <button type="button" class="btn btn-danger clear_menu2 mx-2 btn-sm">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>

                                            <label for="nprecuenta" class="col-form-label">Precuenta</label>
                                            <div class="d-flex align-items-center">
                                                <input type="file" class="form-control" id="nprecuenta"
                                                    name="nprecuenta">
                                                <button type="button"
                                                    class="btn btn-danger clear_precuenta mx-2 btn-sm">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>

                                            <label for="nfactura" class="col-form-label">Factura</label>
                                            <div class="d-flex align-items-center">
                                                <input type="file" class="form-control" id="nfactura"
                                                    name="nfactura" accept=".pdf,.png,.jpg,.jpeg">
                                                <button type="button"
                                                    class="btn btn-danger clear_factura mx-2 btn-sm">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>

                                            <label for="nlogo" class="col-form-label">Logo</label>
                                            <div class="d-flex align-items-center">
                                                <input type="file" class="form-control" id="nlogo"
                                                    name="nlogo" accept=".pdf,.png,.jpg,.jpeg">
                                                <button type="button" class="btn btn-danger clear_logo mx-2 btn-sm">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>

                                            <label for="notro" class="col-form-label">Otro</label>
                                            <div class="d-flex align-items-center">
                                                <input type="file" class="form-control" id="notro"
                                                    name="notro" accept=".pdf,.png,.jpg,.jpeg">
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
                    <div class="tab-pane" id="neventos" role="tabpanel">
                        <form id="frm-nevento">
                            <div class="row" style="background-color:#cafad7;">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <label for="nnombre_adicional" class="col-form-label">Nombre adicional</label>
                                    <input type="text" class="form-control row_back1" id="nnombre_adicional"
                                        name="nnombre_adicional" placeholder="Introduzca nombre adicional">
                                    <div class="requerido" id="err_nnombre_adicional"></div>
                                    <label for="npax" class="col-form-label">Pax</label>
                                    <input type="text" class="form-control row_back1" id="npax" name="npax" placeholder="Introduzca Pax">
                                    <div class="requerido" id="err_npax"></div>
                                    <label for="nnombre_contacto" class="col-form-label">Nombre Contacto</label>
                                    <input type="text" class="form-control row_back1" id="nnombre_contacto" name="nnombre_contacto" placeholder="Introduzca nombre contacto">
                                    <div class="requerido" id="err_nnombre_contacto"></div>
                                    <label for="ntelefono_contacto">Teléfono contacto</label><br />
                                    <input type="text" class="form-control row_back1" id="ntelefono_contacto" name="ntelefono_contacto" placeholder="Introduzca telefono contacto">
                                    <div class="requerido" id="err_ntelefono_contacto"></div>
                                    <label for="ncorreo_contacto">Correo contacto</label><br />
                                    <input type="text" class="form-control row_back1" id="ncorreo_contacto"
                                        name="ncorreo_contacto" placeholder="Introduzca correo contacto">
                                    <div class="requerido" id="err_ncorreo_contacto"></div>
                                    <label for="nidioma">Idioma</label><br />
                                    <input type="text" class="form-control row_back1" id="nidioma"
                                        name="nidioma">
                                    <hr style="visibility: hidden;" />
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3" style="background-color:#f8faca;">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <label for="ncristaleria" class="col-form-label">Cristaleria</label>
                                            <input type="text" class="form-control row_back1" id="ncristaleria" placeholder="Introduzca los detalles de la cristaleria">                                           
                                            <label for="nanticipo" class="col-form-label">Anticipo</label>
                                            <div class="input-group">
                                                <div class="input-group-text" id="btnGroupAddon0">$</div>
                                                <input type="text" class="form-control row_back1" id="nanticipo"
                                                    placeholder="Introduzca el monto del anticipo">
                                            </div>

                                            <label for="nvalor_menu" class="col-form-label">Valor Menú</label>
                                            <div class="input-group">
                                                <div class="input-group-text" id="btnGroupAddon1">$</div>
                                                <input type="text" class="form-control row_back1" id="nvalor_menu"
                                                    placeholder="Introduzca el valor del menú">
                                            </div>

                                            <label for="ntotal_s_propina" class="col-form-label">Total sin
                                                Propina</label>
                                            <div class="input-group">
                                                <div class="input-group-text" id="btnGroupAddon2">$</div>
                                                <input type="text" class="form-control" id="ntotal_s_propina"
                                                    placeholder="Introduzca el total sin propina">
                                            </div>
                                            <div class="requerido" id="err_ntotal_s_propina"></div>

                                            <label for="ntotal_c_propina" class="col-form-label">Total con
                                                Propina</label>
                                            <div class="input-group">
                                                <div class="input-group-text" id="btnGroupAddon3">$</div>
                                                <input type="text" class="form-control" id="ntotal_c_propina"
                                                    placeholder="Introduzca el total con propina">
                                            </div>
                                            <div class="requerido" id="err_ntotal_s_propina"></div>
                                            <input type="text" style="display:none;">
                                            <hr style="visibility: hidden;" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2" style="background-color:#a9c9fc;">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <label for="npago_local" class="col-form-label">Pago en Local</label>
                                            <select id="npago_local" name="npago_local" class="form-control">
                                                <option value="" disabled selected>Seleccione</option>
                                                <option value="1">SI</option>
                                                <option value="2">NO</option>
                                            </select>
                                            <div class="requerido" id="err_npago_local"></div>
                                            <label for="naudio" class="col-form-label">Audio</label>
                                            <select id="naudio" name="naudio"
                                                class="form-control text text-sm crear">
                                                <option value="" disabled selected>Seleccione</option>
                                                <option value="1">SI</option>
                                                <option value="2">NO</option>
                                            </select>
                                            <div class="requerido" id="err_naudio"></div>
                                            <label for="nvideo" class="col-form-label">Video</label>
                                            <select id="nvideo" name="nvideo"
                                                class="form-control text text-sm crear">
                                                <option value="" disabled selected>Seleccione</option>
                                                <option value="1">SI</option>
                                                <option value="2">NO</option>
                                            </select>
                                            <div class="requerido" id="err_nvideo"></div>
                                            <label for="nvideo_audio" class="col-form-label">Video con Audio</label>
                                            <select id="nvideo_audio" name="nvideo_audio" class="form-control">
                                                <option value="" disabled selected>Seleccione</option>
                                                <option value="1">SI</option>
                                                <option value="2">NO</option>
                                            </select>
                                            <div class="requerido" id="err_nvideo_audio"></div>
                                            <label for="nadicional" class="col-form-label">Adicional</label>
                                            <select id="nadicional" name="nadicional" class="form-control">
                                                <option value="" disabled selected>Seleccione</option>
                                                <option value="1">SI</option>
                                                <option value="2">NO</option>
                                            </select>
                                            <div class="requerido" id="err_nadicional"></div>
                                            <label for="nextra" class="col-form-label">Extra</label>
                                            <select id="nextra" name="nextra" class="form-control">
                                                <option value="" disabled selected>Seleccione</option>
                                                <option value="1">SI</option>
                                                <option value="2">NO</option>
                                            </select>
                                            <div class="requerido" id="err_nextra"></div>
                                            <hr style="visibility: hidden;" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2" style="background-color:#fae5ca;;">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div id="ndvextras" style="display:none;">
                                                <label for="nautoriza" class="col-form-label">Autorizado por</label>
                                                <input type="text" class="form-control row_back1" id="nautoriza"
                                                    placeholder="Nombre del usuario que autoriza">
                                                <label for="ntelefono_autoriza" class="col-form-label">Teléfono
                                                    Autoriza<span class="requerido">*</span></label>
                                                <input type="text" class="form-control row_back1 req"
                                                    id="ntelefono_autoriza"
                                                    placeholder="N° de teléfono de quién autoriza">
                                                <div class="requerido" id="err_ntelefono_autoriza"></div>

                                                <label for="nmonto_autorizado" class="col-form-label">Monto Máximo<span
                                                        class="requerido">*</label>
                                                <div class="input-group">
                                                    <div class="input-group-text" id="btnGroupAddon1">$</div>
                                                    <input type="number" class="form-control row_back1 req"
                                                        id="nmonto_autorizado" placeholder="Monto máximo autorizado">
                                                </div>
                                                <div class="requerido" id="err_nmonto_autorizado"></div>
                                            </div>

                                            <label for="nmenu_impreso" class="col-form-label">Menú Impreso</label>
                                            <select id="nmenu_impreso" name="nmenu_impreso" class="form-control">
                                                <option value="" disabled selected>Seleccione</option>
                                                <option value="1">SI</option>
                                                <option value="2">NO</option>
                                            </select>
                                            <div class="requerido" id="err_nmenu_impreso"></div>
                                            <label for="ntable_tent" class="col-form-label">Table Tent</label>
                                            <select id="ntable_tent" name="ntable_tent"
                                                class="form-control text text-sm crear">
                                                <option value="" disabled selected>Seleccione</option>
                                                <option value="1">SI</option>
                                                <option value="2">NO</option>
                                            </select>
                                            <div class="requerido" id="err_ntable_tent"></div>
                                            <label for="nrestriccion" class="col-form-label">Restricción
                                                Alimenticia</label>
                                            <select id="nrestriccion" name="nrestriccion"
                                                class="form-control text text-sm crear">
                                                <option value="" disabled selected>Seleccione</option>
                                                <option value="1">SI</option>
                                                <option value="2">NO</option>
                                            </select>
                                            <div class="requerido" id="err_nrestriccion"></div>
                                            <label for="ndetalle_restriccion" class="col-form-label">Detalle
                                                Restricción</label>
                                            <textarea id="ndetalle_restriccion" rows="7" name="ndetalle_restriccion" class="form-control text text-sm crear" disabled></textarea>
                                            <hr style="visibility: hidden;" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3" style="background-color:#e4ccfc">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <label for="ndecoracion" class="col-form-label">Decoración</label>
                                            <textarea id="ndecoracion" name="ndecoracion" class="form-control text text-sm crear"></textarea>
                                            <label for="nubicacion" class="col-form-label">Ubicación</label>
                                            <textarea id="nubicacion" name="nubicacion" class="form-control text text-sm crear"></textarea>
                                            <label for="nmonta" class="col-form-label">Monta</label>
                                            <textarea id="nmonta" name="nmonta" class="form-control text text-sm crear"></textarea>
                                            <label for="ncomentarios" class="col-form-label">Comentarios
                                                eventos</label>
                                            <textarea id="ncomentarios" name="comentarios" class="form-control text text-sm crear"></textarea>
                                            <hr style="visibility: hidden;" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="nreservas" role="tabpanel">
                        <p class="mb-0">
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 offset-md-2 text-center">
                        <label for="nclave">Introduzca su clave<span class="requerido">*</span></label>
                        <input id="nclave" name="nclave" type="password" class="form-control req" placeholder="Introduzca su clave de usuario" tabindex="14">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 text-center">
                        <label for="btn_nreerva" style="visibility:hidden;">Presione el boton</label>
                        <button id="btn_nreerva" type="button" class="form-control btn btn-primary" title="Presione para crear la reserva">    
                            Crear reserva
                        </button>
                    </div>
                </div>
                {{--  --}}
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div> --}}
        </div>
    </div>
</div>
