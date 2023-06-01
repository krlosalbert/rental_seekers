@extends('layouts.reports')

@section('header_page')
    <div class="card border-left-primary shadow h-100 py-2 w-100">
        <h1 class="h3 mb-0 text-gray-800">Informe para pago al Asesor {{ $advisor->name_advisors }} {{ $advisor->lastname_advisors }}</h1>
    </div>
@endsection

@section('header_invoice')
    <div class="card-header">
        <b>Fecha: </b>
        <strong></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span class="float-right"> <strong><b>Estado:</b></strong> Cancelada</span>
    </div>
@endsection

@section('data_employee')
    <div class="col-6 col-md-4">
        <h6 class="mb-2"><b>Asesor</b></h6>
        <div>
            <strong>{{ $advisor->name_advisors }} {{ $advisor->lastname_advisors }}</strong>
        </div></br>
        <div><b>Direccion:</b> {{ $advisor->addres_advisors }}</div>
        <div><b>Email:</b> {{ $advisor->email_advisors }}</div>
        <div><b>Telefono:</b> {{ $advisor->phone_advisors }}</div>
    </div>
@endsection

@section('number_invoice')
    <h6 class="text-center"><b>Recibo No</b></h6>
@endsection

@section('field_change')
    <th class="text-center align-middle">Comision ($)</th>
@endsection

@section('fields_table')
    @foreach($sales as $sale)
        <tr>
            <td class="text-center">{{ $x += 1 }}</td>
            <td class="text-center">{{ $sale->service_name }}</td>
            <td class="text-center">{{ $sale->total }}</td>
            <td class="text-center">{{ number_format($sale->service_valor, 0, ',', '.') }}</td>
            <td class="text-center">{{ number_format($sale->service_commission, 0, ',', '.') }}</td>
            <td class="text-center">
                @php
                    $total_service = $sale->total*$sale->service_commission
                @endphp
                {{ number_format($total_service, 0, ',', '.') }}
            </td>
        </tr>
    @endforeach
@endsection

@section('js_reports')
    <script src=" {{ asset('js/reports/reports.js') }}" ></script>
@endsection
