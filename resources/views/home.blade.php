@extends('layouts.app')

@section('content')

@include('partials.others.aboutus')
<div class="pl-5 pr-5">
    <h2 class="fw-300 centrar-texto">{{ __("Casas y Deptos en Venta") }}</h2>
    <div class="contenedor-anuncios">
        @forelse($realestate as $estate)
            <div class="anuncio">
                @include('partials.realestates.card_realestate')
            </div>
            
        @empty
            <div class="alert alert-dark">
                {{ __("No hay ningún inmueble disponible") }}
            </div>
        @endforelse
    </div>

    <div class="row justify-content-center">
        {{ $realestate->links() }}
    </div>
</div>
@include('partials.others.contact')

@include('partials.others.inferior')

@endsection


