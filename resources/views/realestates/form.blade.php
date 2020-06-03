@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <h1 class="text-muted fw-300 centrar-texto">{{ __("Dar de alta un nuevo inmueble") }}</h1>
    <hr />

    <div class="pl-5 pr-5">
        <form 
            method="POST"
            action="{{ ! $estate->id ? route('realestates.store') : route('realestates.update', [$estate->slug])}}"
            novalidate
            enctype="multipart/form-data"
        >
            @if ($estate->id)
                @method('PUT')
            @endif

            @csrf

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            {{ __("Información del inmueble")}}
                        </div>
                        
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">
                                    {{ __("Nombre del inmueble")}}
                                </label>
                                <div class="col-md-6">
                                    <input 
                                        name="name" 
                                        id="name" 
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" 
                                        value="{{ old('name') ?: $estate->name}}"
                                        required
                                        autofocus
                                    />

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status_estate" class="col-md-4 col-form-label text-md-right">
                                    {{ __("Venta o Alquiler")}}
                                </label>
                                <div class="col-md-6">
                                    <select name="status_estate" id="status_estate" clase="form-control">
                                        <option {{ (int) old('status_estate') === 2 ? 'selected' : '' }} value="2">{{ __("Pendiente") }}</option>
                                        <option {{ (int) old('status_estate') === 4 ? 'selected' : '' }} value="4">{{ __("Alquiler") }}</option>
                                        <option {{ (int) old('status_estate') === 5 ? 'selected' : '' }} value="5">{{ __("Venta") }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status_estate" class="col-md-4 col-form-label text-md-right">
                                    {{ __("Categoría del inmueble")}}
                                </label>
                                <div class="col-md-6">
                                    <select name="category_id" id="category_id" clase="form-control">
                                        @foreach (\App\Category::groupBy('name')->pluck('name', 'id') as $id => $category)
                                            <option {{ (int) old('category_id') === $id || $estate->category_id === $id ? 'selected' : ''}} value="{{ $id }}">
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
    
                            <div class="form-group ml-3 mr-2">
                                <div class="col-md-6 offset-4">
                                    <input type="file" class="custom-file-input {{ $errors->has('picture') ? 'is-invalid' : ''}}" id="picture" name="picture" />
                                    <label for="picture" class="custom-file-label">{{ __("Selección de imagen") }}</label>
                                </div>
                            </div>
    
                            <div class="for-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">
                                    {{ __("Descripción del inmueble") }}
                                </label>
                                <div class="col-md-6">
                                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : ''}}" name="description" id="description" rows="8" required>
                                        {{ old('description') ?: $estate->description }}
                                    </textarea>
    
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __("Caracterícisticas del inmueble") }}</div>
                        
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">
                                    {{ __("Dirección")}}
                                </label>
                                <div class="col-md-6">
                                    <input name="address" id="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : ''}}" 
                                        value="{{ old('address') ?: $estate->address}}" required />

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="city" class="col-md-4 col-form-label text-md-right">
                                    {{ __("Ciudad")}}
                                </label>
                                <div class="col-md-6">
                                    <input name="city" id="city" class="form-control {{ $errors->has('city') ? 'is-invalid' : ''}}" 
                                        value="{{ old('city') ?: $estate->city}}" required />

                                    @if ($errors->has('city'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="country" class="col-md-4 col-form-label text-md-right">
                                    {{ __("País")}}
                                </label>
                                <div class="col-md-6">
                                    <input name="country" id="country" class="form-control {{ $errors->has('country') ? 'is-invalid' : ''}}" 
                                        value="{{ old('country') ?: $estate->country}}" required />

                                    @if ($errors->has('country'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('country') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-md-4 col-form-label text-md-right">
                                    {{ __("Precio")}}
                                </label>
                                <div class="col-md-6">
                                    <input name="price" id="price" class="form-control {{ $errors->has('price') ? 'is-invalid' : ''}}" 
                                        value="{{ old('price') ?: $estate->price}}" required />

                                    @if ($errors->has('price'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="bedrooms" class="col-md-4 col-form-label text-md-right">
                                    {{ __("Habitaciones")}}
                                </label>
                                <div class="col-md-6">
                                    <input name="bedrooms" id="bedrooms" class="form-control {{ $errors->has('bedrooms') ? 'is-invalid' : ''}}" 
                                        value="{{ old('bedrooms') ?: $estate->bedrooms}}" required />

                                    @if ($errors->has('bedrooms'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('bedrooms') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="bathrooms" class="col-md-4 col-form-label text-md-right">
                                    {{ __("Baños")}}
                                </label>
                                <div class="col-md-6">
                                    <input name="bathrooms" id="bathrooms" class="form-control {{ $errors->has('bathrooms') ? 'is-invalid' : ''}}" 
                                        value="{{ old('bathrooms') ?: $estate->bathrooms}}" required />

                                    @if ($errors->has('bathrooms'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('bathrooms') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="yard" class="col-md-4 col-form-label text-md-right">
                                    {{ __("Patio")}}
                                </label>
                                <div class="col-md-6">
                                    <select name="yard" id="yard" clase="form-control">
                                        <option {{ (int) old('yard') === 0 ? 'selected' : '' }} value="0">No</option>
                                        <option {{ (int) old('yard') === 1 ? 'selected' : '' }} value="1">Si</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pool" class="col-md-4 col-form-label text-md-right">
                                    {{ __("Piscina")}}
                                </label>
                                <div class="col-md-6">
                                    <select name="pool" id="pool" clase="form-control">
                                        <option {{ (int) old('pool') === 0 ? 'selected' : '' }} value="0">No</option>
                                        <option {{ (int) old('pool') === 0 ? 'selected' : '' }} value="1">Si</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="garage" class="col-md-4 col-form-label text-md-right">
                                    {{ __("Garaje/Plaza de aparcamiento")}}
                                </label>
                                <div class="col-md-6">
                                    <select name="garage" id="garage" clase="form-control">
                                        <option {{ (int) old('garage') === 0 ? 'selected' : '' }} value="0">No</option>
                                        <option {{ (int) old('garage') === 0 ? 'selected' : '' }} value="1">Si</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new_construct" class="col-md-4 col-form-label text-md-right">
                                    {{ __("Nueva construcción")}}
                                </label>
                                <div class="col-md-6">
                                    <select name="new_construct" id="new_construct" clase="form-control">
                                        <option {{ (int) old('new_construct') === 0 ? 'selected' : '' }} value="0">No</option>
                                        <option {{ (int) old('new_construct') === 0 ? 'selected' : '' }} value="1">Si</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row mb-0">
                                <div class="col-md-4 offset-5">
                                    <button type="submit" name="revision" class="btn btn-danger">
                                        {{ __($btnText) }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </form>
    </div>
@endsection