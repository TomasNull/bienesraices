@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <h1 class="text-muted fw-300 centrar-texto">{{ __("Configurar tu perfil") }}</h1>
    <hr />

    <div class="pl-5 pr-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __("Actualiza tu imagen")}}</h3>
                    </div>

                    <div class="card-body">
                        <img class="img-profile" src="{{ $user->pathAttachment() }}" alt="{{ $user->name }}" />
                        <form 
                            method="POST"
                            action="{{ route('profile.update_picture')}}"
                            novalidate
                            enctype="multipart/form-data"
                        >
                        
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-6 offset-4">
                                    <input type="file" class="custom-file-input {{ $errors->has('picture') ? 'is-invalid' : ''}}" id="picture" name="picture" />
                                    <label for="picture" class="custom-file-label">{{ __("Selección de imagen") }}</label>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __("Actualizar imagen") }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div> 
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>{{ __("Actualiza tus datos")}}</h3>
                    </div>

                    <div class="card-body">

                        <form 
                            method="POST" 
                            action="{{ route('profile.update') }}" 
                            novalidate
                        >
                    
                            @method('PUT')
                            @csrf
                            

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">
                                    {{ __("Correo electrónico") }}
                                </label>
                                <div class="col-md-6">
                                    <input 
                                        id="email" type="email" readonly 
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : ''}}" 
                                        name="email" value="{{ old('email') ?: $user->email }}" 
                                        required autofocus
                                    />
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    for="password"
                                    class="col-md-4 col-form-label text-md-right"
                                >
                                    {{ __("Contraseña") }}
                                </label>

                                <div class="col-md-6">
                                    <input
                                        id="password"
                                        type="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password"
                                        required
                                    />

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right"
                                >
                                    {{ __("Confirma la contraseña") }}
                                </label>

                                <div class="col-md-6">
                                    <input
                                        id="password-confirm"
                                        type="password"
                                        class="form-control"
                                        name="password_confirmation"
                                        required
                                    />
                                </div>
                            </div>
                            
                            @if ($user->client)
                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">
                                    {{ __("Número telefónico") }}
                                </label>
                                <div class="col-md-6">
                                    <input 
                                        id="phone" type="phone"
                                        class="form-control{{ $errors->has('phone') ? ' is-invalid' : ''}}" 
                                        name="phone" value="{{ old('phone') ?: $user->client->phone_number }}" 
                                        required
                                    />
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endif

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __("Actualizar datos") }}
                                    </button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>

                @if ($user->agent)
                    <div class="card">
                        <div class="card-header">
                            {{ __("Administrar inmuebles") }}
                        </div>
                        <div class="card-body">
                            <a href="{{ route('agent.estates') }}" class="btn btn-secondary btn-block">
                                <i class="fa fa-leanpub"></i> {{ __("Administrar ahora") }}
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            {{ __("Mis clientes") }}
                        </div>
                        <div class="card-body">
                            <table 
                                class="table table-striped table-bordered responsive nowrap" 
                                cellspacing="0"
                                id="clients-table"
                            >
                                <thead>
                                    <tr>
                                        <th>{{ __("ID") }}</th>
                                        <th>{{ __("Nombre") }}</th>
                                        <th>{{ __("Email") }}</th>
                                        <th>{{ __("Inmuebles") }}</th>
                                        <th>{{ __("Acciones") }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                @endif

                @if ($user->socialAccount)
                    <div class="card">
                        <div class="card-header">
                            {{ __("Acceso con Socialite") }}
                        </div>
                        <div class="card-body">
                            <button class="btn btn-outline-dark btn-block">
                                {{ __("Registrado con") }}: <i class="fa fa-{{ $user->socialAccount->provider }}"></i>
                                {{ $user->socialAccount->provider }}
                            </button>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    @include('partials.modal')
@endsection

@push('scripts')

    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.4/js/dataTables.responsive.min.js"></script>
    
    <script>
        let dt;
        let modal = jQuery("#appModal");
        jQuery(document).ready(function() {
            dt = jQuery("#clients-table").DataTable({
                responsive: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 75, 100],
                processing: true,
                serverSide: true, //realiza la petición sobre el servidor
                ajax: '{{ route("agent.clients") }}',
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                },
                columns: [
                    {data: 'user.id', visible: false},
                    {data: 'user.name'},
                    {data: 'user.email'},
                    {data: 'estates_formatted'},
                    {data: 'actions'}
                ]
            });

            jQuery(document).on("click", '.btnEmail', function(e) {
                e.preventDefault();
                const id = jQuery(this).data('id');
                modal.find('.modal-title').text('{{ __("Enviar mensaje") }}');
                modal.find('#modalAction').text('{{ __("Enviar mensaje") }}').show();
                let $form = $("<form id='clientMessage'></form>");
                $form.append(`<input type="hidden" name="user_id" value="${id}" />`);
                $form.append(`<textarea class="form-control" name="message"></textarea>`);
                modal.find('.modal-body').html($form);
                modal.modal();
            });

            jQuery(document).on("click", "#modalAction", function(e) {
                jQuery.ajax({
                    url: '{{ route('agent.send_message_to_client') }}',
                    type: 'POST',
                    headers: {
                        'x-csrf-token': $("meta[name=csrf-token]").attr('content')
                    },
                    data: {
                        info: $('#clientMessage').serialize()
                    },
                    success: (res) => {
                        if(res.res) {
                            modal.find('#modalAction').hide();
                            modal.find('.modal-body').html('<div class="alert alert-success">{{ __("Mensaje enviado correctamente") }}</div>');
                        } else {
                            modal.find('.modal-body').html('<div class="alert alert-danger">{{ __("Ha ocurrido un error al enviar el mensaje") }}</div>');
                        }
                    }
                })
            })
        })
    </script>
    
@endpush