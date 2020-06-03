@component('mail::message')
# {{ __("¡Un nuevo cliente sigue la propiedad!")}}

{{ __("El cliente :client se ha interesado por la propiedad :estate.", ['client' => $client, 'estate' => $estate->name]) }}
<br>
{{ __("Ponte en contacto para determinar sus opciones.") }}
<br>
<img class="img-responsive" src="#" alt="{{ $estate->name }}">

@component('mail::button', ['url' => url('/realestates/' . $estate->slug)])
    {{ __("Ir a la propiedad") }}
@endcomponent

{{ __("Gracias") }},<br>
{{ config('app.name') }}

@endcomponent