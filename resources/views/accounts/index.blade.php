@extends('layouts.header')

@section('content')
    <!-- Botón que activa el modal (lo puedes ocultar con CSS si no quieres mostrarlo) -->
    <button type="button" id="btn-view_accounts" data-toggle="modal" data-target="#modal-view_accounts" style="display: none;"></button>

    <!-- Modal -->
    <div class="modal fade" id="modal-view_accounts" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex" id="head_form">
                    <h3 class="modal-title" id="myModalLabel">{{ __('Cuentas') }}<h3>
                    <!-- Button trigger modal el registro de nuevo banco -->
                    <button class="btn btn-secondary form-accounts" data-toggle="modal" data-target="#form-accounts">
                        Nuevo
                    </button>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="body_form">
                    <table class="table">
                        <thead class="">
                            <tr>
                                <th class="text-center" scope="col">#</th>
                                <th class="text-center" scope="col">Banco</th>
                                <th class="text-center" scope="col">Cuenta</th>
                                <th class="text-center" scope="col">Accion</th>
                            </tr>
                        </thead>
                        @php
                            $x = 0;
                        @endphp
                        @foreach($accounts as $account)       
                        <tbody>
                            <tr>  
                                <td class="text-center">{{ $x += 1;}}</td>
                                <td class="text-center">{{ $account->bank_name }}</td>
                                <td class="text-center">{{ $account->number }}</td>
                                <td class="text-center">
                                    <!-- Button trigger modal para editar -->
                                    <button class="btn btn-warning form-update-accounts" data-toggle="modal" data-target="#form-update-accounts" data-id="{{ $account->account_id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                    </button>
                                    <button class="btn btn-danger btn-delete" data-id="{{ $account->account_id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </buttton>
                                </td>
                            </tr>
                        </tbody> 
                        @endforeach      
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal para el formulario de una nueva cuenta-->
    <div class="modal fade" id="form-accounts" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex" id="head_form">
                    <h3 class="modal-title" id="myModalLabel">{{ __('Registrar Nueva Cuenta') }}<h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="body_form">
                    <!-- aqui va el contenido -->                    
                </div>
            </div>
        </div>
    </div>
        
    <!-- Modal para el formulario de editar la cuenta-->
    <div class="modal fade" id="form-update-accounts" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex" id="head_form">
                    <h3 class="modal-title" id="myModalLabel">{{ __('Editar cuenta') }}<h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="body_form">
                    <!-- aqui va el contenido -->                    
                </div>
            </div>
        </div>
    </div>
            
    <script src="{{ asset('js/accounts/accounts.js') }}"></script>
    @if(session('success'))
        <script>
            swal("Listo!", "Cuenta Guardado con Exito!", "success")
                .then((value) => {
            }) 
        </script>
    @endif
    @if(session('update'))
        <script>
            swal("Listo!", "Cuenta Actualizado con Exito!", "success")
                .then((value) => {
            }) 
        </script>
    @endif
@endsection
