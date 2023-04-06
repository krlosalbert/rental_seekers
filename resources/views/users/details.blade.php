@foreach ($users as $user)
    <div class="d-flex w-auto">
        <div class="d-inline w-100 p-3">
            <label for="name">{{ __('Nombres') }}</label>
            <input type="text" class="form-control" name="name" value="{{ $user->name }}" readonly/>
        </div>

        <div class="d-inline w-100 p-3">
            <label for="lastname">{{ __('Apellidos') }}</label>
            <input type="text" class="form-control" name="lastname" value="{{ $user->lastname }}" readonly/>
        </div>

        <div class="d-inline w-100 p-3">
            <label for="email">{{ __('Correo Electronico') }}</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" readonly/>
        </div>
    </div>

    <div class="d-flex w-auto">
        <div class="d-inline w-100 p-3">
            <label for="phone">{{ __('Celular') }}</label>
            <input type="number" class="form-control" name="phone" value="{{ $user->phone }}" readonly/>
        </div>

        <div class="d-inline w-100 p-3">
            <label for="addres">{{ __('Direccion') }}</label>
            <input type="text" class="form-control" name="addres" value="{{ $user->addres }}" readonly/>
        </div>

        <div class="d-inline w-100 p-3">
            <label for="role">{{ __('Rol') }}</label>
            <input name="role" id="role" class="form-control"value="{{ $user->role_name }}" readonly/>
        </div>
    </div>

    <div class="d-flex w-auto">
    </div>

    <div class="d-flex w-auto">
        <div class="d-inline w-100 p-3">
            
        </div>

        <div class="d-inline w-100 p-3">
            
        </div>

        <div class="d-inline w-100 p-3">
            
        </div>
    </div>
@endforeach

