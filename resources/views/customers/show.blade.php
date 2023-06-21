<table class="table table-center" id="table_customers">
    <thead>
        <tr>
            <th class="text-center" scope="col">#</th>
            <th class="text-center" scope="col">Nombres</th>
            <th class="text-center" scope="col">Apellidos</th>
            <th class="text-center" scope="col">Telefono</th>
            <th class="text-center" scope="col">Accion</th>
        </tr>
    </thead>
    <tbody>
        @php
            $x = 0;
        @endphp
        @foreach ($customers as $customer)
        <tr>
            <td>{{ $x += 1; }}</td>
            <td class="text-center lowercase">{{ $customer->name }}</td>
            <td class="text-center lowercase">{{ $customer->lastname }}</td>
            <td class="text-center lowercase">{{ $customer->phone}}</td>
            <td class="text-center lowercase">
                <form action="{{ route('customers.choose')}}" method="post">
                    @csrf
                    <input type="hidden" value="{{ $customer->id }}" name="id"/>
                    <!-- Button trigger modal -->
                    <button type="submit" class="btn btn-success btn-customers">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-align-middle" viewBox="0 0 16 16">
                            <path d="M6 13a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v10zM1 8a.5.5 0 0 0 .5.5H6v-1H1.5A.5.5 0 0 0 1 8zm14 0a.5.5 0 0 1-.5.5H10v-1h4.5a.5.5 0 0 1 .5.5z"/>
                        </svg>
                    </button>
                </form>   
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<table>
    <tbody>
        <tr>
            <td colspan="3" ></td>
            <td colspan="2" >
                <button  type="button" class="btn btn-secondary btn-no_customers">
                    Cliente no existe
                </button>
            </td>
        </tr>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#table_customers').DataTable({
            'lengthMenu' : [[ 5, 10, 15, -1], [ 5, 10, 15, "Todo"]],
            'pageLength': 5,
            'language': { 
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sSearch": "Buscar:",
                "sEmptyTable": "No hay datos disponibles en la tabla",
                "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
                "sInfoEmpty":      "Mostrando 0 a 0 de 0 registros",
                "sInfoFiltered":   "(filtrado de _MAX_ registros en total)",
                "sInfoPostFix":    "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "sProcessing":     "Procesando...",
                "sZeroRecords":    "No se encontraron registros",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "select": {
                    "rows": {
                        "_": "Seleccionado %d filas",
                        "0": "Ninguna fila seleccionada",
                        "1": "Seleccionado 1 fila"
                    }
                } 
            }
        });

        //para dirigir a la pagina del formulario sin registrar clientes
        $('.btn-no_customers').click(function() {
            window.location.replace('/form_sales'); // Redirigir a la página de supervisores
        });
    });
</script>