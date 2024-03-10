{{-- Reservas --}}
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
	id="mdl-vreserva">
	<div class="modal-dialog modal-dialog-centered modal-fullscreen">
		{{-- <div class="modal-dialog modal-dialog-centered modal-xl"> --}}
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><span id="id_reserva"></span> </h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<input type="hidden" id="arch1" value=" ">
				<input type="hidden" id="arch2" value=" ">
				<input type="hidden" id="arch3" value=" ">
				<input type="hidden" id="arch4" value=" ">
				<input type="hidden" id="arch5" value=" ">
				<input type="hidden" id="arch6" value=" ">
				<form id="frm_reservas">
					<div class="card-body">
						<input type="hidden" id="rsalon">
						<input type="hidden" id="rmesa">
						<ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="dgen" data-bs-toggle="tab" href="#general" role="tab"
									title="Datos Generales">
									<span class="d-block d-sm-none"><i class="fas fa-book-open"></i></span>
									<span class="d-none d-sm-block">Datos Generales</span>
								</a>
							</li>
							<li class="nav-item" id="panel_eventos">
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
								<form id="frm-general">
									<div class="row" style="background-color:#cafad7;">
										<div class="col-xs-12 col-sm-12 col-md-3 mb-3">
											<label for="fecha_reserva" class="col-form-label">Fecha<span class="requerido">*</span></label>
											<input type="date" class="form-control row_back1" id="fecha_reserva" name="fecha_reserva" disabled>
											<label for="text" class="col-form-label">Hora<span class="requerido">*</span></label>
											<input type="time" class="form-control row_back1" id="hora_reserva" name="hora_reserva" disabled>
											<label for="sucursal" class="col-form-label">N° Pasajeros<span class="requerido">*</span></label>
											<input type="text" class="form-control row_back1" id="pasajeros" name="pasajeros" disabled>
											<label for="tipo">Tipo<span class="requerido">*</span></label><br />
											<input type="text" class="form-control row_back1" id="tipo" disabled>
											<select id="tipo_reserva" class="form-control row_back1"></select>

											<div class="view-rechazado d-none">
												<label for="testado"  class="col-form-label"> Estado</label>
												<input type="text" class="form-control" id="testado" name="testado" disabled>
												<label for="fecha_rechazo"  class="col-form-label">Fecha Rechazo</label>
												<input type="text" class="form-control" id="fecha_rechazo" disabled>
												<label for="razon_rechazo"  class="col-form-label">Razón del Rechazo</label>
												<textarea class="form-control" id="razon_rechazo" cols="30" rows="3" disabled> </textarea>												
											</div>															
											{{-- <select id="tipo_reserva_2" class="form-control row_back1"></select> --}}
											<hr style="visibility: hidden;" />		

										</div>
										<div class="col-xs-12 col-sm-12 col-md-3" style="background-color:#f8faca;">
											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-12">
													<label for="cliente" class="col-form-label">Cliente<span class="requerido">*</span></label>
													<input type="text" class="form-control row_back1" id="cliente" disabled>
													<label for="empresa" class="col-form-label">Empresa</label>
													<input type="text" class="form-control row_back1" id="empresa" disabled>
													<label for="hotel" class="col-form-label">Hotel</label>
													<input type="text" class="form-control row_back1" id="hotel" disabled>
													<label for="telefono" class="col-form-label">Teléfono<span class="requerido">*</span></label>
													<input type="text" class="form-control row_back1" id="telefono" disabled >
													<div class="requerido" id="err_telefono"></div>
													<label for="correo" class="col-form-label">Correo</label>
													<input type="text" class="form-control row_back1" id="correo" disabled>
													<hr style="visibility: hidden;" />
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-3" style="background-color:#a9c9fc;">
											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-12">
													<label for="sucursal" class="col-form-label">Sucursal<span class="requerido">*</span></label>
													<input type="text" id="sucursal" name="sucursal" class="form-control row_back1" disabled>
													<select id="ssucursal" class="form-control row_back1"></select>
													<label for="salon" class="col-form-label">Salón</label>
													<input type="text" id="salon" name="salon" class="form-control text text-sm row_back1"
														disabled>
													<select id="ssalon" class="form-control text text-sm row_back1"></select>
													<label for="mesa" class="col-form-label">Mesa</label>
													<input type="text" id="mesa" name="mesa" class="form-control text text-sm row_back1"
														disabled>
													<select id="smesa"class="form-control text text-sm row_back1">
                                                        {{-- <option value="">Seleccione</option> --}}
                                                    </select>
													<label for="observaciones" class="col-form-label">Observaciones</label>
													<textarea id="observaciones" name="observaciones" class="form-control text text-sm row_back1" disabled rows="10" ></textarea>
													<hr style="visibility: hidden;" />
													
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-3" style="background-color:#fae5ca;;">
											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-12">
													<div class="row">
														<div class="col-xs-12 col-sm-12 col-md-6 mt-2 mb-2">
															<div class="col-xs-6 col-sm-6">
                                                                <div class="d-flex align-items-start justify-content-between">
                                                                    <label for="fmenu1" class="form-label custom-file-upload">
                                                                        <i class="fas fa-cloud-upload-alt"></i>&nbsp;Menú 1
                                                                    </label>
                                                                    <button type="button" class="btn btn-danger clear_fmenu1 mx-2 btn-sm" data-id="">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>

                                                                </div>
															</div>
															<div class="col-xs-6 col-sm-6">
																{{-- <a href="#" id="lnk_menu1" class="archivos"></a> --}}
																<a id="lnk_menu1" class="archivos"></a>
																<input type="file" class="form-control no-ctl-archivo" id="fmenu1" name="menu1">
																<label id="lbl-fmenu1"></label>
															</div>
														</div>
														<div class="col-xs-12 col-sm-12 col-md-6 mt-2 mb-2">
															<div class="col-xs-6 col-sm-6">
                                                                <div class="d-flex align-items-start justify-content-between">
                                                                    <label for="fmenu2" class="form-label custom-file-upload">
                                                                        <i class="fas fa-cloud-upload-alt"></i>&nbsp;Menú 2</label>
                                                                    <button type="button" class="btn btn-danger clear_fmenu2 mx-2 btn-sm" data-id="">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </div>
															</div>
															<div class="col-xs-6 col-sm-6">
																<a href="#" id="lnk_menu2" class="archivos"></a>
																<input type="file" class="form-control no-ctl-archivo" id="fmenu2" name="menu2">
																<label id="lbl-fmenu2"></label>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-12 col-sm-12 col-md-6 mt-2 mb-2">
															<div class="col-xs-6 col-sm-6">
                                                                <div class="d-flex align-items-start justify-content-between">
                                                                    <label for="fprecuenta" class="form-label custom-file-upload">
                                                                        <i class="fas fa-cloud-upload-alt"></i>&nbsp;Precuenta
                                                                    </label>
                                                                    <button type="button" class="btn btn-danger clear_fprecuenta mx-2 btn-sm">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </div>

															</div>
															<div class="col-xs-6 col-sm-6">
																<a href="#" id="lnk_precuenta" class="archivos"></a>
																<input type="file" class="form-control no-ctl-archivo" id="fprecuenta" name="precuenta">
																<label id="lbl-fprecuenta"></label>
															</div>
														</div>
														<div class="col-xs-12 col-sm-12 col-md-6 mt-2 mb-2">
															<div class="col-xs-6 col-sm-6">
                                                                <div class="d-flex align-items-start justify-content-between">

                                                                    <label for="ffactura" class="form-label custom-file-upload">
                                                                        <i class="fas fa-cloud-upload-alt"></i>&nbsp;Factura
                                                                    </label>

                                                                    <button type="button" class="btn btn-danger clear_ffactura mx-2 btn-sm" data-id="">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>

                                                                </div>
															</div>
															<div class="col-xs-6 col-sm-6">
																<a href="#" id="lnk_factura" class="archivos"></a>
																<input type="file" class="form-control no-ctl-archivo" id="ffactura" name="factura">
																<label id="lbl-ffactura"></label>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-xs-12 col-sm-12 col-md-6 mt-2 mb-2">
															<div class="col-xs-6 col-sm-6">
                                                                <div class="d-flex align-items-start justify-content-between">
                                                                    <label for="flogo" class="form-label custom-file-upload"><i
                                                                            class="fas fa-cloud-upload-alt"></i>&nbsp;Logo</label>
                                                                    <button type="button" class="btn btn-danger clear_flogo mx-2 btn-sm">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </div>
															</div>
															<div class="col-xs-6 col-sm-6">
																<a href="#" id="lnk_logo" class="archivos"></a>
																<input type="file" class="form-control no-ctl-archivo" id="flogo" name="logo" data-id="">
																<label id="lbl-flogo"></label>
															</div>
														</div>
														<div class="col-xs-12 col-sm-12 col-md-6 mt-2 mb-2">
															<div class="col-xs-6 col-sm-6">

                                                                <div class="d-flex align-items-start justify-content-between">
                                                                    <label for="fotro" class="form-label custom-file-upload">
                                                                        <i class="fas fa-cloud-upload-alt"></i>&nbsp;Otro
                                                                    </label>

                                                                    <button type="button" class="btn btn-danger clear_fotro mx-2 btn-sm">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </div>

															</div>
															<div class="col-xs-6 col-sm-6">
																<a href="#" id="lnk_otro" class="archivos"></a>
																<input type="file" class="form-control no-ctl-archivo" id="fotro" name="otro" data-id="">
																<label id="lbl-fotro""></label>
															</div>
														</div>
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
											<input type="text" class="form-control row_back1" id="nombre_adicional" name="nombre_adicional"
												disabled>
											<label for="pax" class="col-form-label">Pax</label>
											<input type="text" class="form-control row_back1" id="pax" name="pax" disabled>
											<label for="nombre_contatos" class="col-form-label">Nombre Contacto</label>
											<input type="text" class="form-control row_back1" id="nombre_contacto" name="nombre_contacto"
												disabled>
											<label for="telefono_contacto">Teléfono contacto</label><br />
											<input type="text" class="form-control row_back1" id="telefono_contacto" name="telefono_contacto"
												disabled >
											<label for="correo_contacto">Correo contacto</label><br />
											<input type="text" class="form-control row_back1" id="correo_contacto" name="correo_contacto"
												disabled>
											<label for="idioma">Idioma</label><br />
											<input type="text" class="form-control row_back1" id="idioma" name="correo_contacto" disabled>
											<hr style="visibility: hidden;" />
										</div>
										<div class="col-xs-12 col-sm-12 col-md-3" style="background-color:#f8faca;">
											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-12">
													<label for="cristaleria" class="col-form-label">Cristaleria</label>
													<input type="text" class="form-control row_back1" id="cristaleria" disabled>

													<label for="anticipo" class="col-form-label">Anticipo</label>
													<div class="input-group">
														<div class="input-group-text" id="btnGroupAddon0">$</div>
														<input type="text" class="form-control row_back1" id="anticipo" disabled>
													</div>

													<label for="valor_menu" class="col-form-label">Valor Menú</label>
													<div class="input-group">
														<div class="input-group-text" id="btnGroupAddon1">$</div>
														<input type="text" class="form-control row_back1" id="valor_menu" disabled>														
													</div>
													
													<label for="total_s_propina" class="col-form-label">Total sin Propina</label>
													<div class="input-group">
														<div class="input-group-text" id="btnGroupAddon2">$</div>
														<input type="text" class="form-control row_back1" id="total_s_propina" disabled>
													</div>

													<label for="total_c_propina" class="col-form-label">Total con Propina</label>
													<div class="input-group">
														<div class="input-group-text" id="btnGroupAddon3">$</div>
														<input type="text" class="form-control row_back1" id="total_c_propina" disabled>														
													</div>

													<input type="text" style="display:none;">
													<hr style="visibility: hidden;" />
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-2" style="background-color:#a9c9fc;">
											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-12">
													<label for="pago_local" class="col-form-label">Pago en Local</label>
													<input type="text" id="pago_local" name="pago_local" class="form-control row_back1" disabled>
													<select id="spago_local"class="form-control row_back1">
														<option value='' disabled selected>Seleccione</option>
														<option value='1'>SI</option>
														<option value='2'>NO</option>
													</select>
													<label for="audio" class="col-form-label">Audio</label>
													<input type="text" id="audio" name="audio" class="form-control row_back1" disabled>
													<select id="saudio" class="form-control row_back1">
														<option value='' disabled selected>Seleccione</option>
														<option value='1'>SI</option>
														<option value='2'>NO</option>
													</select>
													<label for="video" class="col-form-label">Video</label>
													<input type="text" id="video" name="video" class="form-control row_back1" disabled>
													<select id="svideo" class="form-control row_back1">
														<option value='' disabled selected>Seleccione</option>
														<option value='1'>SI</option>
														<option value='2'>NO</option>
													</select>
													<label for="video_audio" class="col-form-label">Video con Audio</label>
													<input type="text" id="video_audio" name="video_audio" class="form-control row_back1" disabled>
													<select id="svideo_audio"class="form-control row_back1">
														<option value='' disabled selected>Seleccione</option>
														<option value='1'>SI</option>
														<option value='2'>NO</option>
													</select>
													<label for="adicional" class="col-form-label">Adicional</label>
													<input type="text" id="adicional" name="adicional" class="form-control row_back1" disabled>
													<select id="sadicional"class="form-control row_back1">
														<option value='' disabled selected>Seleccione</option>
														<option value='1'>SI</option>
														<option value='2'>NO</option>
													</select>
													<label for="extra" class="col-form-label">Extra Adicional</label>
													<input type="text" id="extra" name="extra" class="form-control row_back1" disabled>
													<select id="sextra" class="form-control row_back1">
														<option value='' disabled selected>Seleccione</option>
														<option value='1'>SI</option>
														<option value='2'>NO</option>
													</select>
													<hr style="visibility: hidden;" />
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-2" style="background-color:#fae5ca;;">
											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-12">
													<div id="dvextras">
														<label for="autoriza" class="col-form-label">Autorizado por</label>
														<input type="text" class="form-control row_back1" id="autoriza" disabled>
														<label for="telefono_autoriza" class="col-form-label">Teléfono Autoriza</label>
														<input type="text" class="form-control row_back1" id="telefono_autoriza" disabled>

														<label for="monto_autorizado" class="col-form-label">Monto Máximo</label>
														<div class="input-group">
															<div class="input-group-text" id="btnGroupAddon1">$</div>
															<input type="number" class="form-control row_back1" id="monto_autorizado" disabled>
														</div>
														
													</div>
													<label for="menu_impreso" class="col-form-label">Menú Impreso</label>
													<input type="text" id="menu_impreso" name="menu_impreso" class="form-control back_row1" disabled>
													<select id="smenu_impreso" class="form-control back_row1">
														<option value='' disabled selected>Seleccione</option>
														<option value='1'>SI</option>
														<option value='2'>NO</option>
													</select>
													<label for="table_tent" class="col-form-label">Table Tent</label>
													<input type="text" id="table_tent" name="table_tent" class="form-control back_row1" disabled>
													<select id="stable_tent" class="form-control back_row1">
														<option value='' disabled selected>Seleccione</option>
														<option value='1'>SI</option>
														<option value='2'>NO</option>
													</select>
													<label for="restriccion" class="col-form-label">Restricción Alimenticia</label>
													<input type="text" id="restriccion" name="restriccion" class="form-control back_row1" disabled>
													<select id="srestriccion" class="form-control back_row1">
														<option value='' disabled selected>Seleccione</option>
														<option value='1'>SI</option>
														<option value='2'>NO</option>
													</select>
													<label for="detalle_restriccion" class="col-form-label">Detalle Restricción</label>
													<textarea id="detalle_restriccion" rows="1" name="detalle_restriccion" class="form-control back_row1"
													 disabled></textarea>
													<hr style="visibility: hidden;" />
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-3" style="background-color:#e4ccfc">
											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-12">
													<label for="decoracion" class="col-form-label">Decoración</label>
													<textarea id="decoracion" name="decoracion" class="form-control back_row1" disabled></textarea>
													<label for="ubicacion" class="col-form-label">Ubicación</label>
													<textarea id="ubicacion" name="ubicacion" class="form-control back_row1" disabled></textarea>
													<label for="monta" class="col-form-label">Monta</label>
													<textarea id="monta" name="monta" class="form-control back_row1" disabled></textarea>
													<label for="comentarios" class="col-form-label">Comentarios eventos</label>
													<textarea id="comentarios" name="comentarios" class="form-control back_row1" disabled></textarea>
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
						<div class="row" id="div_passwd">
							<div class="col-xs-12 col-sm-12 col-md-4 offset-md-2 text-center">
								<label for="clave">Introduzca su clave<span class="requerido">*</span></label>
								<input id="clave" name="clave" type="password" class="form-control req"
									placeholder="Introduzca su clave de usuario" value="">
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 text-center">
								<label for="btn_reerva" style="visibility:hidden;">Presione el boton</label>
								<button id="btn_reerva" type="button" class="form-control btn btn-primary" title="Presione para actualizar la reserva"> 
									Actualizar reserva
								</button>
							</div>
						</div>


						{{--  --}}

					</div>
				</form>
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
{{-- Documentos --}}
<div class="modal fade" id="mdl-documento" tabindex="-1" aria-labelledby="mdl-documento-label" aria-hidden="true"
	data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="mdl-documento-label">Documento</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<iframe src="" width="100%" height="400px"></iframe>
			</div>
		</div>
	</div>
</div>
