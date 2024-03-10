@extends('layouts.master')
@section('title')
	Gestión de Clientes
@endsection
@section('css')
@endsection
@section('content')
@section('pagetitle')
	Clientes
@endsection
<meta name="_token" content="{{ csrf_token() }}">
<div class="uper d-sm-none">
	<div class="card card-header">
		Gestión de Clientes
	</div>
</div>
<div class="table-responsive mt-4">
	<table id="clientes_tbl" class="table table-striped" data-toggle="table" data-url="clienteslista"
        @can('crear clientes')
            data-buttons="btnAgrCliente"
        @endcan
        data-id-field="id" data-unique-id="id" data-search="true" data-search-align="left"
		data-height="650" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-pagination="true"
		data-page-list="[10, 25, 50, 100, all]" data-locale="es-CL" data-icons-prefix="fas" data-icons="icons"
		data-toolbar="#sortable">

		<thead>
			<tr>
				<th data-field="id" data-sortable="true">ID</th>
				<th data-field="nombre" data-sortable="true">Nombre</th>
				<th data-field="rut" data-sortable="true">Rut</th>
				<th data-field="fecha_nacimiento" data-sortable="true">Fecha<br />Nacimiento</th>
				<th data-field="telefono">Tel.</th>
				<th data-field="comuna" data-sortable="true">Comuna</th>
				<th data-field="direccion">Dirección</th>
				<th data-field="categoria" data-sortable="true" title="Categoría">Categoría</th>
				<th data-field="tipo" data-sortable="true">Tipo</th>
				<th data-field="numero_tarjeta">N° Tarjeta</th>
				<th data-field="email" data-sortable="true">Correo</th>
				<th data-field="empresa" data-sortable="true">Empresa</th>
				<th data-field="hotel" data-sortable="true">Hotel</th>
				<th data-field="vino_favorito_1">Vino 1</th>
				<th data-field="vino_favorito_2">Vino 2</th>
				<th data-field="vino_favorito_3">Vino 3</th>
				<th data-field="foto">Foto</th>
				<th data-field="referencia">Ref.</th>
				<th data-formatter="formatterAccion">ACCIONES</th>		

			</tr>
		</thead>
	</table>
</div>

<div class="validar-permisos">
    @can('editar clientes')
        <div class="can-edit-cliente"></div>
    @endcan

    @can('eliminar clientes')
        <div class="can-delete-cliente"></div>
    @endcan
   
</div>


<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
	data-bs-backdrop="static" id="mdl-cliente">
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="card-body">
					<p class="card-title-desc">Datos del cliente</p>
					<div class="row">

                        <div class="col-sm-12 col-xs-12 col-md-3 mb-4">
                            <div>
                                <label for="rut">RUT</label><br />
                                <input type="text" class="form-control form-control-lg" id="rut" name="rut"
                                    placeholder="Introduzca el RUT del cliente" required>
                                <div class="resaltado1" id="error_rut"></div>

                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-md-5 mb-4">
                            <div>
                                <label for="nombre">NOMBRE<span class="requerido">*</span></label><br />
                                <input type="text" class="form-control form-control-lg" id="nombre" name="nombre"
                                    placeholder="Introduzca el nombre del cliente" required>
                                <div class="requerido" id="error_nombre"></div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-xs-12 col-md-4 mb-4">
                            <div>
                                <label for="nombre">FECHA NACIMIENTO</label><br />
                                <input type="date" class="form-control form-control-lg" id="fecha_nacimiento" name="fecha_nacimiento"
                                    placeholder="Introduzca el RUT del cliente">
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-md-3 mb-4">
                            <div>
                                <label for="rut">TELÉFONO<span class="requerido">*</span></label><br />
                                <input type="text" class="form-control form-control-lg" id="telefono" name="telefono"
                                    placeholder="Introduzca el teléfono del cliente" required value='+'>
                                <div class="requerido" id="error_telefono"></div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-xs-12 col-md-4 mb-4">
                            <div>
                                <label for="nombre">CORREO</label><br />
                                <input type="email" class="form-control form-control-lg" id="email" name="email"
                                    placeholder="Introduzca el correo del cliente del cliente">
                                <div class="resaltado1" id="error_correo"></div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-xs-12 col-md-5 mb-4">
                            <div>
                                <label for="rut">COMUNA</label><br />
                                <select class="form-select" id="comuna">
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-xs-12 col-md-6 mb-4">
                            <div>
                                <label for="nombre">DIRECCIÓN</label><br />
                                <textarea id="direccion" class="form-control form-control-lg"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-md-3 mb-4">
                            <div>
                                <label for="rut">CATEGORÍA</label><br />
                                <select class="form-select" id="categoria">
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-md-3 mb-4">
                            <div>
                                <label for="nombre">TIPO</label><br />
                                <select class="form-select" id="tipo">
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-md-4 mb-4">
                            <div>
                                <label for="empresa">EMPRESA</label><br />
                                <input type="text" class="form-control form-control-lg" id="empresa" name="empresa"
                                    placeholder="Introduzca el nombre de la empresa">
                                {{-- <div class="resaltado1" id="error_empresa"></div> --}}
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-md-4 mb-4">
                            <div>
                                <label for="hotel">HOTEL</label><br />
                                <input type="text" class="form-control form-control-lg" id="hotel" name="hotel"
                                    placeholder="Introduzca el nombre del hotel">
                                {{-- <div class="resaltado1" id="error_hotel"></div> --}}
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-md-4 mb-4">
                            <div>
                                <label for="nombre">REFERENCIA</label><br />
                                <textarea id="referencia" class="form-control form-control-lg" placeholder="Referencia"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-12 col-xs-12 col-md-4 mb-4">
                            <div>
                                <label for="vino1">VINO FAVORITO 1</label><br />
                                <input type="text" class="form-control form-control-lg" id="vino1" name="vino1"
                                    placeholder="Introduzca el vino favorito del cliente (1) del cliente">
                            </div>
                        </div>

                        <div class="col-sm-12 col-xs-12 col-md-4 mb-4">
                            <div>
                                <label for="vino2">VINO FAVORITO 2</label><br />
                                <input type="text" class="form-control form-control-lg" id="vino2" name="vino2"
                                    placeholder="Introduzca el vino favorito del cliente (1) del cliente">
                            </div>
                        </div>

                        <div class="col-sm-12 col-xs-12 col-md-4 mb-4">
                            <div>
                                <label for="vino3">VINO FAVORITO 3</label><br />
                                <input type="text" class="form-control form-control-lg" id="vino3" name="vino3"
                                    placeholder="Introduzca el vino favorito del cliente (3) del cliente">
                            </div>
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
</div>
@endsection
<script>
	var token = '{{ csrf_token() }}';
</script>
@section('script')
<script>
	var base = "{{ url('/') }}";
</script>
<script src="{{ URL::asset('/assets/js/app/comunes/funciones.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app/clientes/clientes.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/imask/imask.min.js') }}"></script>


@endsection
