<div class="col-2">
    @auth
        @can('follow_estate', $estate)
            @can('inscribed', $estate)
                <a class="btn btn-subscribe btn-bottom btn-follow" href="{{ route('realestates.inscribe', ['estate' => $estate->slug])}}">
                    <i class="fa fa-bolt"></i> {{ __("Seguir") }}
                </a>
            @else
                <a href="#" class="btn btn-subscribe btn-bottom btn-follow">
                    <i class="fa fa-bolt"></i> {{ __("Siguiendo") }}
                </a>
            @endcan
        @else
            <a href="#" class="btn btn-subscribe btn-bottom btn-follow">
                <i class="fa fa-user"></i> {{ __("Gestionar") }}
            </a>
        @endcan
    @else
        <a href="{{ route('login') }}" class="btn btn-subscribe btn-bottom btn-follow">
            <i class="fa fa-user"></i> {{ __("Acceder") }}
        </a>
    @endauth

</div>