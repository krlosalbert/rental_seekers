@extends('layouts.header')

@section('content')
    <div class="card d-flex justify-content-around flex-wrap" id="body_form">
        <div class="table-responsive" style="overflow-x: unset;">
            <div class="card-header" id="head_form">
                <h3>Usuarios<h3>
            </div>
            <table class="table" id="tbl-users">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Nombres</th>
                        <th class="text-center" scope="col">Apellidos</th>
                        <th class="text-center" scope="col">Email</th>
                        <th class="text-center" scope="col">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users_with_roles as $user)
                        <tr>
                            <td>{{ $x += 1; }}</td>
                            <td class="text-center">{{ $user['name'] }}</td>
                            <td class="text-center">{{ $user['lastname'] }}</td>
                            <td class="text-center">{{ $user['email'] }}</td>
                            <td class="text-center">
                                <!-- button para visualizar detalles de los usuarios almacenados -->
                                <button class="btn btn-success details-btn" data-toggle="modal" data-target="#details-users" data-id="{{ $user['user_id'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                    </svg>
                                </button>
                                <!-- Button para editar los usuarios -->
                                <button class="btn btn-warning update-btn" data-toggle="modal" data-target="#update-users" data-id="{{ $user['user_id'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                    </svg>
                                </button>
                                <button class="btn btn-danger btn-delete" data-id="{{ $user['user_id'] }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                </buttton>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Modal para mostrar detalles de usuarios-->
            <div class="modal fade" id="details-users" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-lg ">
                    <div class="modal-content d-flex justify-content-center align-items-center">
                        <div class="modal-header w-100" id="head_form">
                            <h3 class="modal-title" id="exampleModalLabel"><b>Detalles del usuario</b></h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body w-100" id="body_form">

                            <!-- El contenido de la tabla se insertará aquí -->

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para editar los usuarios-->
            <div class="modal fade" id="update-users" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content d-flex justify-content-center align-items-center">
                        <div class="modal-header w-100" id="head_form">
                            <h3 class="modal-title" id="exampleModalLabel"><b>Editar Usuarios</b></h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body w-100" id="body_form">

                            <!-- El contenido de la tabla se insertará aquí -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- Aqui empiezan los scripts -->
            @section('js')
                <script type="module" src="{{ asset('js/users/users.js') }}"></script>
                @if(session('success'))
                    <script>
                        swal("Listo!", "Usuario Guardado con Exito!", "success")
                    </script>
                @endif
                @if(session('done'))
                    <script>
                        swal("Listo!", "Usuario Actualizado con Exito!", "success")
                    </script>
                @endif
            @endsection
        </div>
    </div>
@endsection