@extends('layouts.master')
@section('title')
	Gestión de Giftcards
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
			Gestión de Giftcards
		</div>
	</div>
	{{-- ************************************************************** --}}

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-3 form-group">
			<div class="mb-3">
				<label for="sel_estado" class="form-label font-size-13 text-muted">Estado Giftcard </label>
				<select id="sel_estado" class="form-control">
				</select>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-3 form-group">
			<div class="mb-3">
				<label for="sel_pago" class="form-label font-size-13 text-muted">Estado Pago</label>
				<select id="sel_pago" class="form-control">
				</select>
			</div>
		</div>
	</div>

	{{-- ************************************************************** --}}
	<div class="table-responsive mt-4">
		<table id="giftcard_tbl" class="table" data-toggle="table" data-url="/giftcard/list" data-buttons="btnCrearGiftcard"
			data-id-field="id" data-unique-id="id" data-search="true" data-search-align="left" data-height="650"
			data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-pagination="true"
			data-page-list="[10, 25, 50, 100, all]" data-locale="es-CL" data-icons-prefix="fas" data-icons="icons">
			<thead>
				<tr>
					<th data-field="id" data-sortable="true">ID</th>
					<th data-field="codigo" data-sortable="true">Código</th>
					<th data-field="estado_pago" data-sortable="true">Estado<br />Pago</th>
					<th data-field="estado" data-sortable="true" data-formatter="estadoFormatter">Estado<br />Uso</th>
					<th data-field="credito" data-sortable="true">Crédito</th>
					<th data-field="fecha_creacion" data-sortable="true" data-formatter="fechaFormatter">Fecha<br />Creación</th>
					<th data-field="hora_creacion" data-sortable="true" data-formatter="horaFormatter">Hora<br />Creación</th>
					<th data-field="fecha_canje" data-sortable="true" data-formatter="fechaFormatter">Fecha<br />de Canje</th>
					<th data-field="fecha_anulacion" data-sortable="true" data-formatter="fechaFormatter">Fecha<br />de Anulación</th>
					<th data-field="fecha_vencimiento" data-sortable="true" data-formatter="fechaFormatter">Fecha<br />Vencimiento</th>
					<th data-field="beneficiario" data-sortable="true">Beneficiario</th>
					<th data-field="email" data-sortable="true">Correo</th>
					<th data-field="telefono" data-sortable="true">Teléfono</th>
					<th data-field="dias_uso" data-sortable="true" data-formatter="diasUsoFormatter">Días<br />Validez</th>
					<th data-field="horario_uso" data-sortable="true">Horario<br />Validez</th>

                    <th data-field="mesonero" data-sortable="true">Mesonero</th>
                    <th data-field="mesa" data-sortable="true">Mesa</th>
                    <th data-field="n_cuenta" data-sortable="true">Numero <br />de Cuenta</th>
                    <th data-field="adjunto" data-sortable="true" data-formatter="imageFormatter">Adjunto</th>

					<th data-field="forma_pago" data-sortable="true">Forma<br />Pago</th>
					<th data-field="factura" data-sortable="true">Factura</th>
					<th data-field="razon_social" data-sortable="true">Razón<br />Social</th>
					<th data-field="rut" data-sortable="true">RUT</th>
					<th data-field="giro" data-sortable="true">Giro</th>
					<th data-field="direccion" data-sortable="true">Dirección</th>
					<th data-field="actions" class="td-actions text-center" data-click-to-select="false"
						data-formatter="listarReservasFormatter">ACCIONES</th>
				</tr>
			</thead>
		</table>
	</div>

	<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
		data-bs-backdrop="static" id="mdl-giftcard-ver">
		<div class="modal-dialog modal-fullscreen">
			<div class="modal-content">
				<div class="modal-header mb-0 pb-0">
					<h4 class="modal-title w-100" id="myModalLabel">Giftcard ID: <span id="title_ver"></span></h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body mt-0 pt-0">
					<div class="card-body mt-0 pt-0">
						<div class="row">
							<div class="card">
								<div class="card-body">
									<div class="col-2">
										<img class="img-fluid" id='imagenQR'>
									</div>
								</div>
							</div>
						</div>
						<div class="text-muted">
							<div class="row mb-7">
								<div class="col-xs-12 col-sm-12 col-md-4 form-group mt-0">
									<label for="codigo" class="label-control">Código</label>
									<input type="text" id="codigo" class="form-control" disbaled>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-8 form-group">
									<label for="enlace" class="label-control">Enlace</label>
									<input type="text" id="enlace" class="form-control" disbaled>
								</div>
							</div>
							<hr class="espacio-h" />
							<div class="row mt-7 mb-7">
								<div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="estado" class="label-control">Estado</label>
									<input type="text" id="estado" class="form-control" disbaled>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="credito" class="label-control">Crédito</label>
									<input type="text" id="credito" class="form-control" disbaled>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="estado_pago" class="label-control">Estado Pago</label>
									<input type="text" id="estado_pago" class="form-control" disbaled>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="forma_pago" class="label-control">Forma Pago</label>
									<input type="text" id="forma_pago" class="form-control" disbaled>
								</div>

							</div>
							<hr class="espacio-h" />
							<div class="row mt-7">
								<div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="fecha_creacion" class="label-control">Fecha <br />Creación</label>
									<input type="text" id="fecha_creacion" class="form-control" disbaled>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="fecha_vencimiento" class="label-control">Fecha <br />Vencimiento</label>
									<input type="text" id="fecha_vencimiento" class="form-control" disbaled>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="dias_uso" class="label-control">Días Uso<br />&nbsp;</label>
									<input type="text" id="dias_uso" class="form-control" disbaled>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="horario_uso" class="label-control">Horario Uso<br />&nbsp;</label>
									<input type="text" id="horario_uso" class="form-control" disbaled>
								</div>
							</div>
							<hr class="espacio-h" />
							<div class="row mt-7">
								<div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="tipo_beneficio" class="label-control">Tipo Beneficio: </label>
									<input type="text" id="tipo_beneficio" class="form-control" disabled>
								</div>

                                <div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="beneficio" class="label-control">Beneficio: </label>
									<input type="text" id="beneficio" class="form-control" disabled>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-6 form-group">
									<label for="platos_excuidos" class="label-control">Platos excluidos</label>
									<input type="text" id="platos_excuidos" class="form-control" disbaled>
								</div>
							</div>

						</div>
                        <div class="text-muted">
                            <hr class="espacio-h" />
                            <div class="row mt-7">
                                <div class="col-xs-12 col-sm-12 col-md-4 form-group">
                                    <label for="nombre_comprador" class="label-control">Nombre del comprador</label><br />
                                    <input type="text" id="nombre_comprador" class="form-control">
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-4 form-group">
                                    <label for="email_comprador" class="label-control">Email del comprador</label><br />
                                    <input type="text" id="email_comprador" class="form-control">
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-4 form-group">
                                    <label for="telefono_comprador" class="label-control">Teléfono del comprador</label><br />
                                    <input type="text" id="telefono_comprador" class="form-control">
                                </div>

                            </div>
                        </div>
						<hr />
						<div class="text-muted">
							<div class="row mt-7">
								<div class="col-xs-12 col-sm-12 col-md-6 form-group">
									<label for="beneficiario" class="label-control">Beneficiario</label>
									<input type="text" id="beneficiario" class="form-control" disbaled>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="correo" class="label-control">Correo</label>
									<input type="text" id="correo" class="form-control" disbaled>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="telefono" class="label-control">Teléfono</label>
									<input type="text" id="telefono" class="form-control" disbaled>
								</div>
							</div>
							<hr class="espacio-h" />
							<div class="row mt-7">
								<div class="col-xs-12 col-sm-12 col-md-1 form-group">
									<label for="factura" class="label-control">Factura</label>
									<input type="text" id="factura" class="form-control" disbaled>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 form-group">
									<label for="num_factura" class="label-control"> <span id="ver_nfac">N° Factura</span></label>
									<input type="text" id="num_factura" class="form-control" disbaled>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="fecha_factura" class="label-control"> <span id="ver_ffac">Fecha Factura</span></label>
									<input type="text" id="fecha_factura" class="form-control" disbaled>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 form-group">
									<label for="monto_factura" class="label-control" ><span id="ver_mfac">Monto Factura</span></label>
									<input type="text" id="monto_factura" class="form-control" disbaled>
								</div>
							</div>
							<hr class="espacio-h" />
							<div class="row mt-7" id="ver_datos_fact">
								<div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="razon_social" class="label-control">Razón Social</label>
									<input type="text" id="razon_social" class="form-control" disbaled>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-2 form-group">
									<label for="rut" class="label-control">RUT</label>
									<input type="text" id="rut" class="form-control" disbaled>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-2 form-group">
									<label for="giro" class="label-control">Giro</label>
									<input type="text" id="giro" class="form-control" disbaled>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 form-group">
									<label for="direccion" class="label-control">Dirección</label>
									<textarea id="direccion" class="form-control" disbaled></textarea>
								</div>
							</div>
						</div>
						<hr />
						<div class="text-muted">
							<div class="row mt-7">
								<div class="col-xs-12 col-sm-12 col-md-4 form-group">
									<label for="creado_por" class="label-control">Creado por</label>
									<input type="text" id="creado_por" class="form-control" disbaled>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 form-group">
									<label for="vendido_por" class="label-control">Vendido por</label>
									<input type="text" id="vendido_por" class="form-control" disbaled>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 form-group">
									<label for="mesonero" class="label-control">Mesonero</label>
									<input type="text" id="mesonero" class="form-control" disbaled>
								</div>
							</div>
							<hr class="espacio-h" />
							<div class="row mt-7">
								<div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="anulado_por" class="label-control">Anulado por</label>
									<input type="text" id="anulado_por" class="form-control" disbaled>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="fecha_anulacion" class="label-control">Fecha anulación</label>
									<input type="text" id="fecha_anulacion" class="form-control" disbaled>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 form-group">
									<label for="motivo_anulacion" class="label-control">Motivo anulación</label>
									<input type="text" id="motivo_anulacion" class="form-control" disbaled>
								</div>
							</div>
						</div>
						<hr class="espacio-h" />
					</div>
				</div>
				<div class="modal-footer">
					{{-- <button type="button" class="btn btn-primary" id="btn-guardar" title="Cerrar la ventana y guardar cambios"
						disabled>Guardar</button> --}}
					<button type="button" class="btn btn-secondary" id="btn-cerrar" data-bs-dismiss="modal" aria-label="Close"
						title="Cerrar la ventana y descartar los cambios">Cerrar</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
		data-bs-backdrop="static" id="mdl-giftcard-crear">
		{{-- <div class="modal-dialog modal-dialog-centered modal-xl"> --}}
		<div class="modal-dialog modal-fullscreen">
			<div class="modal-content">
				<div class="modal-header mb-0 pb-0">

					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body mt-0 pt-0">
					<div class="card-body mt-0 pt-0">
						<div class="row">
							<div class="card">
								<div class="card-body">
									<div class="col-2">
										<img class="img-fluid" id='cimagenQR'>
									</div>
								</div>
							</div>
						</div>
						<div class="text-muted">
							 <div class="row mb-7">
                                <div class="col-md-2">
                                    <div class="d-grid gap-2 mt-4">
                                      {{-- <button type="button" name="" id="" class="btn btn-warning">Creación masiva</button> --}}
                                      <a href="{{ route('giftcard.creacion_masiva') }}" class="btn btn-warning">Creación masiva</a>
                                    </div>
                                </div>
								<div class="col-xs-12 col-sm-12 col-md-4 form-group mt-0">
									<label for="ccodigo" class="label-control">Código</label>
									<input type="text" id="ccodigo" class="form-control req" readonly>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 form-group">
									<label for="cenlace" class="label-control">Enlace</label>
									<input type="text" id="cenlace" class="form-control req" readonly>
								</div>
							</div>
							<hr class="espacio-h" />
							{{-- GIFTCARD --}}
							<div class="row mt-7">
								{{-- <div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="cestado" class="label-control">Estado<span class="requerido">*</span></label>
									<select id="cestado" class="form-control req"></select>
									<div id='err_cestado' class="requerido"></div>
								</div> --}}

								<input type="hidden" id="session_id" name="session_id" val="">
								

								<div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="ccredito" class="label-control">Crédito<span class="requerido">*</span></label>
									<select id="ccredito" class="form-control req"></select>
									<div id='err_ccredito' class="requerido"></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="cestado_pago" class="label-control">Estado Pago<span class="requerido">*</span></label>
									<select id="cestado_pago" class="form-control req"></select>
									<div id='err_cestado_pago' class="requerido"></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="cforma_pago" class="label-control">Forma Pago<span class="requerido">*</span></label>
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
									<label for="cfecha_vencimiento" class="label-control">Fecha <br />Vencimiento<span class="requerido">*</span></label>
                                    <select id="cfecha_vencimiento" class="form-control req" name="cfecha_vencimiento" >
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
												<input class="form-check-input" type="checkbox" value="" id="lunes">
												<label class="form-check-label" for="lunes">
													Lunes
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="martes">
												<label class="form-check-label" for="martes">
													Martes
												</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="miercoles">
												<label class="form-check-label" for="miercoles">
													Miércoles
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="jueves">
												<label class="form-check-label" for="jueves">
													Jueves
												</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="viernes">
												<label class="form-check-label" for="viernes">
													Viernes
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="sabado">
												<label class="form-check-label" for="sabado">
													Sábado
												</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="domingo">
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
									<input type="time" id="horario_desde" class="form-control req">
									<div id='err_horario_desde' class='requerido'></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 form-group">
									<label for="horario_hasta" class="label-control">Horario Hasta<span
											class="requerido">*</span><br />&nbsp;</label>
									<input type="time" id="horario_hasta" class="form-control req">
									<div id='err_horario_hasta' class='requerido'></div>
								</div>
							</div>
							<hr class="espacio-h" />
							<div class="row mt-7">
								<div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="ctipo_beneficio" class="label-control">Tipo Beneficio: <span class="requerido">*</span></label>
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
									<label for="cbeneficio" class="label-control">Beneficio: <span class="requerido">*</span></label>

									<div class="input-group">
										<span class="input-group-text" id="basic-addon1">$</span>
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
                                    <label for="cbeneficiario" class="label-control">Subir menú: <span class="requerido">*</span></label>
                                    <input type="file" class="form-control req" name="cadjunto_menu" id="cadjunto_menu" accept=".pdf,.png,.jpg,.jpeg" >
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
                                    <label for="cemail_comprador" class="label-control">Email del comprador<span class="requerido">*</span></label><br />
                                    <input type="text" id="cemail_comprador" class="form-control req">
									<div id='err_cemail_comprador' class='requerido'></div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-4 form-group">
                                    <label for="ctelefono_comprador" class="label-control">Teléfono del comprador</label><br />
                                    <input type="text" id="ctelefono_comprador" class="form-control">
                                </div>

                            </div>
                        </div>
						<div class="text-muted">
							<div class="row mt-7">
								<div class="col-xs-12 col-sm-12 col-md-6 form-group">
									<label for="cbeneficiario" class="label-control">Beneficiario</label>
									<input type="text" id="cbeneficiario" class="form-control">
									<div id='err_cbeneficiario' class='requerido'></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="ccorreo" class="label-control">Correo</label>
									<input type="text" id="ccorreo" class="form-control">
									<div id='err_ccorreo' class='requerido'></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="ctelefono" class="label-control">Teléfono</label>
									<input type="text" id="ctelefono" class="form-control">
									<div id='err_ctelefono' class='requerido'></div>
								</div>
							</div>

							<hr class="espacio-h" />
							<div class="row mt-7">
								<div class="col-xs-12 col-sm-12 col-md-2 form-group">
									<label for="cfactura" class="label-control">Factura</label><br />
									<input class="form-check-input req" type="checkbox" value="" id="cfactura" >
								</div>
								{{-- <div class="col-xs-12 col-sm-12 col-md-4 form-group">
									<label for="cnum_factura" class="label-control"><span id='nfac'>N° Boleta</span><span
											class="requerido factura">*</span></label>
									<input type="text" id="cnum_factura" class="form-control req">
									<div id='err_cnum_factura' class='requerido'></div>
								</div> --}}
								{{-- <div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="cfecha_factura" class="label-control"><span id='ffac'>Fecha Boleta</span><span
											class="requerido factura">*</span></label>
									<input type="date" id="cfecha_factura" class="form-control req">
									<div id='err_cfecha_factura' class='requerido'></div>
								</div> --}}
								<div class="col-xs-12 col-sm-12 col-md-3 form-group">
									<label for="cmonto_factura" class="label-control">
										<span id='mfac'>Monto Boleta</span><span class="requerido factura">*</span>
									</label>
									<div class="input-group mb-3">
										<span class="input-group-text" id="basic-addon2">$</span>
										<input type="text" id="cmonto_factura" class="form-control req">
									</div>
									<div id='err_cmonto_factura' class='requerido'></div>
								</div>
							</div>
							<hr class="espacio-h" />
							<div class="row mt-7" id="datos_fact">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 form-group">
									<label for="crazon_social" class="label-control">Razón Social<span
											class="requerido factura">*</span></label>
									<input type="text" id="crazon_social" class="form-control req">
									<div id='err_crazon_social' class='requerido'></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 form-group">
									<label for="crut" class="label-control">RUT<span class="requerido factura">*</span></label>
									<input type="text" id="crut" class="form-control req" maxlength="10">
									<div id='err_crut' class='requerido'></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 form-group">
									<label for="cgiro" class="label-control">Giro<span class="requerido factura">*</span></label>
									<input type="text" id="cgiro" class="form-control req">
									<div id='err_cgiro' class='requerido'></div>
								</div> 
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 form-group">
									<label for="cemail_dte" class="label-control">Email DTE<span class="requerido factura">*</span></label>
									<input type="text" id="cemail_dte" class="form-control req">
									<div id='err_cemail_dte' class='requerido'></div>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 form-group">
									<label for="cdireccion" class="label-control">Dirección<span class="requerido factura">*</span></label>
									<textarea id="cdireccion" class="form-control req"></textarea>
									<div id='err_cdireccion' class='requerido'></div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="btn-guardar" title="Guardar cambios">Guardar</button>
						<button type="button" class="btn btn-secondary" id="btn-cerrar" data-bs-dismiss="modal" aria-label="Close"
							title="Cerrar la ventana y descartar los cambios">Cerrar</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->




		{{-- <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
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
		</div><!-- /.modal --> --}}

		{{-- <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
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
									<label for="clave_usuario_ns" class="col-form-label">Ingrnse su clave<span
											class="requerido">*</span></label>
									<input type="password" class="form-control req" id="clave_usuario_es" name="clave_usuario_ns">
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
		</div><!-- /.modal --> --}}

		{{-- <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
		data-bs-backdrop="static" id="mdl-historial">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="historial_res"></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="card-body">
						<div class="table-responsive">
							<table id="historial_tbl" class="table table-striped" data-toggle="table" data-url="listado"
								data-buttons="btnAgrCliente" data-id-field="id" data-unique-id="id" data-search="true"
								data-search-align="left" data-height="350" data-show-refresh="true" data-show-toggle="true"
								data-show-columns="true" data-pagination="true" data-page-list="[10, 25, 50, 100, all]" data-locale="es-CL"
								data-icons-prefix="fas" data-icons="icons">
								<thead>
									<tr>
										<th data-field="id" data-sortable="true">ID</th>
										<th data-field="reserva_id" data-sortable="true">Reserva</th>
										<th data-field="nombre_cliente" data-sortable="true">Cliente</th>
										<th data-field="fecha_reserva" data-sortable="true">Fecha</th>
										<th data-field="hora_reserva" data-sortable="true">Hora</th>
										<th data-field="estado_previo" data-sortable="true">Estado<br />Previo</th>
										<th data-field="estado_actual" data-sortable="true">Estado<br />Actual</th>
										<th data-field="fecha_cambio" data-sortable="true">Fecha<br />Modificación</th>
										<th data-field="usuario_id" data-sortable="true">Usuario</th>
										<th data-field="registro_previo" data-sortable="true" data-visible="true" data-width="5"
											data-width-unit="%" data-formatter="previoFormatter">
											Registro<br />Anterior</th>
										<th data-field="registro_actual" data-sortable="true" data-visible="true" data-width="15"
											data-width-unit="%" data-formatter="actualFormatter">
											Registro<br />Actual</th>
										<th data-field="actions" class="td-actions text-center" data-click-to-select="false"
											data-formatter="listarReservasFormatter">Aciones</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					{{-- <button type="button" class="btn btn-danger" id="btn-historial"
						title="Marcar la reserva como No Show y cerrar la ventana">Aplicar</button> --}}

		{{-- <button type="button" class="btn btn-secondary" id="btn-historial" data-bs-dismiss="modal" aria-label="Close"
			title="Cerrar la ventana y descartar los cambios">Cerrar</button> --}}



	</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
	data-bs-backdrop="static" id="mdl-anular">
	<div class="modal-dialog modal-dialog-centered modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tit_anular"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="card-body">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-12">
							<label for="clave_anular" class="col-form-label">Ingrese su clave<span class="requerido">*</span></label>
							<input type="password" class="form-control req" id="clave_anular" name="clave_anular" value=' '>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 mb-12">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 mb-12">
									<label for="amotivo_anulacion">Motivo Anulación<span class="requerido">*</span></label><br />
									<textarea class="form-control req" id="amotivo_anulacion"></textarea>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" id="btn_anular_giftcard"
					title="Anular la Giftcard">Anular</button>
				<button type="button" class="btn btn-secondary" id="btn_cerrar_anulacion" data-bs-dismiss="modal"
					aria-label="Close" title="Cerrar la ventana y descartar los cambios">Cerrar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@include('giftcards.modal-estado')

@include('giftcards.modal-vencimiento')

@include('giftcards.modal-envio-email')

@include('giftcards.modal-finaliza-compra');


{{-- <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
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
	</div><!-- /.modal --> --}}

{{-- <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
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
							data-show-columns="true" data-locale="es-CL" data-icons-prefix="fas" data-icons="icons">>
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


	</div> --}}

<!-- Modal -->

{{-- <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
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
	</div> --}}
    @can('crear giftcards')
        <div class="can-crear-gitfcard"></div>
    @endcan
    @can('ver giftcards')
        <div class="can-ver-gitfcard"></div>
    @endcan
    @can('anular giftcards')
        <div class="can-anular-gitfcard"></div>
    @endcan

@include('components.mdl-vreserva')
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
