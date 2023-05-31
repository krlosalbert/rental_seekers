<form method="POST" action="{{ route('neighborhoods.store') }}">
    @csrf
    <div class="d-flex w-auto">
        <div class="d-inline w-100 p-3">
            <label for="name"><b>{{ __('Barrio') }}</b></label>
            <input type="text" name="name" class="form-control" placeholder="Digite el nombre del barrio"/> 
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="d-inline w-100 p-3">
            <label for="city_id"><b>{{ __('Ciudad') }}</b></label>
            <select name="city_id" class="form-control"> 
                <option value="0">{{ __('Seleccione') }}</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
            @error('city_id')
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