<div class="card card-01">
    <img
        class="card-img-top"
        src="{{ $estate->pathAttachment() }}"
        alt="{{ $estate->name }}"
    />

    <div class="card-body">
        <h3 class="card-title">{{ \Illuminate\Support\Str::limit($estate->name, 30) }}</h3>
        <hr />
        <div class="row justify-content-center">
            @include('partials.realestates.rating', ['rating' => $estate->rating])
        </div>
        <hr />
        <div class="cotnenido-anuncio">
            <span class="badge badge-cat badge-yellow">{{ $estate->category->name }}</span>
            <p class="card-text">
                {{ \Illuminate\Support\Str::limit($estate->description, 50) }}
            </p>
            <p class="precio">{{ number_format($estate->price, 2, ',', '.') }} €</p>
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
            <a href="{{ route('realestates.detail', $estate->slug) }}" class="boton boton-amarillo d-block">Ver Propiedad</a>
        </div>
    </div>
</div>