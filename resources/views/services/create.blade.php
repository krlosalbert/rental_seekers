<form method="POST" action="{{ route('services.store') }}">
    @csrf
    <div class="d-flex w-auto">
        <div class="d-inline w-100 p-3">
            <label for="name"><b>{{ __('Nombre del servicio') }}</b></label>
            <input type="text" name="name" class="form-control" placeholder="Digite el nombre del servicio"/> 
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="d-inline w-100 p-3">
            <label for="valor"><b>{{ __('Valor') }}</b></label>
            <input type="number" name="valor" class="form-control" placeholder="Digite el valor del servicio"/> 
            @error('valor')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="d-flex w-auto">
        <div class="d-inline w-100 p-3">
            <label for="commission"><b>{{ __('Comision') }}</b></label>
            <input type="number" name="commission" class="form-control" placeholder="Digite el valor de la comision"/> 
            @error('commission')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="d-inline w-100 p-3">
            <label for="residue"><b>{{ __('Residual') }}</b></label>
            <input type="number" name="residue" class="form-control" placeholder="Digite el valor del la residual"/> 
            @error('residue')
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