@extends('layouts.header')

@section('content')
    <!-- Botón que activa el modal (lo puedes ocultar con CSS si no quieres mostrarlo) -->
    <button type="button" id="btn-view_advisors" data-toggle="modal" data-target="#modal-view_advisors" style="display: none;"></button>

    <!-- Modal -->
    <div class="modal fade" id="modal-view_advisors" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" id="head_form">
                    <h3 class="modal-title" id="myModalLabel">{{ __('Asesores') }} <h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="body_form">
                    <table class="table">
                        <thead class="">
                            <tr>
                                <th class="text-center" scope="col">#</th>
                                <th class="text-center" scope="col">Nombre</th>
                                <th class="text-center" scope="col">Accion</th>
                            </tr>
                        </thead>
                        @php
                            $x = 0;
                        @endphp
                        @foreach($advisors as $advisor)       
                        <tbody>
                            <tr>  
                                <td class="text-center">{{ $x += 1;}}</td>
                                <td class="text-center">{{ $advisor->name_advisors }} {{$advisor->lastname_advisors }}</td>
                                <td class="text-center">
                                    <!-- boton trigger modal para ver los asesores de los supervisores -->
                                    <button class="btn btn-success supervisor-btn" data-toggle="modal" data-target="#supervisor_advisor" data-id="{{ $advisor->supervisor }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </tbody> 
                        @endforeach      
                    </table>
                    <div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal para ver los supervisores -->
    <div class="modal fade" id="supervisor_advisor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-body" id="body">



            </div>
        </div>
    </div>
    <script src=" {{ asset('js/advisors/advisors.js') }} "></script>
    @if(session('success'))
        <script>
            swal("Listo!", "Asesor Guardado con Exito!", "success")
                .then((value) => {
            }) 
        </script>
    @endif
@endsection
