@extends('layouts.app')

@section('content')

<div class="pl-5 pr-5">
    <h1 class="text-muted fw-300 centrar-texto">{{ __("Administrar inmuebles") }}</h1>
    <hr />

    <estates-list
        :labels="{{ json_encode([
            'name' => __("Nombre"),
            'status' => __("Estado"),
            'activate_deactivate' => __("Activar / Desactivar"),
            'approve' => __("Aprobar"),
            'reject' => __("Rechazar")
        ]) }}"
        route="{{ route('admin.realestates_json') }}"
    >
    </estates-list>
</div>

@endsection