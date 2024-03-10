@extends('layouts.master')
@section('title')
Gestión de Giftcards masivamente
@endsection
@section('css')
@endsection
@section('content')
@section('pagetitle')
Giftcards
@endsection
<meta name="_token" content="{{ csrf_token() }}">
<div class="uper">
    <div class="uper d-sm-none">
        <div class="card card-header">
            Gestión de Giftcards Masivamente
        </div>
    </div>
    {{-- ************************************************************** --}}

    <div class="card my-4">
        <div class="card-header">
            <h5>
                Creación de gifcard masivamente
            </h5>
        </div>
        <form method="POST"  action="" id="formMasivoGift">
            <div class="card-body">

                <div class="text-muted">

                    <div class="row mt-7">

                        <div class="col-xs-12 col-sm-12 col-md-3 form-group">
                            <input type="hidden" id="session_id_masivo" name="session_id_masivo" >
                            <label for="ccredito" class="label-control">Crédito<span class="requerido">*</span></label>
                            <select id="ccredito" class="form-control req"></select>
                            <div id='err_ccredito' class="requerido"></div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 form-group">
                            <label for="cestado_pago" class="label-control">Estado Pago<span
                                    class="requerido">*</span></label>
                            <select id="cestado_pago" class="form-control req"></select>
                            <div id='err_cestado_pago' class="requerido"></div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 form-group">
                            <label for="cforma_pago" class="label-control">Forma Pago<span
                                    class="requerido">*</span></label>
                            <select id="cforma_pago" class="form-control req"></select>
                            <div id='err_cforma_pago' class="requerido"></div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 form-group">
                            <label for="cvendido_por" class="label-control">Vendido Por:</label>
                            <input type="text" class="form-control" name="cvendido_por" id="cvendido_por">
                        </div>
                    </div>
                    <hr class="espacio-h" />
                    <div class="row mt-7">
                        <div class="col-xs-12 col-sm-12 col-md-3 form-group">
                            <label for="cfecha_vencimiento" class="label-control">Fecha <br />Vencimiento<span
                                    class="requerido">*</span></label>
                            <select id="cfecha_vencimiento" class="form-control req" name="cfecha_vencimiento">
                                <option value="">Seleccione</option>
                                <option value="30">30 días</option>
                                <option value="60">60 días</option>
                                <option value="90">90 días</option>
                                <option value="6">6 Meses</option>
                                <option value="1">1 Año</option>
                            </select>
                            <div id='err_cfecha_vencimiento' class="requerido"></div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-8 form-group" id="dias">
                            <div class="row text-center">
                                <label for="dias-de-uso">Días de uso</label>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="lunes" checked>
                                        <label class="form-check-label" for="lunes">
                                            Lunes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="martes" checked>
                                        <label class="form-check-label" for="martes">
                                            Martes
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="miercoles" checked>
                                        <label class="form-check-label" for="miercoles">
                                            Miércoles
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="jueves"  checked>
                                        <label class="form-check-label" for="jueves">
                                            Jueves
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="viernes" checked>
                                        <label class="form-check-label" for="viernes">
                                            Viernes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="sabado" checked>
                                        <label class="form-check-label" for="sabado">
                                            Sábado
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="domingo" checked>
                                        <label class="form-check-label" for="domingo">
                                            Domingo
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="requerido" id="err_dias"></div>
                            </div>
                        </div>
                    </div>
                    <hr class="espacio-h" />
                    <div class="row mt-7">
                        <div class="col-xs-12 col-sm-12 col-md-4 form-group">
                            <label for="horario_desde" class="label-control">Horario Desde<span
                                    class="requerido">*</span><br />&nbsp;</label>
                            <input type="time" id="horario_desde" class="form-control req" value="00:00">
                            <div id='err_horario_desde' class='requerido'></div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 form-group">
                            <label for="horario_hasta" class="label-control">Horario Hasta<span
                                    class="requerido">*</span><br />&nbsp;</label>
                            <input type="time" id="horario_hasta" class="form-control req" value="23:59">
                            <div id='err_horario_hasta' class='requerido'></div>
                        </div>
                    </div>
                    <hr class="espacio-h" />
                    <div class="row mt-7">
                        <div class="col-xs-12 col-sm-12 col-md-3 form-group">
                            <label for="ctipo_beneficio" class="label-control">Tipo Beneficio: <span
                                    class="requerido">*</span></label>
                            <select id="ctipo_beneficio" class="form-control req">
                                <option value="" disabled selected>Seleccione</option>
                                {{-- <option value=1>% DESCUENTO</option> --}}
                                {{-- <option value=2>MONTO DESCUENTO</option>
                            <option value=3>PLATO GRATIS</option> --}}
                                <option value="MONTO">MONTO</option>
                                <option value="PLATO GRATIS">PLATO GRATIS</option>
                                <option value="MENÚ">MENÚ</option>
                            </select>
                            <div id='err_ctipo_beneficio' class='requerido'></div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 form-group">
                            <label for="cbeneficio" class="label-control">
                                Beneficio:<span class="requerido">*</span>
                            </label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon4">$</span>
                                <input type="text" id="cbeneficio" class="form-control req">
                            </div>
                            <div id='err_cbeneficio' class='requerido'></div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 form-group">
                            <label for="cplatos_excluidos" class="label-control">Platos excluidos</label>
                            <input type="text" id="cplatos_excluidos" class="form-control">
                            <div id='err_cplatos_excluidos' class='requerido'></div>
                        </div>
                    </div>
                    <div class="row my-3 d-none adjunto-menu">
                        <div class="col-6">
                            <label for="cbeneficiario" class="label-control">Subir menú: <span
                                    class="requerido">*</span></label>
                            <input type="file" class="form-control req" name="cadjunto_menu" id="cadjunto_menu"
                                accept=".pdf,.png,.jpg,.jpeg">
                            <div id='err_cadjunto_menu' class='requerido'></div>
                        </div>
                    </div>
                </div>

                <div class="text-muted">
                    <hr class="espacio-h" />
                    <div class="row mt-7">
                        <div class="col-xs-12 col-sm-12 col-md-4 form-group">
                            <label for="cnombre_comprador" class="label-control">Nombre del comprador</label><br />
                            <input type="text" id="cnombre_comprador" class="form-control">
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-4 form-group">
                            <label for="cemail_comprador" class="label-control">Email del comprador <span
                                class="requerido">*</span>
                            </label><br />
                            <input type="email" id="cemail_comprador" class="form-control req">
                            <div id='err_cemail_comprador' class='requerido'></div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-4 form-group">
                            <label for="ctelefono_comprador" class="label-control">Teléfono del comprador</label><br />
                            <input type="text" id="ctelefono_comprador" class="form-control">
                        </div>

                    </div>
                </div>
                <div class="text-muted">

                    <hr class="espacio-h" />
                    <div class="row mt-7">
                        <div class="col-xs-12 col-sm-12 col-md-2 form-group">
                            <label for="cfactura" class="label-control">Factura</label><br />
                            <input class="form-check-input req" type="checkbox" value="" id="cfactura">
                        </div>
                        {{-- <div class="col-xs-12 col-sm-12 col-md-4 form-group">
                            <label for="cnum_factura" class="label-control"><span id='nfac'>N° Boleta</span><span
                                    class="requerido factura">*</span></label>
                            <input type="text" id="cnum_factura" class="form-control req">
                            <div id='err_cnum_factura' class='requerido'></div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 form-group">
                            <label for="cfecha_factura" class="label-control"><span id='ffac'>Fecha Boleta</span><span
                                    class="requerido factura">*</span></label>
                            <input type="date" id="cfecha_factura" class="form-control req">
                            <div id='err_cfecha_factura' class='requerido'></div>
                        </div> --}}
                        <div class="col-xs-12 col-sm-12 col-md-3 form-group">
                            <label for="cmonto_factura" class="label-control">
                                <span id='mfac'>Monto Boleta</span><span
                                    class="requerido factura">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon5">$</span>                                
                                <input type="text" id="cmonto_factura" class="form-control req">
                            </div>
                            <div id='err_cmonto_factura' class='requerido'></div>
                        </div>
                    </div>
                    <hr class="espacio-h" />
                    <div class="row mt-7 " id="datos_fact">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 my-1">
                            <label for="crazon_social" class="label-control">Razón Social<span
                                    class="requerido factura">*</span></label>
                            <input type="text" id="crazon_social" class="form-control req">
                            <div id='err_crazon_social' class='requerido'></div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 my-1">
                            <label for="crut" class="label-control">RUT<span class="requerido factura">*</span></label>
                            <input type="text" id="crut" class="form-control req" maxlength="10">
                            <div id='err_crut' class='requerido'></div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 my-1">
                            <label for="cgiro" class="label-control">Giro<span class="requerido factura">*</span></label>
                            <input type="text" id="cgiro" class="form-control req">
                            <div id='err_cgiro' class='requerido'></div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 my-1">
                            <label for="cemail_dte" class="label-control">Email DTE<span class="requerido factura">*</span></label>
                            <input type="text" id="cemail_dte" class="form-control req">
                            <div id='err_cemail_dte' class='requerido'></div>
                            
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 my-1">
                            <label for="cdireccion" class="label-control">Dirección<span
                                    class="requerido factura">*</span></label>
                            <textarea id="cdireccion" class="form-control req"></textarea>
                            <div id='err_cdireccion' class='requerido'></div>
                        </div>
                    </div>
                </div>

                <div class="secc-benefiarios">
                    <hr>
                    <div class="row">
                        <div class="col-12 mb-2">
                            <h5>Beneficiarios </h5>
                        </div>
                        <div class="col-xs-10 col-sm-6 col-md-3">
                            <div class="d-grid gap-2">
                                <button type="button" id="agregarFila" class="btn btn-primary agregar-fila">Agregar beneficiario</button>
                            </div>
                        </div>

                        <div class="data-beneficiarios my-3">
                            <div class="table-responsive">
                                <table class="table" id="tablaBeneficiarios">
                                    <thead>
                                        <tr>
                                            <th>Nombre <span class="requerido">*</span></th>
                                            <th>Correo</th>
                                            <th>Teléfono</th>
                                            <th>Mensaje</th>
                                            <th>Notificar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="tr">
                                            <td data-label="Nombre"> 
                                                <input type="text" class="form-control nombre_bene req-2"  name="nombre_bene[]" >
                                                <div class='err_nombre_beneficiario requerido mostrar'></div>
                                            </td>
                                            <td data-label="Correo">
                                                <input type="text"  class="form-control email_bene " name="email_bene[]">
                                                <div class='err_email_beneficiario requerido'></div>
                                            </td>
                                            <td data-label="Teléfono">
                                                <input type="text"  class="form-control telefono_bene" name="telefono_bene[]">
                                            </td>
                                            <td data-label="Mensaje">
                                                <input type="text"  class="form-control mensaje_bene" name="mensaje_bene[]">
                                            </td>
                                            <td data-label="Notificar">
                                                <div class="seccion-notifica-button">
                                                    <div class="form-check">
                                                        <input class="form-check-input notifica_ben" type="checkbox" value="" name="notificar[]" >
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-label="Eliminar">
                                                <div class="seccion-delete-button">
                                                    <button type="button" class="btn btn-sm btn-danger delete-button" title="Eliminar">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            {{-- <div class="row" id="ben_0">

                                <div class="col-xs-12 col-sm-12 col-md-4 form-group">
                                    <label for="cbeneficiario_0" class="label-control">Nombre </label>
                                    <input type="text" id="cbeneficiario_0" name="nomb_bene[]" class="form-control">
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-3 form-group">
                                    <label for="ccorreo_0" class="label-control">Correo</label>
                                    <input type="text" id="ccorreo_0" class="form-control" name="email_bene[]">
                                    <div id='err_ccorreo_0' class='requerido'></div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-3 form-group">
                                    <label for="ctelefono" class="label-control">Teléfono</label>
                                    <input type="text" id="ctelefono_0" class="form-control" name="telefono_bene[]">
                                    <div id='err_ctelefono_0' class='requerido'></div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-2 form-group">
                                    <label class="form-check-label" for="">
                                        Notificar
                                    </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="" checked>
                                    </div>
                                </div> --}}
                            <div class="d-flex justify-content-center">
                                <div id='err_beneficiario_masivo' class='requerido'> </div>
                            </div>

                        </div>


                    </div>

                </div>

            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="button" class="btn btn-primary" id="btn-guardar-masivo" title="Guardar cambios">Guardar</button>

            </div>
        </form>



    </div>
</div>

</div>

@endsection
<script>
    var token = '{{ csrf_token() }}';
</script>
@section('script')
<script>
    var base = "";
	var giftcard_ver = $('.can-ver-gitfcard').length > 0  ? true : false;
	var giftcard_crear = $('.can-crear-gitfcard').length > 0 ? true : false;
	var giftcard_anular = $('.can-anular-gitfcard').length > 0 == 1 ? true : false;
	var base = "{{ url('/') }}";
</script>
<script src="{{ URL::asset('/assets/js/app/comunes/funciones.js') }}"></script>

<script src="{{ URL::asset('/assets/js/app/comunes/giftcard_config.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app/giftcards/listado.js') }}"></script>
@endsection
