@foreach ($neighborhoods as $neighborhood)
    <form method="POST" action="{{ route('neighborhoods.update', $neighborhood->neighborhood_id) }}">
        @method('PUT')
        @csrf
        <div class="d-flex w-auto">
            <div class="d-inline w-100 p-3">
                <label for="name">{{ __('Barrio') }}</label>
                <input type="text" class="form-control" name="name" value="{{ $neighborhood->neighborhood_name }}" />
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="d-inline w-100 p-3">
                <label for="city_id">{{ __('Ciudad') }}</label>
                <select class="form-control" name="city_id">
                    <option value="{{ $neighborhood->city_id }}">{{ $neighborhood->city_name }} </option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}"> {{ $city->name }} </option>
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
                <button type="submit" class="btn btn-warning" id="button_form">
                    <b> {{ __('Actualizar') }} </b>
                </button>
            </div>
        </div>
    </form>
@endforeach