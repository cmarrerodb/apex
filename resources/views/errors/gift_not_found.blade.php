@extends('layouts.master-without-nav')

@section('title')
    Gifcard no encontrada
@endsection

@section('body')

<body>
@endsection
@section('content')
    <div class="my-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5 pt-5">
                        <img src='https://dataloggers.nyc3.digitaloceanspaces.com/pagos/46a0a51b176b1edd9a476d01d3596aa1bbbdf095.png' >
                        <h1 class="error-title-giftcard mt-5"><span>Giftcard no encontrada</span></h1>
                        <h4 class="text-uppercase mt-5">Esto puede deberse a varios motivos</h4>
                        <p class="font-size-15 mx-auto text-muted w-50 mt-4">
                            Aun la giftcard no ha sido generada o no existe. Puede refrescar la pagina web, para ver sí su estado cambia.
                        </p>
                        <p class="font-size-15 mx-auto text-muted w-50">Cualquier duda o consulta envíanos un mensaje a  <a href='mailto:giftcard@barrica94.cl'>giftcard@barrica94.cl</a> </p>
                        {{-- <div class="mt-5 text-center">
                            <a class="btn btn-primary waves-effect waves-light" href="index">Back to Dashboard</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- end container -->
    </div>
    <!-- end content -->
@endsection

