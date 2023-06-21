import { headerAjax } from '../functions/functions.js';
import { datatables } from '../functions/functions.js';

$(document).ready(function() {

    var x = "#tbl-neighborhoods";
    datatables(x);
    
    /* modal para el formulario de un nuevo barrio */
    $('.form-neighborhoods').click(function() {
        headerAjax();
        $.ajax({
            url: "/neighborhoods/create",
            success: function(response) {
                $('#form-neighborhoods #body_form').html(response);
            }
        });
    });

    /* modal para el formulario de edicion de un barrio seleccionado */
    $('.form-update-neighborhoods').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        headerAjax();
        $.ajax({
            type: "get",
            url: `neighborhoods/${id}/edit`,
            success: function(response) {
                $('#form-update-neighborhoods #body_form').html(response);
            }
        });
    });
});

/* mensaje de alerta de eliminacion de los barrios */
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
                url: '/neighborhoods/' + id,
                type: 'DELETE',
                success: function (data) {
                    if (data.success) {
                        swal("Listo!", "Barrio Eliminado con Exito!", "success")
                        .then((value) => {
                            window.location.replace('/neighborhoods'); 
                        });
                    } else {
                        swal('Error!','el barrio no se pudo borrar.','error');
                    }
                }
            });
        }
    }); 
});