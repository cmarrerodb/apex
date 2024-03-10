@extends('layouts.master')
@section('title')
	Revisión de Reserva
@endsection
@section('css')
@endsection
@section('content')
@section('pagetitle')
	Revisión de Reserva
@endsection

<div class="uper">
	<div class="uper d-sm-none">
		<div class="card card-header">
			Revisión de Reserva
		</div>
	</div>
	<div class="r-container">
		<div class="row">
			<div class="col-xs-12 col-sm-h1">
				<div
					class="card
					@if ($reserva->estado==4 || $reserva->estado==7 || $reserva->estado==8)
						bg-danger
					@elseif ($reserva->estado==2 || $reserva->estado==3 || $reserva->estado==5)
						bg-success						
					@else
						bg-warning						
					@endif 
					text-white">
					<div class="card-body">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 text-white text-center">
								<h1 class="text-white"><b>Estado:</b> {{ $reserva->testado }}</h1>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="card card-body">

			<div>
				<h2 class="text-center">Datos de la reserva</h2>				
			</div>
			<hr>
			<div class="d-flex flex-wrap justify-content-between ">
				<div class="py-2 px-2">
					<b>Nombre del Cliente:</b> 
					<span>{{ $reserva->nombre_cliente }}</span>
				</div>
				<div class="py-2 px-2">
					<b>Fecha de reserva:</b> 
					<span>{{ date('d/m/Y', strtotime($reserva->fecha_reserva)) }}</span>
				</div>
				<div class="py-2 px-2">
					<b>Hora de reserva:</b>
					<span>{{ date('H:i', strtotime($reserva->hora_reserva)) }}</span>
				</div>
			</div>

			<div class="d-flex flex-wrap justify-content-between ">
				<div class="py-2 px-2">
					<b>Cantidad de personas (PAX):</b>
					<span>{{ $reserva->cantidad_pasajeros }}</span>
				</div>
				<div class="py-2 px-2">
					<b>Estado de reserva:</b>
					<span>{{ $reserva->testado }}</span>
				</div>
				<div class="py-2 px-2">
					<b>Tipo de reserva:</b>
					<span>{{ $reserva->tipo }}</span>
				</div>
			</div>		
		</div>
		
	</div>
</div>
@endsection
