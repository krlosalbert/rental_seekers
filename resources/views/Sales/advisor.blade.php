<label for="advisor"><b>{{ __('Asesor') }}</b></label>
<select name="advisor" id="advisor" class="form-control">
    <option value="0">Seleccione</option>
    @foreach($advisors as $advisor)
        <option value="{{ $advisor->advisor_id }}">{{ $advisor->name }}</option>
    @endforeach
</select>

@error('advisor')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror

