{{-- Modal Observaciones --}}
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
    id="mdl-obs">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="obs_edit_title">Editar Observaciones</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">

                            <input type="hidden" name="obs-id" id="obs-id" value="">
                            <label for="obs-edit" class="col-form-label">
                                Observaciones
                            </label>
                            <textarea class="form-control" name="obs-edit" id="obs-edit" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn-guardar-obs" title="">
                    Guardar
                </button>
                <button type="button" class="btn btn-secondary" id="btn-cerrar-obs" data-bs-dismiss="modal"
                    aria-label="Close" title="Cerrar la ventana y descartar los cambios">
                    Cerrar
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal Observaciones-->
