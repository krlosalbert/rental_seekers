@foreach ($banks as $bank)
    <form method="POST" action="{{ route('banks.update', $bank->banks_id) }}">
        @method('PUT')
        @csrf
        <div class="d-flex w-auto">
            <div class="d-inline w-100 p-3">
                <label for="name">{{ __('Bancos') }}</label>
                <input type="text" class="form-control" name="name" value="{{ $bank->name }}" />
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