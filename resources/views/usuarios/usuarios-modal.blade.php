<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
    id="mdl-usuario">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Usuario <span class="requerido">*</span></label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="">
                            <div class="requerido" id="err_username"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Nombre y apellidos <span class="requerido">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Email <span class="requerido">*</span></label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="">
                            <div class="requerido" id="err_email"></div>
                        </div>

                        {{-- Todo Pendiente de ajustar el Rol selecionado desde jquery  --}}
                        <div class="col-md-6 mb-3">
                            <label for="rol" class="form-label">Roles</label>
                            <select class="form-select list-roles" name="role" id="role">
                                {{-- <option value="SuperUsuario">SuperUsuario</option>
                                <option value="Administrador Reservas">Administrador Reservas</option>
                                <option value="Tomador Reservas">Tomador Reservas</option>
                                <option value="Consulta">Consulta</option>                                --}}
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Noficación para prereserva</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="noti_prereserva"
                                    id="noti_prereserva_si" value="si" checked>
                                <label class="form-check-label" for="noti_prereserva_si">
                                    Sí
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="noti_prereserva"
                                    id="noti_prereserva_no" value="no">
                                <label class="form-check-label" for="noti_prereserva_no">
                                    No
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="">Noficación para reserva</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="noti_reserva" id="noti_reserva_si"
                                    value="si" checked>
                                <label class="form-check-label" for="noti_reserva_si">
                                    Sí
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="noti_reserva" id="noti_reserva_no"
                                    value="no">
                                <label class="form-check-label" for="noti_reserva_no">
                                    No
                                </label>
                            </div>
                        </div>
                        

                    </div>

                    {{-- <div class="row">

                        <div class="col-12 my-3">
                            <h5>GiftCards</h5>
                            <hr>
                        </div>

                        <div class="col-md-4 mb-3">

                            <label for="">Ver giftcard</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="giftcard_ver" id="giftcard_ver_si"
                                    value="1" checked>
                                <label class="form-check-label" for="giftcard_ver_si">
                                    Sí
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="giftcard_ver" id="giftcard_ver_no"
                                    value="0">
                                <label class="form-check-label" for="giftcard_ver_no">
                                    No
                                </label>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">

                            <label for="">Crear giftcard</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="giftcard_crear" id="giftcard_crear_si"
                                    value="1" checked>
                                <label class="form-check-label" for="giftcard_crear_si">
                                    Sí
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="giftcard_crear" id="giftcard_crear_no"
                                    value="0">
                                <label class="form-check-label" for="giftcard_crear_no">
                                    No
                                </label>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">

                            <label for="">Anular giftcard</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="giftcard_anular" id="giftcard_anular_si"
                                    value="1" checked>
                                <label class="form-check-label" for="giftcard_anular_si">
                                    Sí
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="giftcard_anular" id="giftcard_anular_no"
                                    value="0">
                                <label class="form-check-label" for="crear_giftcard_no">
                                    No
                                </label>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-12 my-3">
                            <hr>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Password <span id="pass_req" class="requerido">*</span></label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="">
                            <div class="requerido" id="password-error"> </div>
                            <div class="requerido" id="err_password"></div>
                        </div>

                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-guardar" title="Cerrar la ventana y guardar cambios"
                    disabled>Guardar</button>
                <button type="button" class="btn btn-secondary" id="btn-cerrar" data-bs-dismiss="modal" aria-label="Close"
                    title="Cerrar la ventana y descartar los cambios">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
