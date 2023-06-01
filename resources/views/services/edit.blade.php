@foreach ($services as $service)
    <form method="POST" action="{{ route('services.update', $service->id) }}">
        @method('PUT')
        @csrf
        <div class="d-flex w-auto">
            <div class="d-inline w-100 p-3">
                <label for="name">{{ __('Servicio') }}</label>
                <input type="text" class="form-control" name="name" value="{{ $service->name }}" />
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="d-inline w-100 p-3">
                <label for="valor">{{ __('Valor') }}</label>
                <input type="number" class="form-control" name="valor" value="{{ $service->valor }}" />
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
                <input type="number" name="commission" class="form-control" value="{{ $service->commission }}" /> 
                @error('commission')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="d-inline w-100 p-3">
                <label for="residue"><b>{{ __('Residual') }}</b></label>
                <input type="number" name="residue" class="form-control" value="{{ $service->residue }}" /> 
                @error('residue')
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