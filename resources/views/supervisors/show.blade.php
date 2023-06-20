@if($delete == 2)
    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-bordered" id="table_advisors">
                <div class="selected-actions d-none">
                    <button class="btn btn-primary" id="select-all">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-all" viewBox="0 0 16 16">
                            <path d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992a.252.252 0 0 1 .02-.022zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486-.943 1.179z"/>
                        </svg>
                    </button>
                    <!-- Button trigger modal para editar -->
                    <button class="btn btn-warning" id="edit-selected">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg>
                    </button>
                </div>
                <thead>
                    <tr>
                        <th class="text-center align-middle"></th>
                        <th class="text-center align-middle">#</th>
                        <th class="text-center align-middle">Nombre del asesor</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $x = 0;
                    @endphp
                    @foreach($advisors as $advisor) 
                        <tr data-id="{{ $advisor->id_advisors }}">
                            <td class="text-center"></td>
                            <td class="text-center">{{ $x += 1 }}</td>
                            <td class="text-center">{{ $advisor->name_advisors }} {{$advisor->lastname_advisors }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            var table = $('#table_advisors').DataTable({
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
                },
                select: {
                    style: 'multi', // Permite la selección múltiple
                    selector: 'td:first-child input[type="checkbox"]' // Selector personalizado para las casillas de verificación
                },
                columnDefs: [{
                    'targets': 0, // Primera columna
                    'orderable': false, // No permite ordenar por esta columna
                    'className': 'text-center',
                    'render': function(data, type, row) {
                        return '<input type="checkbox" data-id="x-{{ $advisor->id_advisors }}">';
                    }
                }],
                'initComplete': function () {
                    // Evento de escucha de los checkboxes
                    $('#table_advisors tbody').on('change', 'input[type="checkbox"]', function (e) {
                        var checkbox = $(this);
                        var checkboxContainer = checkbox.closest('td');
                        var row = checkboxContainer.closest('tr');
                        var selectedActions = $('.selected-actions');

                        if (checkbox.is(':checked')) {
                            row.addClass('selected');
                        } else {
                            row.removeClass('selected');
                        }

                        var selectedRows = table.rows('.selected').nodes().length;

                        if (selectedRows > 0) {
                            selectedActions.removeClass('d-none');
                        } else {
                            selectedActions.addClass('d-none');
                        }
                    });

                    // Botón "Seleccionar todo"
                    $('#select-all').on('click', function () {
                        var checkboxes = $('#table_advisors tbody input[type="checkbox"]');
                        var isChecked = checkboxes.is(':checked');
                        var allChecked = checkboxes.length === checkboxes.filter(':checked').length;

                        if (isChecked && !allChecked) {
                            checkboxes.prop('checked', true);
                        } else {
                            checkboxes.prop('checked', false);
                        }
                        
                        checkboxes.trigger('change');
                    });

                }
            });
            // Botón "Editar"
            $('#edit-selected').on('click', function () {
                var selectedCheckboxes = $('#table_advisors tbody input[type="checkbox"]:checked');
                var clave = 1;
                // Obtener el ID de la fila seleccionada
                var ids = []; // Array para almacenar los IDs seleccionados
                
                selectedCheckboxes.each(function () {
                    var row = $(this).closest('tr');
                    var id = row.data('id');
                    ids.push(id); // Agregar el ID al array
                });

                console.log(ids);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "get",
                    url: `/supervisors/${clave}/edit`,
                    data: { ids: ids },
                    success: function(response) {
                        $('#form_update-advisors #body_form').html(response);
                        $('#form_update-advisors').modal('show'); // Mostrar el modal automáticamente
                    }
                });
            });
        });
    </script>
@else
    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-bordered" id="table_advisors">
                <thead>
                    <tr>
                        <th class="text-center align-middle">#</th>
                        <th class="text-center align-middle">Nombre del asesor</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $x = 0;
                    @endphp
                    @foreach($advisors as $advisor) 
                        <tr>
                            <td class="text-center">{{ $x += 1 }}</td>
                            <td class="text-center">{{ $advisor->name_advisors }} {{$advisor->lastname_advisors }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#table_advisors').DataTable({
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
        });
    </script>
@endif