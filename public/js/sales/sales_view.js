import { headerAjax } from '../functions/functions.js';
import { datatables } from '../functions/functions.js';

//modal para visualizar los detalles de las ventas
$(document).ready(function() {

    var x = "#tbl-sales";
    datatables(x);

    $('.btn_details_sales').click(function() {
        var datosBoton = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        var variables = datosBoton.split("_");//separarlos en un array
        var id = variables[0];
        var service = variables[1];
        headerAjax();
        $.ajax({
            type: "get",
            url: "/sales/" + id,
            data: { service: service },
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
    swal({
        title: "¿Estas Seguro?",
        text: "Una vez eliminado no se puede acceder a la informacion",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
           headerAjax();
            $.ajax({
                url: 'sales/' + id,
                type: 'DELETE',
                success: function (data) {
                    if (data.success) {
                        swal("Listo!", "Venta Eliminada con Exito!", "success")
                        .then((value) => {
                            window.location.replace('/sales'); 
                        });
                    } else {
                        swal('Error!','La venta no pudo ser eliminada.','error');
                    }
                }
            });
        }
    });
});
