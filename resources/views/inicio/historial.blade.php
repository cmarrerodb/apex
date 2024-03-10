<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
        data-bs-backdrop="static" id="mdl-historial">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="historial_res"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="historial_tbl" class="table table-striped" data-toggle="table" 
                                data-buttons="btnAgrCliente" data-id-field="id" data-unique-id="id" data-search="true"
                                data-search-align="left" data-height="350" data-show-refresh="true"
                                data-show-toggle="true" data-show-columns="true" data-pagination="true"
                                data-page-list="[10, 25, 50, 100, all]" data-locale="es-CL" data-icons-prefix="fas"
                                data-icons="icons">
                                <thead>
                                    <tr>
                                        <th data-field="id" data-sortable="true">ID</th>
                                        <th data-field="reserva_id" data-sortable="true">Reserva</th>
                                        <th data-field="nombre_cliente" data-sortable="true">Cliente</th>
                                        <th data-field="hora_reserva" data-formatter="fechaFormatterHora" data-sortable="true">Hora</th>
                                        <th data-field="fecha_reserva" data-formatter="fechaFormatter" data-sortable="true">Fecha <br>Reserva</th>
                                        <th data-field="estado_previo" data-sortable="true">Estado<br />Previo</th>
                                        <th data-field="estado_actual" data-sortable="true">Estado<br />Actual</th>
                                        <th data-field="ttipo_cambio" data-sortable="true">Tipo</th>                                        
                                        <th data-field="" data-formatter="fechaCambioFormatter" data-sortable="true">Fecha<br />Modificación</th>
                                        <th data-field="usuario" data-sortable="true">Usuario</th>                                    
                                      
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-danger" id="btn-historial"
						title="Marcar la reserva como No Show y cerrar la ventana">Aplicar</button> --}}
                    <button type="button" class="btn btn-secondary" id="btn-historial" data-bs-dismiss="modal"
                        aria-label="Close" title="Cerrar la ventana y descartar los cambios">Cerrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>