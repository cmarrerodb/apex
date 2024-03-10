@extends('layouts.master')
@section('title')
	Gestión de tipos de reservas
@endsection
@section('css')
	{{-- <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet"> --}}
@endsection
@section('content')
@section('pagetitle')
	Tipos de Reservas
@endsection
<meta name="_token" content="{{ csrf_token() }}">
<div class="uper">
	{{-- <div class="card card-header">
		Gestión de tipos de Reservas
	</div> --}}
	<div class="row">
		<div class="col-md-7">
			<div class="row" id="agr_tipo">
				<div class="col-md-5">
					<label for="nuevo_tipo">Tipo</label>
					<input type="text" id="nuevo_tipo" class="form-control text text-sm"
						placeholder="Introduzca un nuevo tipo de reserva">
				</div>
				<div class="col-md-5">
					<label for="nueva_clase">Color</label>
					<input type="text" id="nueva_clase" class="form-control text text-sm" placeholder="Introduzca el color">
				</div>
				<div class="col-xs-12 col-sm-12 col-md-1 mt-1">
					<label for='agr_acc'>&nbsp;</label>
					<button id="agr_acc" class="btn btn-primary btn-sm" title="Confirmar"><i class="fas fa-check"></i></button>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-1 mt-1">
					<label for='agr_can'>&nbsp;</label>
					<button id="agr_can" class="btn btn-dark btn-sm" title="Cancelar"><i class="fas fa-times"></i></button>
				</div>
			</div>
		</div>
	</div>
	<div class="table-responsive mt-4">
		<table id="tipos_tbl" data-url="/reservas/tiposlista" class="table table-striped" data-toggle="table"
			data-search="true" data-search-accent-neutralise="true" data-pagination="true"
			data-page-list="[10, 20, 50, 100, 200, All]" data-unique-id="id" data-show-columns="true" data-filter-control="true"
			data-click-to-select="true" data-pagination="true" data-sortable="true" data-search-highlight="true"
			data-locale="es-CL" data-height="650"
            @can('cear tipos de reservas')
                data-buttons="btnAgregar"
            @endcan
            data-sort-name="id" data-search-align="left"
			data-icons-prefix="fas" data-icons="icons">
			<thead>
				<tr>
					<th data-field="id" data-sortable="true">ID</th>
					<th data-field="tipo" class="tipoCol" data-sortable="true">Tipo</th>
					<th data-field="color_class" class="tipoCol" data-sortable="true">Color</th>
					<th data-field="acciones">ACCIONES</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

{{-- Modal  --}}
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
    id="mdl-tipo">
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
                            <input type="hidden" name="tipo_id" id="tipo_id">
                            <label for="" class="form-label">Tipo</label>
                            <input type="text" class="form-control" name="tipo" id="tipo" placeholder="">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="form-label">Color</label>
                            <input type="text" class="form-control" name="color" id="color" placeholder="">
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
	var base = "";
	//var base = "{{ url('/') }}";
</script>
<script src="/assets/js/app/comunes/tabla_config.js"></script>
<script src="/assets/js/app/comunes/tabla_init.js"></script>
<script src="/assets/js/app/reservas/tipos.js"></script>
@endsection
