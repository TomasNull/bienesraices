<div class="col-12 pt-0 mt-0">
    <h2 class="text-muted">{{ __("Características del inmueble")}}</h2>
    <hr />
</div>

<ul class="iconos-caracteristicas">
    <li>
        <img src="{{ url('/images/icono_wc.svg') }}" alt="icono wc">
        <p>{{ $estate->bathrooms }}</p>
    </li>
    <li>
        <img src="{{ url('/images/icono_estacionamiento.svg') }}" alt="icono autos">
        <p>{{ $estate->garage }}</p>
    </li>
    <li>
        <img src="{{ url('/images/icono_dormitorio.svg') }}" alt="icono habitaciones">
        <p>{{ $estate->bedrooms }}</p>
    </li>
</ul>

<div class="col-6">
    <div class="card bg-light p-3">
        <p class='mb-0'>{{ __("Nueva construcción") }}: {{ $estate->new_construct == 1 ? 'SI' : 'NO' }} </p>
    </div>
</div>
<div class="col-6">
    <div class="card bg-light p-3">
        <p class='mb-0'>{{ __("Patio") }}: {{ $estate->yard == 1 ? 'SI' : 'NO' }} </p>
    </div>
</div>
<div class="col-6">
    <div class="card bg-light p-3">
        <p class='mb-0'>{{ __("Piscina") }}: {{ $estate->pool == 1 ? 'SI' : 'NO' }} </p>
    </div>
</div>
