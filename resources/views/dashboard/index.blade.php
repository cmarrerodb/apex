@extends('layouts.master')
@section('title')
	Dashboard
@endsection
@section('css')
@endsection
@section('content')
@section('pagetitle')
	DASHBOARD
@endsection
@section('css')
	<link href="assets/libs/charts-tui/toastui-chart.css') }}" rel="stylesheet">
@endsection
<div class="uper d-sm-none">
	<div class="card card-header">
		DASHBOARD
	</div>
</div>
<meta name="_token" content="{{ csrf_token() }}">
{{-- CONTENIDO --}}
<div class="container">
	<div class="row">
		<div class="col-sm-12 col-lg-6 col-md-6 table-responsive">
			<table id="semanames_tbl" data-url="/dashboard/timeline_reservas" class="table table-striped" data-toggle="table"
				data-search="true" data-search-accent-neutralise="true" data-pagination="true"
				data-page-list="[10, 20, 50, 100, 200, All]" data-filter-control="true" data-click-to-select="true"
				data-pagination="true" data-sortable="true" data-search-highlight="true" data-locale="es-CL" data-height="400"
				data-sort-name="anio" data-search-align="left" data-icons-prefix="fas" data-icons="icons" data-show-export=true
				data-export-types="['xlsx']">
				<thead>
					<tr>
						<th data-field="anio" data-sortable="true">AÑO</th>
						<th data-field="csemana_mes" data-sortable="true">SEMANA</th>
						<th data-field="cant">CANT.<br />RESERVAS</th>
					</tr>
				</thead>
			</table>
		</div>
		<div class="col-sm-12 col-lg-6 col-md-6" id="reservas_semana">
		</div>
	</div>
	<div></div>
</div>
{{-- CONTENIDO --}}
@endsection
<script>
	var token = '{{ csrf_token() }}';
</script>
@section('script')
<script>
	var base = "{{ url('/') }}";
</script>
@section('script')
	<script src='assets/libs/charts-tui/toastui-chart.js'></script>
	<script src='assets/libs/choices.js/choices.js.min.js'></script>
	<script src='assets/js/app/comunes/tabla_config.js'></script>
	<script src='assets/js/app/dashboard/index.js'></script>
@endsection
