<header class="ishorizontal-topbar">
	<div class="navbar-header">
		<div class="d-flex">
			<div class="navbar-brand-box">
				<a href="index" class="logo logo-light">
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

		<div class="d-flex">
			<div class="dropdown d-inline-block">
				<button type="button" class="btn header-item user text-start d-flex align-items-center"
					id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					{{-- <img class="rounded-circle header-profile-user" src="{{ URL::asset('assets/images/users/avatar-1.jpg') }}"
						alt="Header Avatar" title="Jennifer Bennett"> --}}
				</button>
				<div class="dropdown-menu dropdown-menu-end pt-0">
					<div class="p-3 border-bottom">
						<h6 class="mb-0">Jennifer Bennett</h6>
						<p class="mb-0 font-size-11 text-muted">jennifer.bennett@email.com</p>
					</div>
					<a class="dropdown-item" href="contacts-profile"><i
							class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i><span
							class="align-middle">@lang('translation.Profile')</span></a>
					<a class="dropdown-item" href="auth-lock-screen"><i
							class="mdi mdi-lock text-muted font-size-16 align-middle me-1"></i><span
							class="align-middle">@lang('translation.Lock_screen')</span></a>
					<a class="dropdown-item" href="{{ route('logout') }}"><i
							class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i><span
							class="align-middle">@lang('translation.Logout')</span></a>
				</div>
			</div>
		</div>
	</div>
</header>
