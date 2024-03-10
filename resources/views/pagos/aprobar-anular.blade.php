@extends('layouts.master')
@section('title')
    Gestión de Pago
@endsection
@section('css')
@endsection

@section('content')
@section('pagetitle')
    Gestión de pago
@endsection

<div class="container">

    <div class="card my-4">
        <form action="{{ route('proceso.pago.update') }}" method="POST">
            @csrf
            <div class="card-header">
                <h4>Aprobar o Rechazar Pago</h4>
            </div>
            <div class="card-body">

                @if(session('mensaje'))
                    <div class="alert alert-success">
                        {{ session('mensaje') }}
                    </div>
                @endif
                
                @if ($giftcard)
                   
                        <div class="d-flex flex-wrap justify-content-between my-2">
                            <div class="col-12 col-sm-5 col-md-4">
                                <p><b>Monto total del pago: </b>
                                    ${{ number_format($giftcard->pago->monto, 0, '.', '.') }} </p>
                            </div>

                            <div class="col-12 col-sm-6 col-md-5 col-lg-3">
                                <div class="d-grid gap-2">
                                    <a class="btn btn-secondary btn-sm" href="{{ $giftcard->pago->url_adjunto }}"
                                        target="_blank" role="button">Ver ultimo recibo de pago</a>
                                </div>
                            </div>
                        </div>

                        <div class="row my-3">
                            <hr>
                            <div class="col-12">
                                <p class="fw-bold">Giftcard(s) Involucrada(s):</p>
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
                                                @foreach ($gifts as $key => $gift)
                                                    <tr class="">
                                                        <td scope="row">{{ $gift->beneficiario }}</td>
                                                        <td>{{ $gift->email }}</td>
                                                        <td> $ {{ number_format($gift->new_ben_monto , 0, ',', '.') }} </td>
                                                        <td> <a href="{{ route('giftcard_check', ['codigo' => $gift->codigo]) }}"
                                                                target="_blank">Ver Giftcard QR</a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row my-3">
                            <hr>
                            <div class="col-12 col-md-5">
                                <input type="hidden" name="session_id" value="{{ $giftcard->session_id }}">
                                <label for="status_pago" class="form-label">Status de Pago: </label>
                                <select class="form-select {{ $errors->has('status_pago') ? 'is-invalid' : '' }}"
                                    name="status_pago" id="status_pago" required>
                                    <option selected value="">Seleccione ...</option>
                                    <option value="2" {{ old('status_pago') == 2 ? 'selected' : '' }}>APROBADO
                                    </option>
                                    <option value="4" {{ old('status_pago') == 4 ? 'selected' : '' }}>RECHAZADO
                                    </option>
                                </select>
                                @error('status_pago')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-7">
                                <label for="observaciones" class="form-label">Observaciones:</label>
                                <textarea class="form-control" name="observaciones" id="observaciones" rows="3">{{ old('observaciones') }}</textarea>
                            </div>
                        </div>
                   
                @endif
            </div>

            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Guardar Proceso de pago</button>
            </div>
        </form>
    </div>

</div>







@endsection
