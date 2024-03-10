@extends('layouts.master')
@section('title')
	Inicio
@endsection
@section('content')
@section('pagetitle')
	Inicio
@endsection
<div class="row mb-3">
	<div class="col-xs-12 col-sm-12 col-md-2 mb-2">
		<div class="row">
			Sucursal
		</div>
		<div class="row">
			<select class="form-select" aria-label="Default select example">
				<option disabled selected>Seleccione la sucursal</option>
				<option value="1">Patio</option>
				<option value="2">Vivo</option>
				<option value="3">Feria</option>
			</select>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-3 mb-4">
		<div class="row">
			<div class="col-md-12">
				Fecha
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<button class="btn btn-primary btn-md" title="DIA ANTERIOR"><i class="fas fa-arrow-circle-left"></i></button>
				<input type="date" id="fecha" name="fecha">
				<button class="btn btn-primary btn-md" title="DIA SIGUIENTE"><i class="fas fa-arrow-circle-right"></i></button>
			</div>
		</div>
	</div>
	<div class="col-md-1 mb-1">
		<div class="row">Total Pax</div>
		{{-- #c92a02 --}}
		<div class="row">
			<div
				style="
					{{-- margin-top:-5%; --}}
					width:40px; 
					height:40px; 
					border:1px solid black;
					background:#171715;
					border-radius: 50%;
					border:0;">
				<span
					style="
				font-size:150%;
				margin-left:0%;
				{{-- padding-top:10%; --}}
				font-wheight:bold;
				color: white;
				">47</span>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-2 mb-3">
		<div class="row">&nbsp;</div>
		<div class="row">
			<button class="btn btn-success btn-md">Consumo del cliente</button>
		</div>
	</div>
</div>
<div class="row mb-3">
	<div class="col-md-4 mx-auto">
		<div class="row">
			<div class="col-md-4">
				<button class="btn btn-success btn-md">DÍA</button>
			</div>
			<div class="col-md-4">
				<button class="btn btn-danger btn-md">NOCHE</button>
			</div>
			<div class="col-md-4">
				<button class="btn btn-primary btn-md">TARDE</button>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<table>
		<table class="table table1 table-responsive">
			<thead>
				<tr>
					<th scope="col">Modificar <br />Reserva</th>
					<th scope="col">Ver <br />Reserva</th>
					<th scope="col">Cliente</th>
					<th scope="col">Hora</th>
					<th scope="col">Pax</th>
					<th scope="col">Mesa</th>
					<th scope="col">Estado</th>
					<th scope="col">Razón<br />Canc</th>
					<th scope="col">Obs.<br />Canc</th>
					<th scope="col">Tipo</th>
					<th scope="col">Menú</th>
					<th scope="col">Menú 2</th>
					<th scope="col">Obseravaciones</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><button class="btn btn-primary btn-sm" title="editar"><i class="fas fa-edit"></i></button></td>
					<td><button class="btn btn-success btn-sm" title="Ver"><i class="fas fa-eye"></i></button></td>
					<td>Paola Raito ()</td>
					<td>20:30</td>
					<td>2</td>
					<td></td>
					<td>Realizada</td>
					<td></td>
					<td></td>
					<td>Regular</td>
					<td></td>
					<td></td>
					<td>
						<div><button class="btn btn-danger btn-sm" title="Cancelar reserva">C</button>&nbsp;<button
								class="btn btn-primary btn-sm" title="No Show">NS</button></div>
					</td>
				</tr>
				<tr style="background:#f4fca4 !important;">
					<td><button class="btn btn-primary btn-sm" title="editar"><i class="fas fa-edit"></i></button></td>
					<td><button class="btn btn-success btn-sm" title="Ver"><i class="fas fa-eye"></i></button></td>
					<td>CTS ()</td>
					<td>19:00</td>
					<td>27</td>
					<td></td>
					<td>Realizada</td>
					<td></td>
					<td></td>
					<td>EVENTO</td>
					<td></td>
					<td></td>
					<td>CONFIRMADO FG-6366690 SAM-05 20230304 10 de Marzo2...&nbsp;<div><button class="btn btn-danger btn-sm"
								title="Cancelar Reerva">C</button>&nbsp;<button class="btn btn-primary btn-sm" title="No Show">NS</button></div>
					</td>
				</tr>
				<tr style="background:#f4fca4 !important;">
					<td><button class="btn btn-primary btn-sm" title="editar"><i class="fas fa-edit"></i></button></td>
					<td><button class="btn btn-success btn-sm" title="Ver"><i class="fas fa-eye"></i></button></td>
					<td>CTS ()</td>
					<td>19:00</td>
					<td>18</td>
					<td></td>
					<td>Realizada</td>
					<td></td>
					<td></td>
					<td>EVENTO</td>
					<td></td>
					<td></td>
					<td>Hola, Karen, buen día. GATE-1 / FG 636718 SAM-02: 2...&nbsp;<div><button class="btn btn-danger btn-sm"
								title="Cancelar Reerva">C</button>&nbsp;<button class="btn btn-primary btn-sm" title="No Show">NS</button></div>
					</td>
				</tr>

			</tbody>

			{{-- <thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">First</th>
				<th scope="col">Last</th>
				<th scope="col">Handle</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th scope="row">1</th>
				<td>Mark</td>
				<td>Otto</td>
				<td>@mdo</td>
			</tr>
			<tr>
				<th scope="row">2</th>
				<td>Jacob</td>
				<td>Thornton</td>
				<td>@fat</td>
			</tr>
			<tr>
				<th scope="row">3</th>
				<td colspan="2">Larry the Bird</td>
				<td>@twitter</td>
			</tr>
		</tbody> --}}
		</table>

		{{-- <table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th scope="col">Modificar <br />Reserva</th>
				<th scope="col">Ver <br />Reserva</th>
				<th scope="col">Cliente</th>
				<th scope="col">Hora</th>
				<th scope="col">Pax</th>
				<th scope="col">Mesa</th>
				<th scope="col">Estado</th>
				<th scope="col">Razón<br />Canc</th>
				<th scope="col">Tipo</th>
				<th scope="col">Menú</th>
				<th scope="col">Obseravaciones</th>
				<th scope="col">Acciones</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td data-value="PEPE">PEPE</td>
				<td data-value="CASA">DESCONOCIDA</td>
				<td data-value="estado">DESAPARECIDO</td>
				<td data-value="PEPE">PEPE</td>
				<td data-value="CASA">DESCONOCIDA</td>
				<td data-value="estado">DESAPARECIDO</td>
				<td data-value="PEPE">PEPE</td>
				<td data-value="CASA">DESCONOCIDA</td>
				<td data-value="estado">DESAPARECIDO</td>
				<td data-value="PEPE">PEPE</td>
				<td data-value="CASA">DESCONOCIDA</td>
				<td data-value="estado">DESAPARECIDO</td>
			</tr>
			<tr>
				<td data-value="PEPE">LUCHO</td>
				<td data-value="CASA">CEMENTERIO DE MASCOTAS</td>
				<td data-value="estado">D.O.A.</td>
				<td data-value="PEPE">LUCHO</td>
				<td data-value="CASA">CEMENTERIO DE MASCOTAS</td>
				<td data-value="estado">D.O.A.</td>
				<td data-value="PEPE">LUCHO</td>
				<td data-value="CASA">CEMENTERIO DE MASCOTAS</td>
				<td data-value="estado">D.O.A.</td>
				<td data-value="PEPE">LUCHO</td>
				<td data-value="CASA">CEMENTERIO DE MASCOTAS</td>
				<td data-value="estado">D.O.A.</td>
			</tr>
		</tbody>
	</table> --}}
</div>

@endsection
@section('script')
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
<script type="text/javascript">
	let date = new Date();
	let day = date.getDate();
	let month = date.getMonth() + 1;
	let year = date.getFullYear();
	if (month < 10) month = "0" + month;
	if (day < 10) day = "0" + day;
	let today = year + "-" + month + "-" + day;
	document.getElementById("fecha").value = today;
</script>
@endsection
