//modal para visualizar los detalles de las ventas
$(document).ready(function() {
    $('.btn_details_sales').click(function() {
        var datosBoton = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        var variables = datosBoton.split("_");//separarlos en un array
        var id = variables[0];
        var service = variables[1];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "/details_sales",
            data: { id: id, service: service },
            success: function(response) {
                $('#details-sales #body_form').html(response);
            }
        });
    });
});

/* mensaje de alerta de eliminacion de usuarios */
$('.btn-delete').click(function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    console.log(id);
    swal({
        title: "¿Estas Seguro?",
        text: "Una vez eliminado no se puede acceder a la informacion",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            swal("Listo!", "Venta Eliminada con Exito!", "success")
            .then((value) => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                 });
                $.ajax({
                    url: 'delete_sales/' + id,
                    type: 'DELETE',
                    success: function (data) {
                        if (data.success) {
                            window.location.replace('/view_sales'); 
                        } else {
                            swal('Error!','The record could not be deleted.','error');
                        }
                    }
                });
            }) 
        }
    });
    
});

//funcion de la datatables
$(document).ready(function () {
    $('#tbl-sales').DataTable({
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