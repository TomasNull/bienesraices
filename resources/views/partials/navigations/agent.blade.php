<li><a href="{{ route('profile.index')}}" class="nav-link">{{ __("Mi perfil") }}</a></li>
<li><a href="{{ route('agent.estates')}}" class="nav-link">{{ __("Mis inmuebles") }}</a></li>
<li><a href="{{ route('realestates.create')}}" class="nav-link">{{ __("Crear publicación") }}</a></li>
@include('partials.navigations.logged')