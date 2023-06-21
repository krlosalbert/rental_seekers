import { headerAjax } from '../functions/functions.js';
import { datatables } from '../functions/functions.js';

$(document).ready(function() {
    
    var x = "#tbl-cities";
    datatables(x);
    
    /* modal para el formulario de nuevo ciudad */
    $('.form-cities').click(function() {
        headerAjax();
        $.ajax({
            url: "/cities/create",
            success: function(response) {
                $('#form-cities #body_form').html(response);
            }
        });
    });

    /* modal para el formulario de edicion de la ciudad seleccionada */
    $('.form-update-cities').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        headerAjax();
        $.ajax({
            type: "get",
            url: `cities/${id}/edit`,
            success: function(response) {
                $('#form-update-cities #body_form').html(response);
            }
        });
    });
});

/* mensaje de alerta de eliminacion de la ciudad */
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
                url: '/cities/' + id,
                type: 'DELETE',
                success: function (data) {
                    if (data.success) {
                        swal("Listo!", "Ciudad Eliminada con Exito!", "success")
                        .then((value) => {
                            window.location.replace('/cities'); 
                        });
                    } else {
                        swal('Error!','La ciudad no se pudo ser eliminada.','error');
                    }
                }
            });
        }
    });
});