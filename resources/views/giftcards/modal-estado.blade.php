<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
	data-bs-backdrop="static" id="mdl-giftcard-estado">
	<div class="modal-dialog modal-dialog-centered modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tit_estado"></h5>
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
								<div class="col-xs-12 col-sm-12 col-md-12 mb-12">
									<label for="amotivo_anulacion">Estados<span class="requerido">*</span></label><br />
                                    <select class="form-select list_estado_gift req" name="gift_estado_id" id="gift_estado_id">
                                        <option value="">Seleccione</option>
                                        <option value="1">DISPONIBLE</option>
                                    </select>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" id="btn_estado_giftcard"
					title="Cabiar de estado">Guardar</button>
				<button type="button" class="btn btn-secondary" id="btn_cerrar_estado" data-bs-dismiss="modal"
					aria-label="Close" title="Cerrar la ventana y descartar los cambios">Cerrar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
