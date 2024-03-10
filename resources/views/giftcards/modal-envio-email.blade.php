<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
	data-bs-backdrop="static" id="mdl-giftcard-envio-email">
	<div class="modal-dialog modal-dialog-centered modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tit_envio_email"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="card-body">
					{{-- <div class="row">
						<div class="col-12 col-sm-12 col-md-12">
							<label for="clave_anular" class="col-form-label">Ingrese su clave<span class="requerido">*</span></label>
							<input type="password" class="form-control req" id="clave_anular" name="clave_anular" value=' '>
						</div>
					</div> --}}
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 mb-12">
							<div class="row">

								<div class="col-xs-12 col-sm-12 col-md-12 my-2">
									<label for="email_beneficiario">Email beneficiario</label><br />
                                    <input type="email" class="form-control" name="email_beneficiario" id="email_beneficiario" readonly>
								</div>

                                <div class="col-xs-12 col-sm-12 col-md-12 my-2">
									<label for="otra_cuenta_email">Otra cuenta de email</label><br />
                                    <input type="email" class="form-control" name="otra_cuenta_email" id="otra_cuenta_email">
                                    <div id='err_otro_email' class='requerido'></div>
								</div>

							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success disabled" id="btn_envio_email_giftcard"
					title="Cabiar de estado">Enviar</button>
				<button type="button" class="btn btn-secondary" id="btn_cerrar_envio_email" data-bs-dismiss="modal"
					aria-label="Close" title="Cerrar la ventana y descartar los cambios">Cerrar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
