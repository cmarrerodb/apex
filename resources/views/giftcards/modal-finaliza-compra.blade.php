<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
	data-bs-backdrop="static" id="mdl-giftcard-finaliza-compra">
	<div class="modal-dialog modal-dialog-centered modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tit_envio_email">Compra de giftcard finalizada </h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="card-body">

                    <div class="row">
						<div class="col-md-12">
							<h5>Datos</h5>
						</div>

						<div class="col-md-12">
							<p><b>Nombre del beneficiario:</b> <span class="nombre_ben_fin"></span></p>
						</div>
						<div class="col-md-12">
							<p><b>Monto de Giftcard:</b> <span class="monto_ben_fin"></span></p>
							<hr>
						</div>						
                    </div>                    
				
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 my-2">
							<input type="hidden" name="id_gift_fin_compra" id="id_gift_fin_compra"  >
							
							<label for="email_beneficiario_fin_compra">Email del beneficiario</label><br />
							<input type="email" class="form-control" name="email_beneficiario_fin_compra" id="email_beneficiario_fin_compra" >
							<div id="err_email_beneficiario_fin_compra" class="requerido"></div>
						</div>
						<div class="d-flex justify-content-center my-3">							
							<img id="imagenCompraFinQR" src="" alt="" >
						</div>
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" id="btn_envio_email_giftcard_fin_compra"
					title="Enviar Email">Enviar Email de Giftcard</button>
				<button type="button" class="btn btn-secondary" id="btn_cerrar_envio_emai_fc" data-bs-dismiss="modal"
					aria-label="Close" title="Cerrar la ventana y descartar los cambios">Cerrar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
