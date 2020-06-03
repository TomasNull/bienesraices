@extends('layouts.app')

@section('content')
<h1 class="text-muted fw-300 centrar-texto">{{ __("Administrar tus inmuebles") }}</h1>
<hr />

<div class="pl-5 pr-5">
    <div class="row justify-content-center">
        @forelse($estates as $estate)
            <div class="col-md-8 offset-2 listing-block">
                <div class="media" style="height: 200px;">
                    <img 
                        style="height: 200px; width: 300px;"
                        class="img-rounded"
                        src="{{ $estate->pathAttachment() }}" alt="{{ $estate->name }}"
                    />

                    <div class="media-body pl-3" style="height: 200px;">
                        <div class="price">
                            <small class="badge-yellow text-white text-center">
                                {{ $estate->category->name }}
                            </small>
                            <small>{{ __("Inmueble") }}: {{ $estate->name }} </small>
                            <small>{{ __("Clientes") }}: {{ $estate->clients_count }} </small>
                        </div>

                        <div class="stats">
                            {{ $estate->created_at->format('d/m/Y') }}
                            @include('partials.realestates.rating', ['rating' => $estate->rating])
                        </div>

                        @include('partials.realestates.agent_action_button')
                    </div>
                </div>
            </div>
            
        @empty
            <div class="alert alert-dark">
                {{ __("No tienes ningún inmueble asignado") }}<br />
                <a class="btn btn-course btn-block" href="{{ route('realestates.create') }}">
                    {{ __("Crear publicación") }}
                </a>
            </div>
        @endforelse
    </div>

    <div class="row justify-content-center">
        {{ $estates->links() }}
    </div>
</div>
@endsection