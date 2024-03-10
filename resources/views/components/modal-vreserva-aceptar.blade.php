{{-- mdl-aceptar--}}
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
    id="mdl-aceptar">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="accep_res"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                            <label for="clave_usuario-accep" class="col-form-label">Ingrese su clave<span
                                    class="requerido">*</span></label>
                            <input type="password" class="form-control req" id="clave_usuario-accep" name="clave_usuario-accep">
                        </div>
                    </div>                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn-aceptar"
                    title="Aceptar la reserva y cerrar la ventana">Aceptar</button>
                <button type="button" class="btn btn-secondary" id="btn-cerrar_accep" data-bs-dismiss="modal"
                    aria-label="Close" title="Cerrar la ventana y descartar los cambios">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal Aceptar -->