@extends('layouts.master')
@section('title') Gestión de Pago Existente @endsection
@section('css') @endsection

@section('content')
    @section('pagetitle') Gestión de pago - Existente @endsection

    <div class="container">

        <div class="card my-4">
            <div class="card-header">
                Resultado del pago
                
            </div>
            <div class="card-body">
                      
               <div class="my-5">
                    <div class="alert  alert-success" role="alert">
                        <h4>Ya existe un pago para esta(s) giftcard(s) y se encuentra en estado PAGADA</h4>                       
                    </div>
               </div>
               
            </div>
           
        </div>   

    </div>

@endsection