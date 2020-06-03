@extends('layouts.app')


@section('content')

<h1 class="text-muted fw-300 centrar-texto">{{ __("Listado de inmuebles guardados") }}</h1>
<hr />
    <div class="pl-5 pr-5">
        <div class="row justify-content-center">
            @forelse ($estates as $estate)
                <div class="col-md-3">
                    @include('partials.realestates.card_realestate')
                </div>
            @empty
                <div class="alert alert-dark">
                    {{ __("No tienes ningún inmueble guardado") }}
                </div>
            @endforelse
        </div>
    </div>
    
@endsection