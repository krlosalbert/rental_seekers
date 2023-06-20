<form method="POST" action="{{ route('supervisors.store') }}">
    @csrf
    <div class="d-flex w-auto">
        <div class="d-inline w-100 p-3">
            <label for="user_id"><b>{{ __('Supervisor') }}</b></label>
            <select name="user_id" id="user_id" class="form-control">
                <option value="0">Seleccione</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} {{ $user->lastname }}</option>
                @endforeach
            </select>   
                @error('user_id')
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
              
                    
