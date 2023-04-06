<form method="POST" action="{{ route('create_roles') }}">
    @csrf
    <div class="d-flex w-auto">
        <div class="d-inline w-100 p-3">
            <label for="name"><b>{{ __('Rol') }}</b></label>
            <input type="text" name="name" class="form-control" placeholder="Digite el nombre del rol"/> 
                @error('name')
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