<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
    id="mdl-rol">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <input type="hidden" name="name_rol_back" id="name_rol_back" >
                            <label for="" class="form-label">Nombre del rol</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="">
                        </div>
                    </div>
                    {{-- <div class="row">
                        <h5>Permisos</h5>
                        <div class="row">

                            @if (count($resultados)>0)

                                @foreach ($resultados as $categoria => $elementos)

                                    <div class="col-md-6 mb-3">
                                        <label for="">{{$categoria}}</label>
                                        <br>
                                        @foreach ($elementos as $item)
                                            <input class="form-check-input" type="check" name="permisos[]"
                                                 value="{{$item}}" >
                                            <label class="form-check-label" for="">
                                                {{$item}}
                                            </label>
                                            <br>
                                        @endforeach
                                    </div>

                                @endforeach
                            @endif

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
                        </div>
                    </div> --}}

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
