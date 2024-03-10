@extends('layouts.master')
@section('title')
	Revisión de Giftcards
@endsection
@section('css')
@endsection
@section('content')
@section('pagetitle')
	Revisión de Giftcards
@endsection
<meta name="_token" content="{{ csrf_token() }}">
<div class="uper">
	<div class="uper d-sm-none">
		<div class="card card-header">
			Revisión de Giftcards
		</div>
	</div>
	<div class="r-container">
		<div class="row">
			<div class="col-xs-12 col-sm-h1">
				<div
					class="card
					@switch($giftcard->estado_id)
						@case(1)
						bg-success
						@break
						@case(2)
						bg-primary
						@break
						@case(3)
						bg-danger
						@break
						@case(4)
						bg-secondary
                        @case(5)
                        bg-warning
						@break
					@endswitch
				text-white">
					<div class="card-body">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 text-white text-center">
								<h1 class="text-white"><b>Estado:</b> {{ $giftcard->estado }}</h1>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row justify-content-center">
			

			<div class="col-10 col-sm-10 col-md-3">
				<div class="d-flex justify-content-center pb-3">
					<img src="data:image/png;base64,{{ $img_qr }}" alt="">
				</div>

				@if ($giftcard->estado_id==1)

					<div class="d-flex justify-content-center pb-3">
						<a name="" id="btn-canjear" class="form-control btn btn-warning" href="{{route('giftcard_check_canjear',['codigo'=>$giftcard->codigo]) }}" role="button">
							<i class="fas fa-gift"></i> Canjear
						</a>
					</div>
				@endif

			</div>
		</div>

	
		
		<div class="card card-body">
			
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mb-3 ">
					<div class="card bg-secondary text-white h-100">
						<div class="card-body">
							<h5 class="mb-4 text-white"></i> Datos</h5>
							<div class="row mb-7">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 form-group mt-0">
										<label for="codigo" class="label-control"><b>ID: </b><span
												id="id_giftcard">{{ $giftcard->id }}</span></label>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 form-group mt-0">
										<label for="codigo" class="label-control"><b>Código:</b><br /> {{ $giftcard->codigo }}</label>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 form-group">
										<label for="estado" class="label-control"><b>Estado:</b><br /> <span
												id="estado">{{ $giftcard->estado }}</span></label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mb-3 pb-7">
					<div class="card bg-secondary text-white h-100">
						<div class="card-body">
							<h5 class="mb-4 text-white"></i> Fechas</h5>
							<div class="row mb-7">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 form-group">
										<label for="fecha_creacion" class="label-control"><b>Creación:</b><br />
											<b>Fecha:</b> {{ date('d/m/Y', strtotime($giftcard->fecha_creacion)) }}
											<b>Hora:</b> {{ date('H:i', strtotime($giftcard->hora_creacion)) }}
										</label>
									</div>
                                    @if ($giftcard->fecha_canje!="")
                                        <div class="col-xs-12 col-sm-12 col-md-12 form-group">
                                            <label for="fecha_creacion" class="label-control"><b>Canjeada: </b><br>
                                                {{ date('d/m/Y', strtotime($giftcard->fecha_canje)) }}</label>
                                        </div>
                                    @endif
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 form-group">
										<label for="fecha_vencimiento" class="label-control"><b>Vencimiento:</b><br />
											{{ date('d/m/Y', strtotime($giftcard->fecha_vencimiento)) }}</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mb-3 pb-7">
					<div class="card bg-secondary text-white h-100 shadow-xl">
						<div class="card-body">
							<h5 class="mb-4 text-white"></i> Horarios</h5>
							<div class="row mb-7">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 form-group">
										<label for="fecha_creacion" class="label-control"><b>Días:</b><br />
											{{ $giftcard->dias_uso }}</label>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 form-group">
										<label for="fecha_vencimiento" class="label-control"><b>Horas:</b><br />
											{{ $giftcard->horario_uso }}</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			{{-- <div class="row">
				<hr class="espacio-h" />
			</div> --}}
			<div class="row justify-content-center mb-3">
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mb-3">
					<div class="card bg-secondary text-white h-100">
						<div class="card-body">
							<h5 class="mb-4 text-white"></i> Beneficios</h5>
							<div class="row mb-7">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 form-group mt-0">
										<label for="codigo" class="label-control"><b>Tipo:</b><br /> {{ $giftcard->gift_tipo_beneficio }}</label>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 form-group">
										<label for="estado" class="label-control"><b>Beneficio:</b><br />$ {{ number_format($giftcard->gift_beneficio , 0, ',', '.') }}</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 mb-3 pb-7">
					<div class="card bg-secondary text-white h-100">
						<div class="card-body">
							<h5 class="mb-4 text-white"></i> Excluidos</h5>
							<div class="row mb-7">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 form-group">
										<label for="fecha_creacion" class="label-control">{{ $giftcard->platos_excluidos }}</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
