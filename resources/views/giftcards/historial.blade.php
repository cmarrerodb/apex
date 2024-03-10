@extends('layouts.master')
@section('title')
    Hitorial de Giftcard
@endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}">
@endsection

@section('content')

    @section('pagetitle')
        Historial de Giftcard
    @endsection

    <div class="container">
        
        <div class="card my-4">
            <div class="card-header">
             <h4 class="card-title">Giftcard codigo: {{ $gift->codigo }}</h4>
            </div>
            <div class="card-body">
                <h4 class="card-title">Datos de la Giftcard:</h4>
                <div class="d-flex justify-content-between flex-wrap my-4 border-bottom border-top">
                    <div class="py-2">
                        <p> <b>Nombre del beneficiario:</b> {{ $gift->beneficiario }}</p>
                    </div>
                    <div class="py-2 px-1">
                        <p> <b>Email:</b> {{ $gift->email }}</p>
                    </div>
                    <div class="py-2">
                        <p><b>Monto:</b> {{ $gift->format_monto}}</p>
                    </div>
                </div>   

                <div class="my-4">
                    <h4 class="card-title my-4">Historial:</h4>   

                    @if (count($gift->historial)>0)
                    
                        <ul class="verti-timeline list-unstyled">
    
                            @foreach ($gift->historial as $item)
    
                                <li class="event-list">
                                    <div class="event-timeline-dot">
                                        <i class="bx bx-right-arrow-circle"></i>
                                    </div>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <i class="bx bx-copy-alt h4 text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div>
                                                <h5>{{ $item->descripcion }}</h5>
                                                <div class="row text-muted mb-0">
                                                    <div class="col-12 col-sm-3">
                                                        <b>Fecha:</b> {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
                                                    </div>
                                                    <div class="col-12 col-sm-3">
                                                        <b>Hora:</b> {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}
    
                                                    </div>
                                                </div>
            
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                
                            @endforeach
                        </ul>
                    @endif

                </div>  
            </div>
            {{-- <div class="card-footer text-muted">
                Footer
            </div> --}}
        </div>

    </div>

@endsection

@section('script')

    <script src="{{ URL::asset('assets/libs/swiper/swiper.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/timeline.init.js') }}"></script>

@endsection
