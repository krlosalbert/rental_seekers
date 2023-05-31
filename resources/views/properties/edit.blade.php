@foreach ($properties as $property)
    <form method="POST" action="{{ route('properties.update', $property->id) }}">
        @method('PUT')
        @csrf
        <div class="d-flex w-auto">
            <div class="d-inline w-100 p-3">
                <label for="name">{{ __('Inmueble') }}</label>
                <input type="text" class="form-control" name="name" value="{{ $property->name }}" />
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