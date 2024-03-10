
@extends('layouts.master')
@section('title')
    Sincronizar Giftcard
@endsection
@section('css')
@endsection
@section('content')
@section('pagetitle')
	Sincronizar Giftcard
@endsection

<div class="container my-5">
    <form method="POST" action="{{route('giftcard.get.sincronizar')}}">
        @csrf
        <input type="hidden" name="tipo" value="vista">
        <div class="d-flex  justify-content-center">
             <div class="col-md-4 my-3">
                 <div class="d-grid gap-2">
                   <button type="submit" name="" id="btn-sincroniza" class="btn btn-primary">Sincronizar Giftcards Ahora</button>
                 </div>
             </div>
        </div>
    </form>

    <div class="resultado my-5">
        @if(session()->has('respuesta'))
       

            {{-- @if (session()->get('respuesta')->respuesta !=500) --}}
                <div class="alert alert-success">                    
                    <pre>{{ print_r(session()->get('respuesta'), true) }}</pre>
                </div>
            {{-- @else
                <div class="alert alert-danger">                    
                    <p> Giftcard todavía no se ha generado, por favor espere unos minutos.<p>
                    <p>En caso que problema persista puedes escribirnos a nuestro whatsapp +56995394482</p>
                </div>
            @endif             --}}
  
        @endif
    </div>
</div>


@endsection
<script>
	var token = '{{ csrf_token() }}';
</script>
@section('script')

@endsection
