<div class="btn-group">
    @if((int) $estate->status === \App\RealEstate::PUBLISHED)
        <a href="{{ route('realestates.detail', $estate->slug) }}" class="btn btn-course">
            <i class="fa fa-eye"></i>{{ __("Detalle")}}
        </a>

        <a href="{{ route('realestates.edit', $estate->slug) }}" class="btn btn-warning text-white">
            <i class="fa fa-pencil"></i>{{ __("Editar")}}
        </a>

        @include('partials.realestates.btn_forms.delete')
    @elseif((int) $estate->status === \App\RealEstate::PENDING)
        <a href="" class="btn btn-primary text-white">
            <i class="fa fa-history"></i>{{ __("Pendiente de revisión")}}
        </a>

        <a href="{{ route('realestates.detail', $estate->slug) }}" class="btn btn-course">
            <i class="fa fa-eye"></i>{{ __("Detalle")}}
        </a>

        <a href="{{ route('realestates.edit', $estate->slug) }}" class="btn btn-warning text-white">
            <i class="fa fa-pencil"></i>{{ __("Editar")}}
        </a>

        @include('partials.realestates.btn_forms.delete')
    @else
        <a href="#" class="btn btn-danger text-white">
            <i class="fa fa-pause"></i>{{ __("Publicación rechazada")}}
        </a>

        <a href="{{ route('realestates.edit', $estate->slug) }}" class="btn btn-warning text-white">
            <i class="fa fa-pencil"></i>{{ __("Editar")}}
        </a>

        @include('partials.realestates.btn_forms.delete')
    @endif
</div>