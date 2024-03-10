<div class="modal fade bs" -example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" id="mdl-configuracion">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <form action="" method="POST" id="form-config">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="configura_id" id="configura_id" >
                            <div class="col-md-4 mb-3">
                                <label for="" class="form-label">Nombre de la configuración:<span class="requerido">*</span></label>
                                <input type="text" class="form-control req" name="name" id="name" placeholder="">
                                <div class="err_name requerido"></div>
    
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="tipo_id" class="form-label">Tipo de configuración:<span class="requerido">*</span></label>
                                <select class="form-select list-tipos req" name="tipo_id" id="tipo_id" data-tipo-id ="">
                                </select>
                                <div class="err_tipo_id requerido"></div>
    
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="" class="form-label">Vista o Módulo</label>
                                <select class="form-select list-vistas" name="vista_id" id="vista_id" data-vista-id="">
                                </select>
                            </div>
    
                            <div id="valorRf" class="col-md-4 mb-3 d-none">
                                <label for="" class="form-label">Valor</label>
                                <input type="number" class="form-control" name="valor" id="valor">
                            </div>
    
                            <div id="valorDuracion" class="col-md-4 mb-3 d-none">
                                <label for="" class="form-label">Duración</label>
                                <select name="duracion" class="form-select list-duracion" id="duracion">
                                </select>                            
                            </div>
    
                            <div id="valorEmail" class="col-md-4 mb-3 d-none">
                                <label for="" class="form-label">Email Notificación</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>

                            <div id="valorActivo" class="col-md-4 mb-3 ">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="activoCheckChecked" name="activoCheckChecked" checked="">
                                    <label class="form-check-label" for="activoCheckChecked">Notificación Activa</label>
                                </div>
                               
                            </div>
    
                        </div>
                        <div class="row my-3 d-none" id="valorDescripcion">
                            <div class="col-12">
                                <label for="" class="form-label">Descripción de la notificación</label>
                                <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
                            </div>
                        </div>
    
                        <div id="datosColum" class="my-5 d-none">
                            <hr>
                            <table class="table color-table dark-table table-striped colum-item ">
                                <thead>
                                    <tr>
                                        <th>
                                            Nombre de la columna en Base de Datos
                                        </th>
                                        <th>
                                            Nombre de la columna en la Tabla
                                        </th>
                                        <th>
                                            Visible
                                        </th>
                                        <th>
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-guardar"
                        title="Cerrar la ventana y guardar cambios" >Guardar</button>
                    <button type="button" class="btn btn-secondary " id="btn-cerrar-configuracion" data-bs-dismiss="modal"
                        aria-label="Close" title="Cerrar la ventana y descartar los cambios">Cerrar</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
