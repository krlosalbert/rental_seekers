/* inicializa el modal */
$(document).ready(function() {
    // Llamamos al botón del modal y le hacemos clic automáticamente
    $('#btn-view_advisors').trigger('click');
});

//modal para visualizar los supervisores de los asesores
$(document).ready(function() {
    $('.supervisor-btn').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        console.log(id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "/supervisor_advisor",
            data: { id: id },
            success: function(response) {
                $('#supervisor_advisor #body').html(response);
                console.log(response);
            }
        });
    });
});

//funcion de la datatables
$(document).ready(function () {
    $('#tbl-advisors').DataTable({
        'lengthMenu' : [[ 3, 6, 9, -1], [ 3, 6, 9, "All"]],
        'pageLength': 3,
        'language': { 
            "paginate": {
                "previous": "Anterior",
                "next": "Siguiente"
            },
            "lengthMenu": "Mostrar _MENU_ registros",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "search": "Buscar:",
            "emptyTable": "No hay datos disponibles en la tabla",
            "infoEmpty": "Mostrando 0 a 0 de 0 registros"
        }
    });
});