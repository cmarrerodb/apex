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
										<div class="auth-full-page-content rounded d-flex p-3 ">
											<div class="w-100">
												<div class="d-flex flex-column h-100">
													<div class="mb-1 mb-md-1">
														<a href="/" class="d-block auth-logo">
															<img src="/assets/images/logo-dark-barrica.png" alt="" height="100" class="auth-logo-dark me-start">
															<img src="/assets/images/barrica-light.png" alt="" height="100" class="auth-logo-light me-start">
														</a>
													</div>
													<div class="auth-content my-auto">
														{{-- <div class="text-center">
                                                                <h5 class="mb-0">Welcome Back !</h5>
                                                                <p class="text-muted mt-2">Sign in to continue to Borex.</p>
                                                            </div> --}}
														<form class="mt-1 pt-2" action="/login" method="POST">
															{{-- <form class="mt-4 pt-2" action="{{ route('login') }}" method="POST"> --}}
															@csrf
															<div class="form-floating form-floating-custom mb-4">
																<input type="text" class="form-control form-pe  @error('email') is-invalid @enderror" id="input-username"
																	placeholder="Enter User Name" name="email">
																{{-- <input type="text" class="form-control @error('email') is-invalid @enderror"
																	value="{{ old('email', 'admin@themesbrand.com') }}" id="input-username" placeholder="Enter User Name"
																	name="email"> --}}
                                                                @if(session('resultado_mensaje'))
                                                                    <span class="invalid-feedback2" role="alert">
																		<strong>{{ session('resultado_mensaje') }}</strong>
																	</span>
                                                                @endif

																@error('email')
																	<span class="invalid-feedback" role="alert">
																		<strong>{{ $message }}</strong>
																	</span>
																@enderror
																<label for="input-username">Usuario</label>
																<div class="form-floating-icon">
																	<i data-eva="people-outline"></i>
																</div>
															</div>

															<div class="form-floating form-floating-custom mb-4 auth-pass-inputgroup">
																<input type="password" class="form-control form-pe   @error('password') is-invalid @enderror" name="password"
																	id="password-input" placeholder="Enter Password">
																@error('password')
																	<span class="invalid-feedback" role="alert">
																		<strong>{{ $message }}</strong>
																	</span>
																@enderror
																<button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
																	<i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
																</button>
																<label for="input-password">Clave</label>
																<div class="form-floating-icon">
																	<i data-feather="lock"></i>
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

														<form action="{{route('login.button')}}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="modo" value="reservar">
                                                            <input type="hidden" name="email" class="email-b" id="email-reservar" value="">
                                                            <input type="hidden" name="password" class="password-b" id="password-reservar" value="">
                                                            <div class="mb-3">
                                                                <button class="btn btn-dark w-100 waves-effect waves-light" type="submit" >Reservar</button>
                                                            </div>
                                                        </form>

                                                        <form action="{{route('login.button')}}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="modo" value="calendario">
                                                            <input type="hidden" name="email" class="email-b" id="email-calendario" value="">
                                                            <input type="hidden" name="password" class="password-b" id="password-calendario" value="">
                                                            <div class="mb-3">
                                                                <button class="btn btn-success w-100 waves-effect waves-light" type="submit" >Calendario</button>
                                                            </div>
                                                        </form>

                                                        <form action="{{route('login.button')}}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="modo" value="administrar">
                                                            <input type="hidden" name="email" class="email-b" id="email-administrar" value="">
                                                            <input type="hidden" name="password" class="password-b" id="password-administrar" value="">
                                                            <div class="mb-3">
                                                                <button class="btn w-100 waves-effect waves-dark" type="submit"
                                                                    style="background-color:#2F96B4;color:#fff;" >Administrar</button>
                                                            </div>
                                                        </form>

                                                        <form action="{{route('login.button')}}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="modo" value="giftcard">
                                                            <input type="hidden" name="email" class="email-b" id="email-administrar" value="">
                                                            <input type="hidden" name="password" class="password-b" id="password-administrar" value="">
                                                            <div class="mb-3">
                                                                <button class="btn w-100 waves-effect waves-light" style="background-color: #E6E6E6;" type="submit" >
                                                                    Giftcard
                                                                </button>
                                                             </div>
                                                        </form>

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
        <script src="{{url('assets/js/app/login/login.js')}}"></script>
		<script src="assets/js/pages/pass-addon.init.js"></script>
		<script src="assets/js/pages/eva-icon.init.js"></script>
	@endsection
