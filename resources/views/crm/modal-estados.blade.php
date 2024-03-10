{{-- Modal Estados --}}
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
    id="mdl-estados">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mesa_edit_title">Editar Estado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">

                            <input type="hidden" name="estado-id" id="estado-id" value="">
                            <label for="estado-edit" class="col-form-label">
                                Seleccione el Estado<span class="requerido">*</span>
                            </label>
                            <select class="form-select select-edit-estado" id="estado-edit" name="estado-edit">
                            </select>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn-guardar-estado" title="">
                    Guardar
                </button>
                <button type="button" class="btn btn-secondary" id="btn-cerrar-estado" data-bs-dismiss="modal"
                    aria-label="Close" title="Cerrar la ventana y descartar los cambios">
                    Cerrar
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal Estados-->
