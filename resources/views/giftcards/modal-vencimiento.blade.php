<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
	data-bs-backdrop="static" id="mdl-giftcard-vencido">
	<div class="modal-dialog modal-dialog-centered modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tit_vencido"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="card-body">

					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 mb-12">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 mb-12">
									<label for="gift_vencimiento_edit">Dias de vencimiento<span class="requerido">*</span></label><br />
                                    <select class="form-select fecha_vencimiento_gift req" name="gift_vencimiento_edit" id="gift_vencimiento_edit">
                                        <option value="">Seleccione</option>
                                        <option value="15">15 Dias</option>
                                        <option value="30">30 Dias</option>
                                    </select>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" id="btn_vencimiento_giftcard"
					title="Cabiar de estado">Guardar</button>
				<button type="button" class="btn btn-secondary" id="btn_cerrar_vencimiento" data-bs-dismiss="modal"
					aria-label="Close" title="Cerrar la ventana y descartar los cambios">Cerrar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
