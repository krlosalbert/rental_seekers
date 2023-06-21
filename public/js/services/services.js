import { headerAjax } from '../functions/functions.js';
import { datatables } from '../functions/functions.js';

$(document).ready(function() {

    var x = "#tbl-services";
    datatables(x);

    /* modal para el formulario de nuevo servicio */
    $('.form-services').click(function() {
        headerAjax();
        $.ajax({
            url: "/services/create",
            success: function(response) {
                $('#form-services #body_form').html(response);
            }
        });
    });

    /* modal para el formulario de edicion de el servicio seleccionado */
    $('.form-update-services').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        headerAjax();
        $.ajax({
            type: "get",
            url: `services/${id}/edit`,
            success: function(response) {
                $('#form-update-services #body_form').html(response);
            }
        });
    });
});

/* mensaje de alerta de eliminacion de el servicio */
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
                url: '/services/' + id,
                type: 'DELETE',
                success: function (data) {
                    if (data.success) {
                        swal("Listo!", "Servicio Eliminado con Exito!", "success")
                        .then((value) => {
                            window.location.replace('/services'); 
                        });
                    } else {
                        swal('Error!','El servicio no se pudo borrar.','error');
                    }
                }
            });
        } 
    });
});