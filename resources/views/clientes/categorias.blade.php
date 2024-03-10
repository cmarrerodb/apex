@extends('layouts.master')
@section('title')
	Gestión de categorias de clientes
@endsection
@section('css')
@endsection
@section('content')
@section('pagetitle')
	Categorias de Clientes
@endsection
<meta name="_token" content="{{ csrf_token() }}">
<div class="uper">
	<div class="card card-header">
		Gestión de categorias de clientes
	</div>
	<form id="frmCrear">
		<div class="row">
			<div class="col-md-7">
				<div class="row" id="agr_categoria">
					<div class="col-md-5">
						<label for="nuevo_categoria">CATEGORÍA</label>
						<input type="text" id="nuevo_categoria" name="nuevo_categoria" class="form-control text text-sm crear"
							placeholder="Introduzca una nueva categoría de cliente" required>
					</div>
					<div class="col-md-5">
						<label for="nuevo_categoria">MONTO</label>
						<input type="text" id="nuevo_monto" name="nuevo_monto" class="form-control text text-sm crear"
							placeholder="Introduzca el monto de la categoría" required>
					</div>
					<div class="col-md-1 mt-2">
						<button id="agr_acc" class="btn btn-primary btn-sm" title="Confirmar" onclick='crear();'><i
								class="fas fa-check"></i></button>
					</div>
					<div class="col-md-1 mt-2">
						<button id="agr_can" class="btn btn-dark btn-sm" title="Cancelar"><i class="fas fa-times"></i></button>
					</div>
				</div>
			</div>
		</div>
	</form>
	<div class="table-responsive mt-4">
		<table id="categorias_tbl" class="table table-striped" data-toggle="table" data-search="true"
			data-search-accent-neutralise="true" data-pagination="true" data-page-list="[10, 20, 50, 100, 200, All]"
			data-unique-id="id" data-show-columns="true" data-filter-control="true" data-click-to-select="true"
			data-pagination="true" data-sortable="true" data-search-highlight="true" data-locale="es-CL"
			data-url="categoriaslista" data-height="650" data-sort-name="id" data-icons-prefix="fas" data-icons="icons"
			data-row-style="rowStyle"
            @can('editar categoria de clientes')
                data-buttons="btnAgregar"
            @endcan
             data-search-align="left">
			<thead>
				<tr>
					<th data-field="id" data-sortable="true">ID</th>
					<th data-field="categoria" class="categoriaCol" data-sortable="true">Categoria</th>
					<th data-field="monto" class="categoriaCol" data-sortable="true" data-formatter="frm_monto">Monto</th>
					<th data-formatter="formatterAccion">ACCIONES</th>	
				</tr>
			</thead>
		</table>
	</div>
</div>

<div class="validar-permisos">
    @can('editar categoria de clientes')
        <div class="can-edit-categoria-cliente"></div>
    @endcan

    @can('eliminar categoria de clientes')
        <div class="can-delete-categoria-cliente"></div>
    @endcan
   
</div>


{{-- Modal  --}}
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
    id="mdl-categoria">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <input type="hidden" name="cat_id" id="cat_id">
                            <label for="categoria" class="form-label">Categoria</label>
                            <input type="text" class="form-control" name="categoria" id="categoria" placeholder="">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="monto" class="form-label">Monto</label>
                            <input type="text" class="form-control" name="monto" id="monto" placeholder="">
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
@endsection
<script>
	var token = '{{ csrf_token() }}';
</script>
@section('script')
<script>
	var base = "{{ url('/') }}";
</script>
<script src="{{ URL::asset('/assets/js/app/comunes/tabla_config.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app/comunes/tabla_init.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app/clientes/categorias.js') }}"></script>
@endsection
