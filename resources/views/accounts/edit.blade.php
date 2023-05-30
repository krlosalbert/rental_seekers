@foreach ($accounts as $account)
    <form method="POST" action="{{ route('accounts.update', $account->account_id) }}">
        @method('PUT')
        @csrf
        <div class="d-flex w-auto">
            <div class="d-inline w-100 p-3">
                <label for="number">{{ __('Cuenta') }}</label>
                <input type="number" class="form-control" name="number" value="{{ $account->account_number }}" />
                @error('number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="d-inline w-100 p-3">
                <label for="banks_id">{{ __('Banco') }}</label>
                <select class="form-control" name="banks_id">
                    <option value="{{ $account->bank_id }}">{{ $account->bank_name }} </option>
                    @foreach ($banks as $bank)
                        <option value="{{ $bank->id }}"> {{ $bank->name }} </option>
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
                <button type="submit" class="btn btn-warning" id="button_form">
                    <b> {{ __('Actualizar') }} </b>
                </button>
            </div>
        </div>
    </form>
@endforeach