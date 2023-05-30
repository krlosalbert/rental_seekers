@foreach ($cities as $city)
    <form method="POST" action="{{ route('cities.update', $city->id) }}">
        @method('PUT')
        @csrf
        <div class="d-flex w-auto">
            <div class="d-inline w-100 p-3">
                <label for="name">{{ __('Ciudad') }}</label>
                <input type="name" class="form-control" name="name" value="{{ $city->name }}" />
                @error('name')
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