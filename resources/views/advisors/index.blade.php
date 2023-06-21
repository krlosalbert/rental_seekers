@extends('layouts.header')

@section('content')
<div class="col-8 mx-auto card d-flex justify-content-around flex-wrap" id="body_form">
        <div class="table-responsive" style="overflow-x: unset;">
            <div class="card-header" id="head_form">  
                <h3>Asesores<h3>
            </div>
            <table class="table" id="tbl-advisors">
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
                    @foreach($advisors as $advisor)       
                        <tr>  
                            <td class="text-center">{{ $x += 1;}}</td>
                            <td class="text-center">{{ $advisor->name_advisors }} {{$advisor->lastname_advisors }}</td>
                            <td class="text-center">
                                <!-- boton trigger modal para consultar las ventas -->
                                <button class="btn btn-success show_sales-btn" data-toggle="modal" data-target="#show_sales" data-id="{{ $advisor->advisor_id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                </button>
                                <!-- Button trigger modal para editar -->
                                <button class="btn btn-warning form_update-advisors" data-toggle="modal" data-target="#form_update-advisors" data-id="{{ $advisor->advisor_id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach      
                </tbody> 
            </table>
            <!-- Modal para el formulario de ver los detalles de las ventas-->
            <div class="modal fade" id="show_sales" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header d-flex" id="head_form">
                            <h3 class="modal-title" id="myModalLabel">{{ __('Detalles de ventas') }}<h3>
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
        
            @section('js')
                <script type="module" src="{{ asset('js/advisors/advisors.js') }}"></script>
                @if(session('success'))
                    <script>
                        swal("Listo!", "Asesor Guardado con Exito!", "success")
                    </script>
                @endif
                @if(session('update'))
                    <script>
                        swal("Listo!", "Supervisor modificado Exitosamente!", "success")
                    </script>
                @endif
            @endsection
        </div>
    </div>
@endsection
