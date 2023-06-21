@extends('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" id="head_form"><h3>{{ __('Registrar Ventas') }}</h3></div>

                <div class="card-body" id="body_form">
                    <form method="POST" action="{{ route('sales.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex w-auto">
                            @if(!empty($customers))
                                @foreach($customers as $customer)
                                    <div class="d-inline w-100 p-3" >
                                        <input type="hidden" name="id" value="{{ $customer->id }}"/>
                                        <label for="name_customer"><b>{{ __('Nombre del cliente') }}</b></label>
                                        <input id="name_customer" type="text" class="form-control @error('name_customer') is-invalid @enderror" name="name_customer" value="{{ $customer->name }}" readOnly />

                                        @error('name_customer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="d-inline w-100 p-3" >
                                       <label for="lastname_customer"><b>{{ __('Apellidos del cliente') }}</b></label>
                                        <input id="lastname_customer" type="text" class="form-control @error('lastname_customer') is-invalid @enderror" name="lastname_customer" value="{{ $customer->lastname }}" readOnly />

                                        @error('lastname_customer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="d-inline w-100 p-3">
                                        <label for="phone_customers"><b>{{ __('Numero de celular del cliente') }}</b></label>
                                        <input type="number" class="form-control  @error('phone_customers') is-invalid @enderror" name="phone_customers" value="{{ $customer->phone }}" readOnly />
                                            @error('phone_customers')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                @endforeach
                            @else
                                <div class="d-inline w-100 p-3" >
                                    <label for="new_customer"><b>{{ __('Nombre del cliente') }}</b></label>
                                    <input id="new_customer" type="text" class="form-control @error('new_customer') is-invalid @enderror" name="new_customer"  placeholder="Escribe el Nombre del cliente" required>

                                    @error('new_customer')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="d-inline w-100 p-3" >
                                    <label for="newlastname_customer"><b>{{ __('Apellidos del cliente') }}</b></label>
                                    <input id="newlastname_customer" type="text" class="form-control @error('newlastname_customer') is-invalid @enderror" name="newlastname_customer"  placeholder="Escribe el Nombre del cliente" required>

                                    @error('newlastname_customer')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="d-inline w-100 p-3">
                                    <label for="new_phone_customers"><b>{{ __('Numero de celular del cliente') }}</b></label>
                                    <input type="number" class="form-control  @error('new_phone_customers') is-invalid @enderror" name="new_phone_customers"  required autocomplete="new_phone_customers" placeholder="Escriba el telefono del cliente" />
                                        @error('new_phone_customers')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            @endif
                        </div>

                        <div class="d-flex w-auto">

                            <div class="d-inline w-100 p-3">
                                <label for="type_sales"><b>{{ __('Servicio') }}</b></label>
                                <select name="type_sales" id="type_sales" class="form-control" required>
                                    <option value="0">Seleccione</option>
                                    <option value="1">General</option>
                                    <option value="2">Personalizado</option>
                                </select>   
                                    @error('type_sales')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

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
                                <label for="neighborhoods"><b>{{ __('Barrio') }}</b></label>
                                <select name="neighborhoods" id="neighborhoods" class="form-control" readOnly>
                                    <option value="0">Seleccione</option>
                                </select>   
                                @error('neighborhoods')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex w-auto">
                            <div class="d-inline w-50 p-3">
                                <label for="property"><b>{{ __('Tipo de inmueble') }}</b></label>
                                <select name="property" id="property" class="form-control" readOnly>
                                    <option value="0">Seleccione</option>
                                </select>   
                                @error('property')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="d-inline w-50 p-3">
                                <label for="number_rooms"><b>{{ __('No de habitaciones') }}</b></label>
                                <select name="number_rooms" id="number_rooms" class="form-control" readOnly>
                                    <option value="0">Seleccione</option>
                                </select>   
                                @error('number_rooms')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="d-inline w-50 p-3">
                                <label for="parking"><b>{{ __('Parqueadero') }}</b></label>
                                <select name="parking" id="parking" class="form-control" readOnly>
                                    <option value="0">Seleccione</option>
                                </select>
                         
                                @error('parking')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex w-auto" >
                            <div class="d-inline w-100 p-3">
                                <label for="supervisor"><b>{{ __('Supervisor') }}</b></label>
                                <select name="supervisor" id="supervisor" class="form-control">
                                    <option value="0">Seleccione</option>
                                    @foreach($supervisors as $supervisor)
                                    <option value="{{ $supervisor->supervisor_id }}">{{ $supervisor->name }} {{ $supervisor->lastname }}</option>
                                    @endforeach
                                </select>   
                                @error('supervisor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="d-inline w-100 p-3" id="advisors">
                                <label for="advisor"><b>{{ __('Asesor') }}</b></label>
                                <select name="advisor" id="advisor" class="form-control">
                                    <option value="0">Seleccione</option>
                                </select>
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
                            <div class="d-inline w-100 p-3" id="accounts">
                                <label for="accounts"><b>{{ __('Numero de cuenta') }}</b></label>
                                <select name="accounts" id="accounts" class="form-control">
                                    <option value="0">Seleccione</option>
                                 </select>

                                @error('accounts')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-inline w-100 p-3">
                                <label for="referencia"><b>{{ __('Referencia de pago') }}</b></label>
                                <input id="referencia" type="text" class="form-control @error('referencia') is-invalid @enderror" name="referencia" value="{{ old('referencia') }}" placeholder="Digite la referencia del comprobante" required>
    
                                @error('referencia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-inline w-100 p-3">
                                <label for="cannon"><b>{{ __('CANON') }}</b></label>
                                <input type="number" name="cannon" id="cannon" class="form-control" placeholder="Ingrese el presupuesto maximo" required readOnly/>

                                @error('cannon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="d-flex w-auto">
                            <div class="d-inline w-100 p-3">
                                <label for="comprobante"><b>{{ __('Comprobante') }}</b></label><br/>
                                <input id="comprobante" type="file" class="" name="comprobante" required/>
    
                                @error('comprobante')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="d-inline w-100 p-3">
                                <label for="terminos"><b>{{ __('Terminos y condiciones') }}</b></label>
                                <input id="terminos" type="file" class="" name="terminos" required/>

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

                <script type="module" src="{{ asset('js/sales/sales.js') }}"></script>
                @if(session('success'))
                    <script>
                        swal("Listo!", "Venta Guardada con Exito!", "success")
                    </script>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

              
                    
