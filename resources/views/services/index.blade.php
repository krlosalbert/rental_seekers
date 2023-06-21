@extends('layouts.header')

@section('content')
    <div class="col-12 mx-auto card d-flex justify-content-around flex-wrap" id="body_form">
        <div class="table-responsive" style="overflow-x: unset;">
            <div class="card-header" id="head_form">  
                <div class="row">
                    <div class="col">   
                        <h3>Servicios<h3>  
                    </div>
                    <div class="col text-right"> 
                        <!-- Button trigger modal el registro de nuevo banco -->
                        <button class="btn btn-secondary form-services" data-toggle="modal" data-target="#form-services">
                            Nuevo
                        </button>
                    </div>
                </div>
            </div>
            <table class="table" id="tbl-services">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Servicio</th>
                        <th class="text-center" scope="col">Valor ($)</th>
                        <th class="text-center" scope="col">Comision ($)</th>
                        <th class="text-center" scope="col">Residual ($)</th>
                        <th class="text-center" scope="col">Accion</th>
                    </tr>
                </thead>
                @php
                    $x = 0;
                @endphp
                <tbody>
                    @foreach($services as $service)       
                        <tr>  
                            <td class="text-center">{{ $x += 1;}}</td>
                            <td class="text-center">{{ $service->name }}</td>
                            <td class="text-center">{{ number_format($service->valor, 0, ',', '.') }}</td>
                            <td class="text-center">{{ number_format($service->commission, 0, ',', '.') }}</td>
                            <td class="text-center">{{ number_format($service->residue, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <!-- Button trigger modal para editar -->
                                <button class="btn btn-warning form-update-services" data-toggle="modal" data-target="#form-update-services" data-id="{{ $service->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                    </svg>
                                </button>
                                <button class="btn btn-danger btn-delete" data-id="{{ $service->id }}">
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
            
            <!-- Modal para el formulario de un nuevo servicio-->
            <div class="modal fade" id="form-services" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                <div class="modal-header d-flex" id="head_form">
                    <h3 class="modal-title" id="myModalLabel">{{ __('Registrar Nuevo servicio') }}<h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="body_form">
                    <!-- aqui va el contenido -->                    
                </div>
            </div>
        
            <!-- Modal para el formulario de editar un servicio-->
            <div class="modal fade" id="form-update-services" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header d-flex" id="head_form">
                            <h3 class="modal-title" id="myModalLabel">{{ __('Editar servicio') }}<h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body" id="body_form">
                                <!-- aqui va el contenido -->                    
                            </div>
                        </div>
                    </div>
                </div>    
            </div>

            @section('js')
                <script type="module" src="{{ asset('js/services/services.js') }}"></script>
                @if(session('success'))
                    <script>
                        swal("Listo!", "Servicio Guardado con Exito!", "success")
                    </script>
                @endif
                @if(session('update'))
                    <script>
                        swal("Listo!", "Servicio Actualizado con Exito!", "success")
                    </script>
                @endif
            @endsection
        </div>
    </div>
@endsection
