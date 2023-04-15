@extends('layouts.header')

@section('content')
 
    <!-- Botón que activa el modal (lo puedes ocultar con CSS si no quieres mostrarlo) -->
    <button type="button" id="btn-customers" data-toggle="modal" data-target="#modal-customers" style="display: none;"></button>

    <!-- Modal para poder buscar los clientes -->
    <div class="modal fade" id="modal-customers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" id="head_form">
                    <h3 class="modal-title" id="myModalLabel">{{ __('Buscar Clientes') }}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="body_form">

                    <div class="d-flex w-auto">
                        <div class="d-inline w-100 ">
                            <input type="text" name="search" class="form-control" id="search" placeholder="Buscar...">
                        </div>
                        <div class="row mb-0">
                            <div>
                                <button class="btn btn-primary" id="buscar-btn" data-toggle="modal" data-target="#searchs-customers">
                                <b> {{ __('Buscar') }} </b>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para ver los clientes en la db -->
    <div class="modal fade" id="searchs-customers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" id="head_form">
                    <h3 class="modal-title" id="myModalLabel">{{ __('Clientes') }}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="body_form">

                    <!-- el contenido va aqui -->

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/customers/customers.js') }}"></script>
@endsection