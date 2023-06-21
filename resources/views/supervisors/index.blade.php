@extends('layouts.header')

@section('content')
    <div class="col-8 mx-auto card d-flex justify-content-around flex-wrap" id="body_form">
        <div class="table-responsive" style="overflow-x: unset;">
            <div class="card-header" id="head_form">  
                <div class="row">
                    <div class="col">   
                        <h3>Supervisores<h3>  
                    </div>
                    <div class="col text-right">  
                        <button class="btn btn-secondary form-supervisors" data-toggle="modal" data-target="#form-supervisors">
                            Nuevo
                        </button>
                    </div>
                </div>
            </div>
            <table class="table" id="tbl-supervisors">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Nombre</th>
                        <th class="text-center" scope="col">Accion</th>
                    </tr>
                </thead>
                @php
                    $x = 0;
                @endphp
                <tbody>
                    @foreach($supervisors as $supervisor)       
                        <tr>  
                            <td class="text-center">{{ $x += 1;}}</td>
                            <td class="text-center">{{ $supervisor->name_supervisors }} {{$supervisor->lastname_supervisors }}</td>
                            <td class="text-center">
                                <!-- boton trigger modal para ver los asesores de los supervisores -->
                                <button class="btn btn-warning show_supervisors-btn" data-toggle="modal" data-target="#show_supervisors" data-id="{{ $supervisor->id_supervisors }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                </button>
                                <button class="btn btn-danger btn-delete" data-id="{{ $supervisor->id_supervisors }}">
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
    
            <!-- Modal para nuevo supervisor-->
            <div class="modal fade" id="form-supervisors" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header" id="head_form">
                            <h3 class="modal-title" id="myModalLabel">{{ __('Nuevo Supervisor') }}</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="body_form">
                            <!-- aqui va el contenido -->   
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal para el formulario de ver los detalles de las ventas-->
            <div class="modal fade" id="show_supervisors" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header d-flex" id="head_form">
                            <h3 class="modal-title" id="myModalLabel">{{ __('Detalles de los supervisores') }}<h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="body_form">
                            <!-- aqui va el contenido -->                    
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Modal para el formulario de editar al supervisor-->
            <div class="modal fade" id="form_update-advisors" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header d-flex" id="head_form">
                            <h3 class="modal-title" id="myModalLabel">{{ __('Editar Supervisor del asesor') }}<h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="body_form">
                            <!-- aqui va el contenido -->                    
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aqui empiezan los scripts -->
            @section('js')
                <script type="module" src="{{ asset('js/supervisors/supervisors.js') }}"></script>
                @if(session('success'))
                    <script>
                        swal("Listo!", "Supervisor Guardado con Exito!", "success")
                    </script>
                @endif
                @if(session('update'))
                    <script>
                        swal("Listo!", "Supervisor Actualizado con Exito!", "success")
                    </script>
                @endif
            @endsection
        </div>
    </div>
@endsection
