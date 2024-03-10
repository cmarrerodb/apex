@extends('layouts.master-without-nav')
@section('title')
	Registro Comensales
@endsection
@section('content')
   <div class="container my-3">
        <div class="mb-3">
            <a href="/" class="d-block auth-logo">
                <img src="/assets/images/logo-dark-barrica.png" alt="" height="100" class="auth-logo-dark me-start">
                <img src="/assets/images/barrica-light.png" alt="" height="100" class="auth-logo-light me-start">
            </a>
        </div>

        <div class="d-flex flex-wrap justify-content-evenly my-3">
            <div class="d-grid gap-2 col-12 col-md-4 my-3 ">
                <a class="btn btn-primary btn-lg" href="{{ route('comensales.mesa_crear') }}">Crear Mesa</a>
            </div>
            <div class="d-grid gap-2 col-12 col-md-4 my-3">
                <a class="btn btn-primary btn-lg" href="{{ route('comensales.mesa_unirse') }}">Unirse a la Mesa</a>
            </div>            
        </div>  
        
   </div>
@endsection

