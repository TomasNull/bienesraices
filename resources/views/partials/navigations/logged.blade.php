<li class="nav-item dropdown">
    <a  id="navbarDropdown"
        class="nav-link dropdown-toggle"
        href="#" role="button"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
        style="position:relative;"
    >
        <img src="{{ Auth::user()->pathAttachment() }}" alt="{{ Auth::user()->name }}" style="width:32px; height:32px; position:aboslute; top:10px; left:10px; border-radius:50%" />
        {{ Auth::user()->name }} <span class="caret"></span>
    </a>

    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a  href="{{ route('logout') }}" 
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"
            class="dropdown-item"
        >
            {{ __("Cerrar sesión") }}
        </a>

        <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
            @csrf <!-- Incluye token dentro del formulario, hace el envío de forma automática -->
        </form>
    </div>
</li>