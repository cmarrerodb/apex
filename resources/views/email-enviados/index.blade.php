@extends('layouts.master')
@section('title')
Gestión de Email Enviados
@endsection
@section('css')
@endsection
@section('content')
@section('pagetitle')
Email enviados
@endsection
<meta name="_token" content="{{ csrf_token() }}">
<div class="uper d-sm-none">
    <div class="card card-header">
        Gestión de Email enviados
    </div>
</div>
<div class="row">
    <div class="col-12">
        <h5 class="my-3">Filtros</h5>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            <label for="startDate" class="form-label">Fecha Desde </label>
            <input type="date" class="form-control" name="startDate" id="startDate" aria-describedby="helpId"
                placeholder="">
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            <label for="endDate" class="form-label">Fecha Hasta </label>
            <input type="date" class="form-control" name="endDate" id="endDate" aria-describedby="helpId"
                placeholder="">
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            <label for="email" class="form-label">Email </label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="">
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            <label for="email" class="form-label">Tipo de evento </label>
            <select class="form-select " name="event" id="event">
                <option value="">Selecccione... </option>
                <option value="bounces">bounces</option>
                <option value="hardBounces">hardBounces</option>
                <option value="softBounces">softBounces</option>
                <option value="delivered">delivered</option>
                <option value="spam">spam</option>
                <option value="requests">requests</option>
                <option value="opened">opened</option>
                <option value="clicks">clicks</option>
                <option value="invalid">invalid</option>
                <option value="deferred">deferred</option>
                <option value="blocked">blocked</option>
                <option value="unsubscribed">unsubscribed</option>
                <option value="error">error</option>
                <option value="loadedByProxy">loadedByProxy</option>
            </select>
        </div>
    </div>

</div>
<div class="table-responsive mt-1">
    <table id="email_enviados_tbl" class="table table-striped" data-toggle="table" {{-- data-url="email_enviado_list"
        --}} data-id-field="id" data-unique-id="id" data-search="true" data-search-align="left" data-height="650" d
        ata-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-pagination="true"
        data-page-list="[10, 25, 50, 100, all]" data-locale="es-CL" data-icons-prefix="fas" data-icons="icons"
        data-toolbar="#sortable">
        <thead>
            <tr>
                <th data-field="email" data-sortable="true">Email</th>
                <th data-field="date" data-sortable="true">Fecha</th>
                <th data-field="event" data-sortable="true">Tipo de evento</th>
                <th data-field="subject" data-sortable="true">Asunto</th>
                <th data-field="ip" data-sortable="true">Ip</th>
                <th data-field="from" data-sortable="true">From</th>

            </tr>
        </thead>
    </table>

</div>


@endsection
<script>
    var token = '{{ csrf_token() }}';
</script>
@section('script')
<script>
    var base = "{{ url('/') }}";
</script>
<script src="{{URL::asset('/assets/js/app/comunes/tabla_init.js')}}"></script>
<script src="{{URL::asset('/assets/js/app/comunes/tabla_config.js')}}"></script>

<script src="{{ URL::asset('/assets/js/app/email-enviados/listado.js') }}"></script>
@endsection
