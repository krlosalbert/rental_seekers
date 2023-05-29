@extends('layouts.header')

@section('content')

    <!-- Encabezado de la pagina -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Informe General</h1>
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
                                <!-- <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div> -->
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

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

            <!-- Targeta para los supervisores -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Comisiones Supervisores</h6>
                </div>
                <div class="card-body" id="supervisors">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Supervisor
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <form action="{{ route('search_supervisor') }}" method="POST">
                        @csrf
                        <input type="text" class="form-control" name="supervisor"/>
                        <button class="btn btn-success" type="submit">
                            Buscar
                        </button>
                    </form>
                </div>
                
                <!--  <h4 class="small font-weight-bold">
                        Server Migration 
                        <span class="float-right">20%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div> -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">#</th>
                                <th class="text-center align-middle">No de ventas</th>
                                <th class="text-center align-middle">Valor de Venta</th>
                                <th class="text-center align-middle">Porcentaje</th>
                                <th class="text-center align-middle">Valor a pagar</th>
                            </tr>
                        </thead>
                        <tbody id="table-supervisor">
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">2</td>
                                <td class="text-center">$50.000</td>
                                <td class="text-center">10%</td>
                                <td class="text-center">$50.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- fin del primer modulo de informacion -->

            <!-- otro modulo para informacion-->
            <div class="row">
            <!--<div class="col-lg-6 mb-4">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            Primary
                            <div class="text-white-50 small">#4e73df</div>
                        </div>
                    </div>
                </div> -->
            </div>

        </div><!-- fin de la primera columna de informacion -->

        <!-- segunda columna de informacion -->
        <div class="col-lg-6 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Comisiones Asesores</h6>
                </div>
                <div class="card-body">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Asesores
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <form action="{{ route('search_supervisor') }}" method="POST">
                        @csrf
                        <input type="text" class="form-control" name="supervisor"/>
                        <button class="btn btn-success" type="submit">
                            Buscar
                        </button>
                    </form>
                </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">#</th>
                                <th class="text-center align-middle">No de ventas</th>
                                <th class="text-center align-middle">Valor de Venta</th>
                                <th class="text-center align-middle">Porcentaje</th>
                                <th class="text-center align-middle">Valor a pagar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">2</td>
                                <td class="text-center">$50.000</td>
                                <td class="text-center">10%</td>
                                <td class="text-center">$50.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- otro modulo para informacion -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><!-- aqui va el titulo --></h6>
                </div>
                <div class="card-body">
                    <!-- aqui va el contenido -->
                </div>
            </div>

        </div><!-- fin de la segunda columna de informacion -->
    </div><!-- fin de la fila de contenedora de la informacion -->

    <script src=" {{ asset('js/informes/informes.js') }}" ></script>
@endsection