
    <div class="d-flex w-auto">
        <div class="d-inline w-100 p-3">
            <label for="date"><b>{{ __('Fecha') }}</b></label>
            <input type="date" class="form-control" name="date" value="{{ $sale->date }}" readonly/>
        </div>

        <div class="d-inline w-100 p-3">
            <label for="name"><b>{{ __('Nombres del cliente') }}</b></label>
            <input type="text" class="form-control" name="name" value="{{ $sale->name_customer }}" readonly/>
        </div>

        <div class="d-inline w-100 p-3">
            <label for="lastname"><b>{{ __('Apellidos del cliente') }}</b></label>
            <input type="text" class="form-control" name="lastname" value="{{ $sale->lastname_customer }}" readonly/>
        </div>

        <div class="d-inline w-100 p-3">
            <label for="phone"><b>{{ __('Telefono del cliente') }}</b></label>
            <input id="phone" type="number" class="form-control" name="phone" value="{{ $sale->phone_customer }}" readonly/>
        </div>
    </div>

    <div class="d-flex w-auto">
        <div class="d-inline w-100 p-3">
            <label for="name_service"><b>{{ __('Servicio') }}</b></label>
            <input type="text" class="form-control" name="name_service" value="{{ $sale->name_service }}" readonly/>
        </div>

        <div class="d-inline w-100 p-3">
            <label for="name_city"><b>{{ __('Ciudad') }}</b></label>
            <input type="text" class="form-control" name="name_city" value="{{ $sale->name_city }}" readonly/>
        </div>

        <div class="d-inline w-100 p-3">
            <label for="name_neighborhood"><b>{{ __('Barrio') }}</b></label>
            <input type="text" name="name_neighborhood" class="form-control"value="{{ $sale->name_neighborhood }}" readonly/>
        </div>

        <div class="d-inline w-100 p-3">
            <label for="name_property"><b>{{ __('Tipo de inmueble') }}</b></label>
            <input type="text" class="form-control" name="name_property" value="{{ $sale->name_property }}" readonly/>
        </div>
    </div>

    <div class="d-flex w-auto">

        <div class="d-inline w-100 p-3">
            <label for="number_rooms"><b>{{ __('No de habitaciones') }}</b></label>
            <input type="text" class="form-control" name="number_rooms" value="{{ $sale->number_rooms }}" readonly/>
        </div>

        <div class="d-inline w-100 p-3">
            <label for="parking"><b>{{ __('Parqueadero') }}</b></label>
            <input type="text" name="parking" class="form-control"value="{{ $sale->parking }}" readonly/>
        </div>

        <div class="d-inline w-100 p-3">
            <label for="name_supervisor"><b>{{ __('Supervisor') }}</b></label>
            <input type="text" class="form-control" name="name_supervisor" value="{{ $supervisor->name_supervisor }} {{ $supervisor->lastname_supervisor }}" readonly/>
        </div>
    
        <div class="d-inline w-100 p-3">
            <label for="name_advisor"><b>{{ __('Asesor') }}</b></label>
            <input type="text" class="form-control" name="name_advisor" value="{{ $sale->name_advisor }} {{ $sale->lastname_advisor }}" readonly/>
        </div>
    </div>

    <div class="d-flex w-auto">

        <div class="d-inline w-100 p-3">
            <label for="name_banks"><b>{{ __('Banco') }}</b></label>
            <input type="text" name="name_banks" class="form-control"value="{{ $sale->name_banks }}" readonly/>
        </div>

        <div class="d-inline w-100 p-3">
            <label for="number_account"><b>{{ __('No de cuenta') }}</b></label>
            <input type="number" class="form-control" name="number_account" value="{{ $sale->number_account }}" readonly/>
        </div>

        <div class="d-inline w-100 p-3">
            <label for="referencia"><b>{{ __('Referencia de pago') }}</b></label>
            <input type="text" class="form-control" name="referencia" value="{{ $sale->referencia }}" readonly/>
        </div>

        <div class="d-inline w-100 p-3">
            <label for="canon"><b>{{ __('CANON') }}</b></label>
            <input type="number" name="canon" class="form-control"value="{{ $sale->canon }}" readonly/>
        </div>
    </div>

    <div class="d-flex w-auto">
        <div class="d-inline w-100 p-3">
            <label for="comprobante"><b>{{ __('Comprobante') }}</b></label>
            <img class="w-50 h-50" src="{{ $sale->comprobante }}" readonly/>
        </div>

        <div class="d-inline w-100 p-3">
            <label for="terminos"><b>{{ __('Terminos') }}</b></label>
            <img class="w-50 h-50" src="{{ $sale->terminos }}" readonly/>
        </div>

        <div class="d-inline w-100 p-3">

        </div>
        
        <div class="d-inline w-100 p-3">

        </div>

    </div>


