@section('css')
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
@endsection

<table class="table table-center" id="tbl-customers">
    <thead class="thead-dark">
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
                <form action="{{ route('choose_customers')}}" method="post">
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
                <a  type="button" class="btn btn-secondary" href="{{ route('form_sales') }}">
                    Cliente no existe
                </a>
            </td>
        </tr>
    </tbody>
</table>

<script src="{{ asset('js/datatables.min.js') }}"></script>
<script src="{{ asset('js/bootstrapDatatables.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#tbl-customers').DataTable({
            'lengthMenu' : [[ 3, 6, 9, -1], [ 3, 6, 9, "All"]],
            'pageLength': 3,
            'language': { 
                "paginate": {
                    "previous": "Anterior",
                    "next": "Siguiente"
                },
                "lengthMenu": "Mostrar _MENU_ registros",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "search": "Buscar:"
            }
        });
    });
</script>