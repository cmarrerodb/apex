{{-- Modal Editar comensal --}}
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
    id="mdl-edit-comensales">
    <div class="modal-dialog modal-dialog-centered modal-lg ">
        <div class="modal-content">
            <form action="" method="POST" id="form-edit-comensal">
                
                <input type="hidden" name="edit-comensal-id" id="edit-comensal-id" value=""> 
                <div class="modal-header">
                    <h5 class="modal-title" id="comensal_edit_title">Editar Comensal ID: <span></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            
                            <div class="col-md-4 mb-3">
                                <label for="registro_hash" class="form-label">Codigo Hash</label>
                                <input type="text" class="form-control" name="registro_hash" id="registro_hash" disabled/>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nombre" class="form-label">Nombres <span class="requerido">*</span></label>
                                <input type="text" class="form-control req" name="nombre" id="nombre" />
                                <div class="requerido" id="err_nombre"></div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="apellido" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" name="apellido" id="apellido" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="email" class="form-label">Email <span class="requerido">*</span></label>
                                <input type="text" class="form-control req" name="email" id="email" />
                                <div class="requerido" id="err_email"></div>
                            </div>
    
                            <div class="col-md-4 mb-3">
                                <label for="telefono" class="form-label">Telefono</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" />
                            </div>
    
                            <div class="col-md-4 mb-3">
                                <label for="birth_day" class="form-label">Fecha de nacimiento <span class="requerido">*</span></label>
                                <input type="date" class="form-control req" name="birth_day" id="birth_day" />
                                <div class="requerido" id="err_birth_day"></div>
                            </div>
    
                            <div class="col-md-4 mb-3">
                                <label for="parent_registro_hash" class="form-label">Padre codigo hash</label>
                                <input type="text" class="form-control" name="parent_registro_hash" id="parent_registro_hash" disabled />
                            </div>
                            {{-- <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <input type="hidden" name="mesa-id" id="mesa-id" value="">
                                <label for="mesa-edit" class="col-form-label">
                                    Seleccione la mesa<span class="requerido">*</span>
                                </label>
                                <select class="form-select select-edit-mesa" id="mesa-edit" name="mesa-edit">
                                </select>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btn-edit-comensal" title="">
                        Guardar
                    </button>
                    <button type="button" class="btn btn-secondary" id="btn-cerrar-edit-comensal" data-bs-dismiss="modal"
                        aria-label="Close" title="Cerrar la ventana y descartar los cambios">
                        Cerrar
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal Editar comensal-->
