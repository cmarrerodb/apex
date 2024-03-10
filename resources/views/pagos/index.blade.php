@extends('layouts.master')
@section('title')
	Gestión de Pagos de Giftcards
@endsection
@section('css')
@endsection
@section('content')
@section('pagetitle')
	Pagos de Giftcards
@endsection
<meta name="_token" content="{{ csrf_token() }}">
<div class="uper d-sm-none">
	<div class="card card-header">
		Gestión de Pagos de Giftcards
	</div>
</div>
<div class="table-responsive mt-4">
    <table id="pagos_gift_tbl" class="table table-striped" data-toggle="table" data-url="pagos_list"
        data-id-field="id" data-unique-id="id" data-search="true" data-search-align="left"
        data-height="650" data-show-refresh="true" data-show-toggle="true" data-show-columns="true"
        data-pagination="true" data-page-list="[10, 25, 50, 100, all]" data-locale="es-CL" data-icons-prefix="fas"
        data-icons="icons" data-toolbar="#sortable">
        <thead>
            <tr>
                <th data-field="id" data-sortable="true">ID</th>
                <th data-field="estado_pago.estado_pago" data-sortable="true">Estado de pago</th>
                <th data-field="forma_pago.forma_pago"  data-sortable="true">Forma de Pago</th>
                <th data-field="fecha" data-sortable="true" data-formatter="fechaFormatter" >Fecha</th>
                <th data-field="hora" data-formatter="fechaFormatterHora" data-sortable="true">Hora</th>
                <th data-field="url_adjunto" data-formatter="imageForm">Imagen del pago</th>
                <th data-field="format_monto" data-sortable="true">Monto del Pago</th>
                <th data-field="observaciones" data-sortable="true">Observaciones</th>                
                <th data-field="" data-formatter="formatterAcciones" data-sortable="true">Acciones</th>
               
            </tr>
        </thead>
    </table>

</div>

@include('pagos.modal-ver-giftcards')


@endsection
<script>
</script>
@section('script')
<script>
	var base = "{{ url('/') }}";
</script>

{{-- <script src="{{ URL::asset('/assets/js/app/comunes/giftcard_config.js') }}"></script> --}}
<script src="{{ URL::asset('/assets/js/app/comunes/funciones.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app/comunes/tabla_config.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app/pagos/index.js') }}"></script>
@endsection
