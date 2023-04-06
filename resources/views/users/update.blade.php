@foreach ($users as $user)
    <form method="POST" action="{{ route('update_users', $user->user_id) }}">
        @method('PUT')
        @csrf
        <div class="d-flex w-auto">
            <div class="d-inline w-100 p-3">
                <label for="name">{{ __('Nombres') }}</label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}" />
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="d-inline w-100 p-3">
                <label for="lastname">{{ __('Apellidos') }}</label>
                <input type="text" class="form-control" name="lastname" value="{{ $user->lastname }}" />
                @error('lastname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="d-inline w-100 p-3">
                <label for="email">{{ __('Correo Electronico') }}</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="d-flex w-auto">
            <div class="d-inline w-100 p-3">
                <label for="phone">{{ __('Celular') }}</label>
                <input type="number" class="form-control" name="phone" value="{{ $user->phone }}" />
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="d-inline w-100 p-3">
                <label for="addres">{{ __('Direccion') }}</label>
                <input type="text" class="form-control" name="addres" value="{{ $user->addres }}" />
                @error('addres')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="d-inline w-100 p-3">
                <label for="role_id">{{ __('Rol') }}</label>
                <select name="role_id" id="role_id" class="form-control">
                    <option value="{{ $user->user_role }}">{{ $user->role_name }}</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>  
                @error('role_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="d-flex w-auto">
        </div>

        <div class="d-flex w-auto">
            <div class="d-inline w-100 p-3">
                
            </div>

            <div class="d-inline w-100 p-3">
                
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