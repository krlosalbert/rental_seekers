<div class="card shadow mb-4">
    @foreach($supervisors as $supervisor) 
        <div class="">
            <label><b>Nombre del Supervisor</b></label>
            <input class="text-center form-control" value="{{ $supervisor->name_supervisors }} {{$supervisor->lastname_supervisors }}"/>
        </div>
    @endforeach
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center align-middle">#</th>
                    <th class="text-center align-middle">Servicio</th>
                    <th class="text-center align-middle">No de ventas</th>
                    <th class="text-center align-middle">Valor de Venta ($)</th>
                    <th class="text-center align-middle">Comision ($)</th>
                    <th class="text-center align-middle">Total ($)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $x = 0;
                    $total_service = 0;
                @endphp
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
            </tbody>
        </table>
    </div>
</div>
<div>
    <button class="btn btn-warning reports-btn" data-id="{{ $id_advisors }}">
        Ver informacion mas especifica
    </button>
</div>

<script>
    //modal para especificaciones del asesor
    $(document).ready(function() {
        $('.reports-btn').click(function() {
            var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
            window.location.replace(`/advisors/${id}/reports`); 
        });
    });
</script>