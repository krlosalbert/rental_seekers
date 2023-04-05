@extends('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" id="head_form"><h3>{{ __('Registrar Ventas') }}</h3></div>

                <div class="card-body" id="body_form">
                    <form method="POST" action="{{ route('form_sales') }}">
                        @csrf
                        <div class="d-flex w-auto">
                            <div class="d-inline w-100 p-3">
                       
                                <label for="name_costumer"><b>{{ __('Nombre del cliente') }}</b></label>
                                <input id="name_costumer" type="text" class="form-control @error('name_costumer') is-invalid @enderror" name="name_costumer" value="{{ old('name_costumer') }}" required autocomplete="name_costumer" autofocus placeholder="Escribe el Nombre del cliente" >

                                @error('name_costumer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="d-inline w-100 p-3">
                                <label for="phone_customers"><b>{{ __('Numero de celular del cliente') }}</b></label>
                                <input type="number" class="form-control  @error('phone_customers') is-invalid @enderror" name="phone_customers" value="{{ old('phone_customers') }}" required autocomplete="phone_customers" placeholder="Escriba el telefono del cliente" />
                                    @error('phone_customers')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                        </div>

                        <div class="d-flex w-auto">
                            <div class="d-inline w-100 p-3">
                                <label for="city"><b>{{ __('Ciudad en la que necesita el arriendo') }}</b></label>
                                <select name="city" id="city" class="form-control">
                                    <option value="0">Seleccione</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>   
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            
                            
                            <div class="d-inline w-100 p-3">
                                <label for="overseer"><b>{{ __('Supervisor') }}</b></label>
                                <select name="overseer" id="overseer" class="form-control">
                                    <option value="0">Seleccione</option>
                                    @foreach($employees_1 as $employee_1)
                                    <option value="{{ $employee_1->id }}">{{ $employee_1->name }}</option>
                                    @endforeach
                                </select>   
                                @error('overseer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex w-auto">
                        
    
                            <div class="d-inline w-100 p-3">
                                <label for="executive"><b>{{ __('Asesor') }}</b></label>
                                <select name="executive" id="executive" class="form-control">
                                    <option value="0">Seleccione</option>
                                    @foreach($employees_2 as $employee_2)
                                        <option value="{{ $employee_2->id }}">{{ $employee_2->name }}</option>
                                    @endforeach
                                </select>
    
                                @error('executive')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-inline w-100 p-3">
                                <label for="banks"><b>{{ __('Banco') }}</b></label>
                                <select name="banks" id="banks" class="form-control">
                                    <option value="0">Seleccione</option>
                                    @foreach($banks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                    @endforeach
                                </select>

                                @error('banks')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                        </div>

                        <div class="d-flex w-auto">
                            <div class="d-inline w-100 p-3">
                                <label for="accounts"><b>{{ __('Numero de cuenta') }}</b></label>
                                <select name="acccounts" id="accounts" class="form-control">
                                    <option value="0">Seleccione</option>
                                    @foreach($accounts as $account)
                                        <option value="{{ $account->id }}">{{ $account->number }}</option>
                                    @endforeach
                                </select>

                                @error('accounts')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-inline w-100 p-3">
                                <label for="referencia"><b>{{ __('Referencia de pago') }}</b></label>
                                <input id="referencia" type="text" class="form-control @error('referencia') is-invalid @enderror" name="referencia" value="{{ old('referencia') }}" placeholder="Digite la referencia del comprobante">
    
                                @error('referencia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="d-flex w-auto">
                            <div class="d-inline w-100 p-3">
                                <label for="comprobante"><b>{{ __('Comprobante') }}</b></label><br/>
                                <input id="comprobante" type="file" class="" name="comprobante">
    
                                @error('comprobante')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="d-inline w-100 p-3">
                                <label for="terminos"><b>{{ __('Terminos y condiciones') }}</b></label>
                                <input id="terminos" type="file" class="" name="terminos"/>

                                @error('terminos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div>
                                <button type="submit" class="btn btn-primary" id="button_form">
                                   <b> {{ __('Guardar') }} </b>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <script src="{{ asset('js/ScriptUsers/formUsers.js') }}"></script>
            </div>
        </div>
    </div>
</div>
@endsection

              
                    
