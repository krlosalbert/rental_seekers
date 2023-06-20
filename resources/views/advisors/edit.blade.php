<form method="POST" action="{{ route('advisors.update', $advisor_id) }}">
    @method('PUT')
    @csrf
    <div class="d-flex w-auto">
        <div class="d-inline w-100 p-3">
            <label for="supervisor_id"><b>{{ __('Supervisor') }}</b></label>
            <select name="supervisor_id" id="supervisor_id" class="form-control">
                <option value="0">Seleccione</option>
                @foreach($supervisors as $supervisor)
                    <option value="{{ $supervisor->supervisor_id }}">{{ $supervisor->name }} {{ $supervisor->lastname }}</option>
                @endforeach
            </select>   
                @error('supervisor_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
    </div>
    
    <div class="row mb-0">
        <div>
            <button type="submit" class="btn btn-primary">
                <b> {{ __('Guardar') }} </b>
            </button>
        </div>
    </div>
</form>