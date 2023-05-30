<form method="POST" action="{{ route('accounts.store') }}">
    @csrf
    <div class="d-flex w-auto">
        <div class="d-inline w-100 p-3">
            <label for="number"><b>{{ __('Numero de cuenta') }}</b></label>
            <input type="number" name="number" class="form-control" placeholder="Digite el numero de cuenta"/> 
            @error('number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="d-inline w-100 p-3">
            <label for="banks_id"><b>{{ __('Banco') }}</b></label>
            <select type="text" name="banks_id" class="form-control"> 
                <option value="0">{{ __('Seleccione') }}</option>
                @foreach($banks as $bank)
                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                @endforeach
            </select>
            @error('banks_id')
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