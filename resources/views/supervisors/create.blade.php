@extends('layouts.header')

@section('content')

    <!-- Botón que activa el modal (lo puedes ocultar con CSS si no quieres mostrarlo) -->
    <button type="button" id="btn-supervisors" data-toggle="modal" data-target="#modal-supervisors" style="display: none;"></button>

    <!-- Modal -->
    <div class="modal fade" id="modal-supervisors" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" id="head_form">
                    <h3 class="modal-title" id="myModalLabel">{{ __('Nuevo Supervisor') }}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="body_form">
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
                <script>
                    $(document).ready(function() {
                        // Llamamos al botón del modal y le hacemos clic automáticamente
                        $('#btn-supervisors').trigger('click');
                    });

                </script>
            </div>
        </div>
    </div>
@endsection

              
                    
