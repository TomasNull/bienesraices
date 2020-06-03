<div class="col-12 pt-0 mt-4">
    <h2 class="text-muted">
        {{ __("Inmuebles similares") }}
    </h2>
    <hr />
</div>
<div class="container-fluid">
    <div class="row">
        @forelse ($related as $relatedEstate)
            <div class="col-md-6 listing-block">
                <div class="media">
                    <div class="fav-box">
                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                    </div>
                    <a href="{{ route('realestates.detail', $relatedEstate->slug) }}">
                        <img 
                            class="d-flex align-sefl-start"    
                            src="{{ $relatedEstate->pathAttachment() }}"
                            alt="{{ $relatedEstate->name }}">
                    </a>
                    <div class="media-body pl-3">
                        <div class="price">
                            <small>{{ \Illuminate\Support\Str::limit($relatedEstate->name, 30) }}</small>
                        </div>
                        <div class="stats">
                            @include('partials.realestates.rating', ['rating' => $relatedEstate->rating])
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-dark">
                {{ __("No existe ningún inmueble relacionado") }}
            </div>
        @endforelse
    </div>
</div>