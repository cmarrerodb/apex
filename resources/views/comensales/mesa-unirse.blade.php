@extends('layouts.master-without-nav')
@section('title')
	Registro unirme a mesa
@endsection
@section('content')
<div class="container my-3">
    <div class="mb-3">
        <a href="{{ route('comensales.registro') }}" class="d-block auth-logo">
            <img src="/assets/images/logo-dark-barrica.png" alt="" height="100" class="auth-logo-dark me-start">
            <img src="/assets/images/barrica-light.png" alt="" height="100" class="auth-logo-light me-start">
        </a>
    </div>

    <div class="card">
        <form action="{{ route('comensales.store') }}" method="POST">
            @csrf
            <div class="card-header">
                <h3>Registro de comensales unirme a mesa</h3>
            </div>
            <div class="card-body">
                <div class="row">

                    @if (Session::has('message'))
                        <div class="col-12 my-3">
                            <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                                <span>{{ session('message') }}</span>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
        
                    @if (Session::has('error_message'))
                        <div class="col-12 my-3">
                            <div class="alert alert-warning text-center" role="alert">
                                <span>{{ session('error_message') }}</span>
                            </div>
                        </div>
                    @endif 
                    <input type="hidden" name="tipo_registro" value="2">
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="parent_registro_hash" class="form-label">Código<span class="requerido">*</span></label>
                            <input type="text" class="form-control @error('parent_registro_hash') is-invalid @enderror" name="parent_registro_hash" id="parent_registro_hash" minlength="5" maxlength="6" required value="{{old('parent_registro_hash')}}" />
							<small id="helpId" class="form-text text-muted">Es importante tener el código hash para continuar</small>
							@error('parent_registro_hash')
								<div class="requerido">{{ $message }}</div>
							@enderror
                        </div>
                    </div>                    

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombres<span class="requerido">*</span></label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror " name="nombre" id="nombre" required value="{{ old('nombre') }}" />
                            @error('nombre')
                                <div class="requerido">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellidos</label>
                            <input type="text" class="form-control " name="apellido" id="apellido" value="{{ old('apellido') }}" />
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="requerido">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" required value="{{ old('email')}}" maxlength="60"/>
                            @error('email')
                                <div class="requerido">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="telefono" class="form-label">N° de Teléfono</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" maxlength="14" value="{{ old('telefono')}}"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="birth_day" class="form-label">Fecha de Nacimiento <span class="requerido">*</span></label>
                            <input type="date" class="form-control @error('birth_day') is-invalid @enderror" name="birth_day" id="birth_day" required value="{{ old('birth_day') }}" />
                            @error('birth_day')
                                <div class="requerido">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>                  
            </div>
            <div class="card-footer text-muted">
                <div class="d-flex justify-content-end">
					<a href="{{ route('comensales.registro') }}" class="btn btn-secondary mx-2">Atrás</a>
                    <button class="btn btn-primary" type="submit">Registrarme</button>                      
                </div>                
            </div>
        </form>

    </div>
</div>

@endsection