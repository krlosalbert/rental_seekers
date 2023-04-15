<label for="accounts"><b>{{ __('Numero de cuenta') }}</b></label>
<select name="accounts" id="accounts" class="form-control">
    <option value="0">Seleccione</option>
    @foreach($accounts as $account)
        <option value="{{ $account->id }}">{{ $account->number }}</option>
    @endforeach
</select>

@error('accounts')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror