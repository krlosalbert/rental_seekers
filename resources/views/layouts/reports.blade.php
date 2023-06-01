@extends('layouts.header')

@section('content')
    <!-- Encabezado de la pagina -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        @yield('header_page')<!-- aqui va el mensaje principal de la pagina -->
       
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            Generar reporte
        </a>
    </div><!-- fin del encabezado de la pagina -->

    <!-- Content Row -->
    <div class="row">
        <!-- targeta de ingresos mensuales-->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Fecha de inicio
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <input type="date" class="form-control" id="date_start" name="date_start"/>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- fin de la primera targeta -->

        <!-- Targeta de ingresos anuales -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Fecha de fin
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <input type="date" class="form-control" id="date_end" name="date_end"/>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- fin de la segunda targeta -->

        <!-- Pocentajes -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total ingresos
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="valor">$0</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- fin de la tercera targeta -->

        <!-- targeta de pendientes -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="row no-gutters align-items-center d-flex">
                                <div class="col-auto d-inline">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        General
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="amount">
                                        0
                                    </div>
                                </div>
                                <div class="col-auto d-inline ml-5">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Personalizado
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="amount2">
                                        0
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- fin de la segunda targeta -->
    </div><!-- fin de la primera fila contenedora de la informacion -->

    <!-- Content Row -->
    <div class="row">

        <div class="wrapper col-12">
            <div id="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card animate__animated animate__fadeIn">

                            @yield('header_invoice') <!-- aqui va el encabezado de la factura -->

                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-6 col-md-4">
                                        <h6 class="mb-2"><b>Empresa</b></h6>
                                        <div>
                                            <strong>Buscadores de arriendos</strong>
                                        </div></br>
                                        <div><b>Direccion:</b> Bucaramanga</div>
                                        <div><b>Email:</b> info@webz.com.pl</div>
                                        <div><b>Telefono:</b> +57 314 666 3333</div>
                                    </div>

                                    @yield('data_employee')<!-- aqui van los datos del trabajador -->

                                    <div class="col-6 col-md-4">
                                        <h5 class="text-center">
                                            <img class="mr-auto p-2 " width="200px" height= "50px" alt="..." src="{{ asset('images/Logo.jpg') }}">
                                        </h5> 
                                        @yield('number_invoice') <!-- numero del recibo -->
                                    </div>
                                </div>
                                <div class="table-responsive-sm">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center align-middle">#</th>
                                                <th class="text-center align-middle">Servicio</th>
                                                <th class="text-center align-middle">No de ventas</th>
                                                <th class="text-center align-middle">Valor de Venta ($)</th>
                                                @yield('field_change') <!-- dato de la tabla que cambia -->
                                                <th class="text-center align-middle">Total ($)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $x = 0;
                                                $total_service = 0;
                                            @endphp
                                            @yield('fields_table')<!-- campos de la tabla -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8 col-sm-5">

                                    </div>
                                    <div class="col-lg-4 col-sm-5 ml-auto">
                                        <table class="table table-sm table-clear">
                                            <tbody>
                                                <tr>
                                                    <td class="left">
                                                        <strong>Subtotal</strong>
                                                    </td>
                                                    <td class="text-right bg-light"></td>
                                                </tr>
                                                <tr>
                                                    <td class="left">
                                                        <strong>Descuento</strong>
                                                    </td>
                                                    <td class="text-right bg-light">$ 0</td>
                                                </tr>
                                                <tr>
                                                    <td class="left">
                                                        <strong>Costo de Envio</strong>
                                                    </td>
                                                    <td class="text-right bg-light"></td>
                                                </tr>
                                                <tr>
                                                    <td class="left">
                                                        <strong>Total</strong>
                                                    </td>
                                                    <td class="text-right bg-light">
                                                        <strong></strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('js_reports')
@endsection