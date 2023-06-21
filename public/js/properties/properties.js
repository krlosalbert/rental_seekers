import { headerAjax } from '../functions/functions.js';
import { datatables } from '../functions/functions.js';

/* modal para el formulario de nuevo inmueble */
$(document).ready(function() {

    var x = "#tbl-properties";
    datatables(x);

    $('.form-properties').click(function() {
        headerAjax();
        $.ajax({
            url: "/properties/create",
            success: function(response) {
                $('#form-properties #body_form').html(response);
            }
        });
    });

    /* modal para el formulario de edicion de la propiedad seleccionada */
    $('.form-update-properties').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        headerAjax();
        $.ajax({
            type: "get",
            url: `properties/${id}/edit`,
            success: function(response) {
                $('#form-update-properties #body_form').html(response);
            }
        });
    });
});

/* mensaje de alerta de eliminacion de la properpiedad */
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
                url: '/properties/' + id,
                type: 'DELETE',
                success: function (data) {
                    if (data.success) {
                        swal("Listo!", "Inmueble Eliminado con Exito!", "success")
                        .then((value) => {
                            window.location.replace('/properties'); 
                        });
                    } else {
                        swal('Error!','La ciudad no se pudo ser eliminada.','error');
                    }
                }
            });
        }
    });
});