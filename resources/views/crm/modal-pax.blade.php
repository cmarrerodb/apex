{{-- Modal Pax  --}}
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
    id="mdl-pax">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-pax-edit">Editar Pax</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                            <label for="pax-edit" class="col-form-label">
                                Ingrese el número de Pax<span class="requerido">*</span>
                            </label>
                            <input type="hidden" name="pax-id" id="pax-id" value="">
                            <input type="number" class="form-control req" id="pax-edit" name="pax-edit" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn-guardar-pax" title="">
                    Guardar
                </button>
                <button type="button" class="btn btn-secondary" id="btn-cerrar-pax" data-bs-dismiss="modal"
                    aria-label="Close" title="Cerrar la ventana y descartar los cambios">
                    Cerrar
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal Pax-->
