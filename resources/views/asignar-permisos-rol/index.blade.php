@extends('layouts.master')
@section('title')
Gestión Asignar Permisos a Roles
@endsection
@section('css')
@endsection
@section('content')
@section('pagetitle')
Asignar Permisos a Roles
@endsection
<meta name="_token" content="{{ csrf_token() }}">
<div class="uper d-sm-none">
    <div class="card card-header">
        Gestión Asignar Permisos a Roles
    </div>
</div>
<div class="row">
    <div class="col-12 my-4">
        <div class="card">

            <div class="card-body">
                <h2 class="card-title my-2">Asignar Permisos a Roles</h2>
                <form action="" id="formdata" method="POST">

                    <div class="row">
                        <div class="col-md-5 my-3">
                            <label for="" class="form-label">Seleccione el Rol</label>
                            <select class="form-select" name="rol" id="rol">
                                <option value="">Seleccione..</option>
                                @if (count($roles)>0)
                                @foreach ($roles as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div id="permisos-roles">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-check my-3">
                                            <input class="form-check-input " type="checkbox" id="permisos_toggle"
                                                disabled>
                                            <label class="form-check-label" for="permisos_toggle">
                                                SELECCIONAR TODOS
                                            </label>
                                        </div>
                                        <hr>
                                    </div>

                                    @if (count($result_permisos)>0)

                                        @foreach ($result_permisos as $categoria => $elementos)

                                            <div class="col-sm-6 col-md-4 mb-3">
                                                <label for=""><h5>{{ucfirst($categoria)}}</h5></label>
                                                <br>
                                                @foreach ($elementos as $key=> $item)
                                                    <div class="form-check">
                                                        <input class="form-check-input permisos_list" type="checkbox"
                                                            name="permisos[]" value="{{$item}}" id="permiso_{{str_replace(" ", "_",$categoria) .'_'.$key}}" disabled>
                                                        <label class="form-check-label" for="permiso_{{str_replace(" ", "_",$categoria) .'_'.$key}}">
                                                            {{$item}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    @endif

                                </div>

                                <div class="row">
                                    <div class="d-flex justify-content-end">
                                        <button type="button" name="" id="btn-guardar" class="btn btn-primary btn-guardar px-4" disabled>Guardar</button>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>


    </div>

</div>

@endsection
<script>
    var token = '{{ csrf_token() }}';
</script>
@section('script')
<script>
    var base = "{{ url('/') }}";
</script>

<script src="{{ URL::asset('/assets/js/app/asignar-permisos-rol/index.js') }}"></script>


@endsection
