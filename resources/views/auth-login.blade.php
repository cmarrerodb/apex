@extends('layouts.master-without-nav')
@section('title')
	@lang('translation.Login')
@endsection
@section('content')
	<div class="auth-page">
		<div class="container-fluid p-0">
			<div class="row g-0 align-items-center">
				<div class="col-xxl-4 col-lg-4 col-md-6 mx-auto">
					<div class="row justify-content-center g-0">
						<div class="col-xl-9">
							<div class="p-4">
								<div class="card mb-0">
									<div class="card-body">
										<div class="auth-full-page-content rounded d-flex p-3 my-2">
											<div class="w-100">
												<div class="d-flex flex-column h-100">
													<div class="mb-4 mb-md-5">
														<a href="index" class="d-block auth-logo">
															<img src="{{ URL::asset('assets/images/logo-dark.png') }}" alt="" height="100"
																class="auth-logo-dark me-start">
															<img src="{{ URL::asset('assets/images/logo-light.png') }}" alt="" height="100"
																class="auth-logo-light me-start">
														</a>
													</div>
													<div class="auth-content my-auto">
														{{-- <div class="text-center">
                                                            <h5 class="mb-0">Welcome Back !</h5>
                                                            <p class="text-muted mt-2">Sign in to continue to Borex.</p>
                                                        </div> --}}
														<form class="mt-0 pt-0" action="index">
															<div class="form-floating form-floating-custom mb-4">
																<input type="text" class="form-control" id="input-username"
																	placeholder="Introduzca el nombre de usuario">
																<label for="input-username">Usuario</label>
																<div class="form-floating-icon">
																	<i data-eva="people-outline"></i>
																</div>
															</div>

															<div class="form-floating form-floating-custom mb-4 auth-pass-inputgroup">
																<input type="password" class="form-control pe-5" id="password-input" placeholder="Introduzca la clave">

																<button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
																	<i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
																</button>
																<label for="password-input">Clave</label>
																<div class="form-floating-icon">
																	<i data-eva="lock-outline"></i>
																</div>
															</div>

															<div class="row mb-4">
																<div class="col">
																	<div class="form-check font-size-15">
																		<input class="form-check-input" type="checkbox" id="remember-check">
																		<label class="form-check-label font-size-13" for="remember-check">
																			Recordar
																		</label>
																	</div>
																</div>

															</div>
															<div class="mb-3">
																<button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Ingresar</button>
															</div>
														</form>
														<div class="mb-3">
															<button class="btn btn-success w-100 waves-effect waves-light" type="submit">Calendario</button>
														</div>
														<div class="mb-3">
															<button class="btn btn-warning w-100 waves-effect waves-light" type="submit">Reservar</button>
														</div>
														<div class="mb-3">
															<button class="btn w-100 waves-effect waves-dark" type="submit"
																style="background-color:#2F96B4;color:#fff;">Administrar</button>
														</div>
														<div class="mb-3">
															<button class="btn w-100 waves-effect waves-light" style="background-color: #E6E6E6;"
																type="submit">Consumo clientes</button>
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
					<!-- end auth full page content -->
				</div>
				<!-- end col -->
			</div>
			<!-- end row -->
		</div>
		<!-- end container fluid -->
	</div>
@endsection
@section('script')
	<script src="{{ URL::asset('assets/js/pages/pass-addon.init.js') }}"></script>
	<script src="{{ URL::asset('assets/js/pages/eva-icon.init.js') }}"></script>
@endsection
