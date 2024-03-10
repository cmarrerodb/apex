@extends('layouts.master')
@section('title') Gestión de Pago nuevo pago @endsection
@section('css') @endsection

@section('content')
    @section('pagetitle') Gestión de pago nuevo pago @endsection

<div class="container">

    <div class="card my-4">
        <form action="{{ route('proceso.pago.store') }}" method="POST" enctype="multipart/form-data" >
            @csrf
            <div class="card-header">
                <h4>Crear Pago</h4>
            </div>
            <div class="card-body">
                @if ($giftcard)

                    <div class="row my-3">
                        <hr>
                        <div class="col-12">
                            <p class="fw-bold">Gifcard(s) Involucrada(s):</p>
                            @if (count($gifts))
                                <div class="table-responsive">
                                    <table class="table table-primary">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Monto del beneficio</th>
                                                <th scope="col">Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total=0;
                                            @endphp
                                            @foreach ($gifts as $key => $gift)
                                                <tr class="">
                                                    <td scope="row">{{ $gift->beneficiario }}</td>
                                                    <td>{{ $gift->email }}</td>
                                                    <td> $ {{ number_format($gift->new_ben_monto , 0, ',', '.') }}</td>
                                                    <td>
                                                        <a href="{{ route('giftcard_check', ['codigo' => $gift->codigo]) }}" target="_blank">Ver Giftcard QR</a>
                                                    </td>
                                                </tr>
                                                @php
                                                    $total+= $gift->new_ben_monto
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row my-3">
                        <hr>
                        <div class="col-12 col-md-6">
                            <label for="">Monto Total</label>   
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon3">$</span>
                                <input type="text" class="form-control" name="monto_total" id="monto_total" value="{{ $total }}" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="hidden" name="session_id" value="{{ $giftcard->session_id }}">

                            <div class="mb-3">
                                <label for="" class="form-label">Forma Pago: <span class="requerido">*</span></label>
                                <select class="form-select list-forma-pago" name="forma_pago" id="forma_pago" required>
                                    <option value="">SELECCIONE ...</option>
                                    @if (count($forma_pagos))
                                        @foreach ($forma_pagos as $forma_pago)
                                            <option value="{{ $forma_pago->id }}" {{ old('forma_pago', $giftcard->forma_pago_id ) == $forma_pago->id ?'selected':'' }} >
                                                {{ $forma_pago->forma_pago }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                 
                        <div class="col-12 col-md-6 adjunto_pago_html">
                            <label for="adjunto_pago">Recibo de pago: <span class="requerido">*</span></label>
                            <input type="file" class="form-control" name="adjunto_pago" id="adjunto_pago" >
                        </div>
                    </div>
                    
                @endif
            </div>

            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

@endsection

<script>
    var token = '{{ csrf_token() }}';
</script>
@section('script')

<script src="{{ URL::asset('/assets/js/app/pagos/create.js') }}"></script>
@endsection