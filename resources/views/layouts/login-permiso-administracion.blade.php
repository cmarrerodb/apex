<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
    id="mdl-permiso-administracion">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        {{-- <form method="POST"> --}}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tit-permiso-administracion"> Autorizar </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="estado-admin" id="estado-admin" >
                            {{-- <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                                        <label for="email_beneficiario">Login / Email</label><br />
                                        <input type="text" class="form-control" name="login" id="login-admin" required>
                                        <div id="err_login-admin" class="requerido"></div>
                                    </div> --}}
                            <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                                <label for="password-admin">Clave</label><br />
                                <input type="password" class="form-control" name="password-admin" id="password-admin"
                                    required>
                                <div id="err_password-admin" class="requerido"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btn_envio_page_admin"
                        title="">Enviar</button>
                    <button type="button" class="btn btn-secondary" id="btn_cerrar_page_admin" data-bs-dismiss="modal"
                        aria-label="Close" title="Cerrar la ventana y descartar los cambios">Cerrar</button>
                </div>
            </div><!-- /.modal-content -->
        {{-- </form> --}}
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
