<li><a href="{{ route('profile.index')}}" class="nav-link">{{ __("Mi perfil") }}</a></li>
<li><a href="{{ route('realestates.subscribed') }}" class="nav-link">{{ __("Inmuebles guardados") }}</a></li>
<li><a href="{{ route('clients.estates') }}" class="nav-link">{{ __("Anuncios") }}</a></li>
@include('partials.navigations.logged')