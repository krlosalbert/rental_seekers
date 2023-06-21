@extends('layouts.header')

@section('content')
    <div class="card d-flex justify-content-around flex-wrap" id="body_form">
        <div class="card-header" id="head_form">
            <h3>Ventas<h3>
        </div>
        <div class="table-responsive">
            <table class="table" id="tbl-sales">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Fecha</th>
                        <th class="text-center" scope="col">Responsable</th>
                        <th class="text-center" scope="col">Servicio</th>
                        <th class="text-center" scope="col">Accion</th>
                    </tr>
                </thead>
                @php
                    $x = 0;
                @endphp
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $x += 1; }}</td>
                            <td class="text-center">{{ $sale['date'] }}</td>
                            <td class="text-center">{{ $sale['advisor'] }}</td>
                            <td class="text-center">{{ $sale['service'] }}</td>
                            <td class="text-center">
                                <!-- button para visualizar detalles de los usuarios almacenados -->
                                <button class="btn btn-success btn_details_sales" id="btn_details_sales"data-toggle="modal" data-target="#details-sales" data-id="{{ $sale['sale_id'] }}_{{ $sale['service_number'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                    </svg>
                                </button>
                                <button class="btn btn-danger btn-delete" data-id="{{ $sale['sale_id'] }}">
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
            <div class="modal fade" id="details-sales" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-xl">
                    <div class="modal-content d-flex justify-content-center align-items-center">
                        <div class="modal-header w-100" id="head_form">
                            <h3 class="modal-title" id="exampleModalLabel"><b>Detalles de la venta</b></h3>
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
                <script type="module" src="{{ asset('js/sales/sales_view.js') }}"></script>
                @if(session('sale_general'))
                    <script>
                        swal("Listo!", "Venta General Guardada con Exito!", "success")
                    </script>
                @endif
                @if(session('sale_special'))
                    <script>
                        swal("Listo!", "Venta Personalizada guardada con Exito!", "success")
                    </script>
                @endif
            @endsection
        </div>
    </div>
@endsection

