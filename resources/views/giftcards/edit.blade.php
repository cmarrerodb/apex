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
        @can('ver giftcards')
		{{-- @if (auth()->user()->giftcard_ver == 1) --}}
			<div class="row">
				<div class="col-xs-12 col-sm-h1">
					<div
						class="card estado-header-f
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
									<h1 class="text-white"><b>Estado:</b> <span class="text-estado-f">{{ $giftcard->estado }}</span> </h1>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			{{-- @if (auth()->user()->giftcard_ver) --}}
				<div class="row justify-content-center">
					<div class="col-10 col-sm-10 col-md-3">
						<div class="d-flex justify-content-center pb-3">
							<img src="data:image/png;base64,{{ $img_qr }}" alt="">
						</div>
						<button id="btn-canjear" class="form-control mb-3 @if ($giftcard->estado_id != 1) btn-secondary @else btn-success @endif"
							data-bs-target="#mdl-canjear" data-bs-toggle="modal" title="Canjear giftcard"
							@if ($giftcard->estado_id != 1) disabled @endif><i class="fas fa-gift"></i> Canjear
						</button>

						@if ($giftcard->estado_id == 1)

							<div class="d-flex justify-content-center p-1">
								Ya puede canjear la giftcard
							</div>
						@endif

					</div>
					{{-- <div class="col-10 col-sm-10 col-md-3  my-4">
						<button id="btn-anular"
							class="form-control  @if ($giftcard->estado_id != 1 || auth()->user()->giftcard_anular === 0) btn-secondary @else btn-danger @endif"
							data-bs-target="#mdl-anular" data-bs-toggle="modal" title="Anular GiftCard"
							@if ($giftcard->estado_id != 1 || auth()->user()->giftcard_anular === 0) disabled @endif><i class="fas fa-times-circle"></i></button>

					</div> --}}
				</div>
			{{-- @endif --}}
			<div class="card card-body">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mb-3">
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
											<label for="fecha_creacion" class="label-control"><b>Creación: </b><br>
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
				<div class="row justify-content-center">
					{{-- <div class="row justify-content-center row-cols-2 mt-7"> --}}
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
											<label for="estado" class="label-control"><b>Beneficio:</b><br /> $ {{ number_format($giftcard->gift_beneficio , 0, ',', '.') }}</label>
										
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
	<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
		data-bs-backdrop="static" id="mdl-anular">
		<div class="modal-dialog modal-dialog-centered modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="tit_anular"></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="card-body">
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12">
								<label for="clave_anular" class="col-form-label">Ingrese su clave<span class="requerido">*</span></label>
								<input type="password" class="form-control req" id="clave_anular" name="clave_anular" value=' '>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 mb-12">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 mb-12">
										<label for="motivo_anulacion">Motivo Anulación<span class="requerido">*</span></label><br />
										<textarea class="form-control req" id="motivo_anulacion"></textarea>

									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" id="btn_anular_giftcard"
						title="Anular la Giftcard">Anular</button>
					<button type="button" class="btn btn-secondary" id="btn_cerrar_anulacion" data-bs-dismiss="modal"
						aria-label="Close" title="Cerrar la ventana y descartar los cambios">Cerrar</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true"
		data-bs-backdrop="static" id="mdl-canjear">
		<div class="modal-dialog modal-dialog-centered modal-md">
            <form id="frm_canjear" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tit_canjear">{{ $giftcard->id }}</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            {{-- <div class="row">
                                <div class="col-12 col-sm-12 col-md-12">
                                    <label for="clave_canjear" class="col-form-label">Ingrese su clave<span class="requerido">*</span></label>
                                    <input type="password" class="form-control req" id="clave_canjear" name="clave_canjear" value=' '>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    @if(auth()->check())
                                        <p><b>Nombre del mesonero:</b> {{ auth()->user()->name }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="row  my-2">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="my-3">
                                                <label for="n_cuenta" class="form-label">N° de cuenta:</label>
                                                <input type="text" class="form-control" name="n_cuenta" id="n_cuenta" maxlength="15" >
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="my-3">
                                                <label for="mesa_id" class="form-label">Mesa:</label>
                                                <select class="form-select" name="mesa_id" id="mesa_id"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            {{-- <label for="cmesonero">Mesonero<span class="requerido">*</span></label><br /> --}}
                                            {{-- <select id="cmesonero" class="form-control req"></select> --}}
                                            {{-- <input type="text" class="form-control" name="" id="cmesonerotext" placeholder="Nombre del mesonero" > --}}
                                            {{-- <textarea class="form-select req" id="motivo_anulación"></textarea> --}}
                                            <div class="my-3">
                                                <label for="adjunto" class="form-label">Archivo:</label>
                                                <input class="form-control" type="file" name="adjunto" id="adjunto">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-primary" id="otro_canjear_giftcard"
                        title="Canjear la Giftcard">Otro Canjear</button> --}}

                        <button type="button" class="btn btn-primary" id="btn_canjear_giftcard"
                            title="Canjear la Giftcard">Canjear</button>
                        <button type="button" class="btn btn-secondary" id="btn_cerrar_canje" data-bs-dismiss="modal"
                            aria-label="Close" title="Cerrar la ventana y descartar los cambios">Cerrar</button>
                    </div>
                </div><!-- /.modal-content -->
            </form>
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
    @elsecan()
        <div class="row">
            <div class="col-xs-12 col-sm-h1">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-white text-center">
                                <h1 class="text-white"><b>NO TIENE AUTORIZACIÓN PARA VER LA GIFTCARD</b></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan

</div>
@endsection
<script>
	var token = '{{ csrf_token() }}';
</script>
@section('script')
<script>
	var base = "";
</script>
<script src="{{ URL::asset('/assets/js/app/comunes/funciones.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app/giftcards/editar.js') }}"></script>
@endsection
