@extends('layouts.master-without-nav')
@section('title')
	@lang('translation.Login')
@endsection
@section('content')
   <div class="container my-3">
        <div class="mb-3">
            <a href="#" class="d-block auth-logo">
                <img src="/assets/images/logo-dark-barrica.png" alt="" height="100" class="auth-logo-dark me-start">
                <img src="/assets/images/barrica-light.png" alt="" height="100" class="auth-logo-light me-start">
            </a>
        </div>

        <div class="card">
            <form action="{{ route('comensales.store') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h3>Registro de comensales</h3>
                </div>
                <div class="card-body">
                    <div class="row">

                        @if (Session::has('message'))
                            <div class="col-12 my-3">
                                <div class="alert alert-success text-center" role="alert">
                                    <span>{{ session('message') }}</span>
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
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="parent_id" class="form-label">N° de ID Asociado</label>
                                <input type="number" class="form-control" name="parent_id" id="parent_id" value="{{ old('parent_id') }}"/>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="reserva_id" class="form-label">N° de Reserva</label>
                                <input type="number" class="form-control" name="reserva_id" id="reserva_id" value="{{ old('reserva_id') }}"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="mesa_id" class="form-label">N° de mesa</label>
                                <select class="form-select " name="mesa_id" id="mesa_id" >
                                    <option value="">Selecione...</option>
                                    @if (count($mesas)>0)
                                        @foreach ($mesas as $item)
                                            <option {{  old('mesa_id')== $item->id?'selected':"" }}  value="{{ $item->id }}">{{ $item->mesa }}</option>                                            
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div> 
                        
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="cuenta_id" class="form-label">N° de Cuenta</label>
                                <input type="number" class="form-control" name="cuenta_id" id="cuenta_id" value="{{old('cuenta_id')}}" />
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre y Apellido <span class="requerido">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror " name="nombre" id="nombre" value="{{ old('name') }}" />
                                @error('name')
                                    <div class="requerido">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="requerido">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email')}}" maxlength="30"/>
                                @error('email')
                                    <div class="requerido">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="telefono" class="form-label">N° de Teléfono</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" maxlength="14" value="{{ old('telefono')}}"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="birth_day" class="form-label">Fecha de Nacimiento <span class="requerido">*</span></label>
                                <input type="date" class="form-control @error('birth_day') is-invalid @enderror" name="birth_day" id="birth_day" value="{{ old('birth_day') }}" />
                                @error('birth_day')
                                    <div class="requerido">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>                  
                </div>
                <div class="card-footer text-muted">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Registrarme</button>                      
                    </div>                
                </div>
            </form>

        </div>
   </div>
@endsection

