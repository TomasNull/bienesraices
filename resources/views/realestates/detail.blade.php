@extends('layouts.app')

@section('content')

<h1 class="fw-300 centrar-texto">{{ $estate->name }}</h1>
<!--<img src="{{ url('/images/destacada.jpg') }}" alt="Imagen anuncio">-->
<img src="{{ $estate->pathAttachment() }}" alt="{{ $estate->name }}"/>

<main class="contenedor seccion contenido-centrado">
    <div class="resumen-propiedad">

        @include('partials.realestates.header_estate')

        @include('partials.realestates.rating', ['rating' => $estate->rating])

        @include('partials.realestates.action_button')
        <br />

        @include('partials.realestates.properties')

        @include('partials.realestates.description')

        @include('partials.realestates.related')

        @include('partials.realestates.form_review')

    </div>

    @include('partials.realestates.reviews')

</main>
    
@endsection