@foreach ($roles as $role)
    <form method="POST" action="{{ route('roles.update', $role->role_id) }}">
        @method('PUT')
        @csrf
        <div class="d-flex w-auto">
            <div class="d-inline w-100 p-3">
                <label for="name">{{ __('Rol') }}</label>
                <input type="text" class="form-control" name="name" value="{{ $role->name }}" />
                @error('name')
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
@endforeach