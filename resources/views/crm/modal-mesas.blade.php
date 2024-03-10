{{-- Modal Mesas --}}
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
    id="mdl-mesa">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mesa_edit_title">Editar Mesa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">

                            <input type="hidden" name="mesa-id" id="mesa-id" value="">
                            <label for="pax-edit" class="col-form-label">
                                Seleccione la mesa<span class="requerido">*</span>
                            </label>
                            <select class="form-select select-edit-mesa" id="mesa-edit" name="mesa-edit">
                            </select>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn-guardar-mesa" title="">
                    Guardar
                </button>
                <button type="button" class="btn btn-secondary" id="btn-cerrar-mesa" data-bs-dismiss="modal"
                    aria-label="Close" title="Cerrar la ventana y descartar los cambios">
                    Cerrar
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal Mesas-->
