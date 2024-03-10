@extends('layouts.master')
@section('title') Gestión de Pago Resultado @endsection
@section('css') @endsection

@section('content')
    @section('pagetitle') Gestión de pago - Resultado @endsection

    <div class="container">

        <div class="card">
            <div class="card-header">
                Resultado del pago
            </div>
            <div class="card-body">
               @if ($res)               
               <div class="my-5">
                    <div class="alert  {{ $res['status']== 1 ? 'alert-success': 'alert-danger' }}  " role="alert">
                        <h4>¡ {{ $res['mensaje'] }} !</h4>
                        @if ($res['status']==1)
                            <p> <strong>Por un monto de: ${{ number_format($pago->monto, 0, '.', ',') }}</strong></p>
                        @endif
                    </div>
               </div>

               @endif
            </div>
           
        </div>   

    </div>

@endsection