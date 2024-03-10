@extends('layouts.master')
@section('title')
    Calendar
@endsection
@section('content')
    @section('pagetitle')
        Calendar
    @endsection
    @section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/selectpicker/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/colorpicker/picker.css') }}">
    @endsection

    <div class="row">
        <div class="col-xl-9 px-0 px-sm-1" id='cal'>
            <div class="card  card-h-100">
                <div class="row p-2 d-flex justify-content-around" id="select-wrapper">
                    <div id="popover-content">
                    </div>
                    <div id="calendar"></div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>


@endsection

@section('script')
    <script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app/comunes/funciones.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/bootstrap-select/default-es_CL.js') }}"></script>
    <script src="{{ URL::asset('assets/js/fullcalendar.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/selectpicker/bootstrap-select.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app/calendario/index-2.js') }}"></script>
    <script src="{{ URL::asset('assets/js/colorpicker/picker.js') }}"></script>
    <script>
        var currentRoute = $('#current_route').val();
    </script>
    <script>
        @if (Session::has('message'))
            var icon = '{{ session('message.success') }}';
            var mensaje = '{{ session('message.msg') }}';
            Swal.fire({
                title: 'Mensaje',
                text: mensaje,
                icon: icon,
                timer: 2000,
                timerProgressBar: true
            });
        @endif
        var base = "{{ url('/') }}";
    </script>
@endsection
    