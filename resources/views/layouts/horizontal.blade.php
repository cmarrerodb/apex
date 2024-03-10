<header class="ishorizontal-topbar">
	<div class="navbar-header">
		<div class="d-flex">
			<div class="navbar-brand-box">
				<a href="/" class="logo logo-light">
					<span class="logo-sm">
						<img src="{{ URL::asset('assets/images/barrica-light.png') }}" alt="" height="33">
					</span>
					<span class="logo-lg">
						<img src="{{ URL::asset('assets/images/barrica-light.png') }}" alt="" height="33">
					</span>
				</a>
			</div>
			<button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item" data-bs-toggle="collapse"
				data-bs-target="#nav">
				<i class="fa fa-fw fa-bars"></i>
			</button>

			<div class="d-none d-sm-block ms-2 align-self-center">
				<h4 class="page-title">@yield('pagetitle')</h4>
			</div>
		</div>
		@if (auth()->check())
			<div class="d-flex">
				<div class="dropdown d-inline-block">
					<button type="button" class="btn header-item user text-start d-flex align-items-center"
						id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img class="rounded-circle header-profile-user" src="{{ url('assets/images/img_user_sin_foto.png') }}"
							alt="Header Avatar" title="{{ Auth::user()->name }}">
					</button>
					<div class="dropdown-menu dropdown-menu-end pt-0">
						<div class="p-3 border-bottom">
							@if(Auth::check())
								<h6 class="mb-0">{{ Auth::user()->name }}</h6>
								<p class="mb-0 font-size-11 text-muted">{{ Auth::user()->email }}</p>
							@endif
						</div>
						{{-- <a class="dropdown-item" href="contacts-profile">
							<i class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i>
							<span class="align-middle">@lang('translation.Profile')</span>
						</a>
						<a class="dropdown-item" href="auth-lock-screen">
							<i class="mdi mdi-lock text-muted font-size-16 align-middle me-1"></i>
							<span class="align-middle">@lang('translation.Lock_screen')</span>
						</a> --}}
						<a class="dropdown-item" href="{{ route('logout') }}">
							<i class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i>
							<span class="align-middle">@lang('translation.Logout')</span>
						</a>

					</div>
				</div>
			</div>
		@endif
	</div>
	@if (auth()->check())
		<div class="topnav">
			<div class="container-fluid">
				<div class="navbar navbar-expand-lg navbar-dark bg-light">
					<div class="container-fluid">
						<div class="collapse navbar-collapse" id="nav">
							<ul class="navbar-nav">
								<li class="nav-item">
									<a href="/" class="nav-link">Inicio</a>
								</li>
								@can('crear reservas')
									<li class="nav-item">
										{{-- <a href="{{ route('reservar') }}" class="nav-link destacado">Reservar</a> --}}
										<a href="{{ route('reservar.tab') }}" class="nav-link destacado" target="_blank">Reservar</a>
										{{-- Aun no esta listo la parte de la modal --}}
										{{-- <a href="{{ route('root') }}#mdl-crear-vreserva" class="nav-link destacado">Reservar</a> --}}
									</li>
								@endcan
								@can('ver calendario')
									<li class="nav-item">
										<a href="{{ route('calendario') }}" class="nav-link">Calendario</a>
									</li>
								@endcan
								<li class="nav-item dropdown">
									<a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Administrar</a>
									<ul class="dropdown-menu submenu">
                                        @can('ver administrar')
                                            {{-- <li><a href="{{ route('administrar') }}" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#mdl-permiso-administracion">Administrar</a></li> --}}
											<li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#mdl-permiso-administracion">Administrar</a></li>
											<li><a href="#" class="dropdown-item shortcut_sw" data-estado="9" data-bs-toggle="modal" data-bs-target="#mdl-permiso-administracion">
												Administrar - Solicitud web</a>
											</li>											
                                        @endcan
										{{-- <li><a href="{{ route('reservar.listado') }}" class="dropdown-item">Listado Reservas</a></li> --}}
										@can('ver extras')
                                            <li><a href="{{ route('reservar.extras') }}" class="dropdown-item">Extras</a></li>
                                        @endcan
										@can('ver configuraciones automaticas')
                                            <li><a href="/confirmaciones" class="dropdown-item" data-key="t-confirmacion">Confirmaciones Automáticas</a></li>
                                        @endcan
										@can('ver bloqueos')
											<li><a href="{{ route('reservar.bloqueos') }}" class="dropdown-item" data-key="t-bloqueos">Bloqueos</a></li>	
										@endcan										
                                        
                                        @can('ver historial')
										    <li><a href="{{ route('reservar.historial') }}" class="dropdown-item">Historial</a></li>
                                        @endcan
									</ul>
								</li>
								<li class="nav-item dropdown">
									<a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Configurar</a>
									<ul class="dropdown-menu">

                                        @can('ver configuraciones globales')
                                            <li><a href="{{route('configuracion_global.index')}}" class="dropdown-item">Configuraciones Globales</a></li>
                                        @endcan

                                        @can('ver configuraciones automaticas')
										    {{-- <li><a href="/confirmaciones" class="dropdown-item">Confirmaciones Automáticas</a></li> --}}
                                        @endcan

                                        @can('ver sucursales')
										    <li><a href="{{ route('reservas.sucursales') }}" class="dropdown-item">Sucursales</a></li>
                                        @endcan

                                        @can('ver salones')
										    <li><a href="{{ route('reservas.salones') }}" class="dropdown-item">Salones</a></li>
                                        @endcan

                                        @can('ver mesas')
										    <li><a href="{{ route('reservas.mesas') }}" class="dropdown-item">Mesas</a></li>
                                        @endcan

                                        @can('ver tipos de reservas')
										    <li><a href="/reservas/tipos" class="dropdown-item">Tipos de Reservas</a></li>
                                        @endcan
										{{-- <hr class="dropdown-divider" /> --}}
                                        @can('ver razones cancelacion')
										    <li><a href="/reservas/razones" class="dropdown-item">Razones Cancelación</a></li>
                                        @endcan

                                        @can('ver email enviados')
                                            <li><a href="{{route('email.enviados')}}" class="dropdown-item">Email Enviados</a>
                                        @endcan

                                        @can('ver roles')
										    <li><a href="/roles" class="dropdown-item">Roles</a></li>
                                        @endcan
                                        @can('ver permisos')
										    <li><a href="/permisos" class="dropdown-item">Permisos</a></li>
                                        @endcan

                                        @can('asignar permisos')
										    <li><a href="{{route('asignar_permisos_rol.index')}}" class="dropdown-item">Asignar Permisos a Rol</a></li>
                                        @endcan

                                        @can('ver usuarios')
                                            <li><a href="{{ route('usuarios') }}" class="dropdown-item">Usuarios</a></li>
                                        @endcan

									</ul>
								</li>
								@can('ver giftcards')
									<li class="nav-item dropdown">
										<a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Giftcards</a>
										<ul class="dropdown-menu">
											<li><a href="{{ route('giftcard') }}" class="dropdown-item">Administrar Giftcards</a></li>
											<li><a href="{{ route('giftcard.creacion_masiva') }}" class="dropdown-item">Creación masiva</a></li>
											<li><a href="{{ route('giftcard.sincronizar') }}" class="dropdown-item">Sincronizar</a></li>
											<li><a href="{{ route('giftcard.pagos') }}" class="dropdown-item">Pagos</a></li>

										</ul>
									</li>
								@endcan								
								<li class="nav-item dropdown">
									<a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">CRM</a>
									<ul class="dropdown-menu">
										{{-- <li><a href="{{ route('crm') }}" class="dropdown-item">CRM</a></li> --}}
                                        @can('ver clientes')
										    <li><a href="{{ route('clientes') }}" class="dropdown-item">Clientes</a></li>
                                        @endcan
                                        @can('ver tipos de clientes')
										    <li><a href="{{ route('clientes.tipos') }}" class="dropdown-item">Tipos de Clientes</a></li>
                                        @endcan
                                        @can('ver categoria de clientes')
										    <li><a href="{{ route('clientes.categorias') }}" class="dropdown-item">Categorías de Clientes</a></li>
                                        @endcan
										@can('ver comensales')
											<li><a href="{{ route('comensales') }}" class="dropdown-item">Comensales</a></li>
										@endcan
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
</header>
