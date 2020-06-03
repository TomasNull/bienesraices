@component('mail::message')

# {{ __("Publicación rechazada.") }}

{{ __("La publicación para el inmueble con nombre :realestate ha sido rechazada.", ['realestate' => $realestate->name]) }}
{{ __("Comuníquese con el administrador para más detalles.") }}
<img class="img-responsive" src="{{ url('storage/realestates/' . $realestate->picture) }}" alt="{{ $realestate->name }}">

@component('mail:button', ['url' = > url('/')])
    {{ __("Ir a :app", ['app' => env('APP_NAME')]) }}
@endcomponent

{{ __("Gracias") }},<br>
{{ config('app.name') }}
    
@endcomponent