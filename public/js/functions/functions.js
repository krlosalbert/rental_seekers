//funcion para el encabezado del ajax
export function headerAjax(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}
//funcion para el datatable
export function datatables(x){
    $(x).DataTable({
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
    });
}