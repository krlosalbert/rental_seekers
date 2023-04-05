@extends('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"  id="head_form"><h3>{{ __('Registro de Usuarios') }}</h3></div>

                <div class="card-body" id="body_form">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="d-flex w-auto">
                            <div class="d-inline w-100 p-3">
                       
                                <label for="name">{{ __('Nombres') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Escribe su Nombre" >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="d-inline w-100 p-3">
                                <label for="lastname">{{ __('Apellidos') }}</label>
                                <input type="text" class="form-control  @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" placeholder="Escribe su Apellido" />
                                    
                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            
                            <div class="d-inline w-100 p-3">
                                <label for="email">{{ __('Correo Electronico') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Escribe su Email" >
                                
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex w-auto">
                            
                            <div class="d-inline w-100 p-3">
                                <label for="phone">{{ __('Celular') }}</label>
                                <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Escribe su telefono" required autocomplete="phone"/>
                                
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="d-inline w-100 p-3">
                                <label for="addres">{{ __('Direccion') }}</label>
                                <input type="text" class="form-control @error('addres') is-invalid @enderror" name="addres" value="{{ old('addres') }}" placeholder="Escribe su direccion" required autocomplete="addres"/>
    
                                @error('addres')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
    
                            <div class="d-inline w-100 p-3">
                                <label for="role">{{ __('Rol') }}</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="0">Seleccione</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
    
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex w-auto">

                            <div class="d-inline w-100 p-3">
                                <label for="supervisor">{{ __('Supervisor') }}</label>
                                <select name="supervisor" id="supervisor" class="form-control">
                                    <option value="0">Seleccione</option>
                                    @foreach($supervisors as $supervisor)
                                        <option value="{{ $supervisor->id_supervisors }}">{{ $supervisor->name }} {{ $supervisor->lastname }}</option>
                                    @endforeach
                                </select>
    
                                @error('supervisor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-inline w-100 p-3">
                                <label for="password">{{ __('Contraseña') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Digite su Contraseña">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="d-inline w-100 p-3">
                                <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirme su Contraseña">
                            </div>

                        </div>

                        <div class="row mb-0">
                            <div>
                                <button type="submit" class="btn btn-primary">
                                   <b> {{ __('Guardar') }} </b>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
