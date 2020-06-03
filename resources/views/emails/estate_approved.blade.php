@component('mail::message')

# {{ __("Publicación aprobada.") }}

{{ __("La publicación para el inmueble con nombre :realestate ha sido aprobada y publicada en la plataforma.", ['realestate' => $realestate->name]) }}
<img class="img-responsive" src="{{ url('storage/realestates/' . $realestate->picture) }}" alt="{{ $realestate->name }}">

@component('mail::button', ['url' => url('/realestates/' . $realestate->slug)])
    {{ __("Ir a la propiedad") }}
@endcomponent

{{ __("Gracias") }},<br>
{{ config('app.name') }}
    
@endcomponent