import { headerAjax } from '../functions/functions.js';
import { datatables } from '../functions/functions.js';


/* modal para el formulario de nuevo rol */
$(document).ready(function() {
    var x = "#tbl-roles";
    datatables(x);
    
    $('.form-role').click(function() {
        headerAjax();
        $.ajax({
            url: "/roles/create",
            success: function(response) {
                $('#form-role #body_form').html(response);
            }
        });
    });

    /* modal para el formulario de edicion de rol */
    $('.form-update-role').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        headerAjax();
        $.ajax({
            type: "get",
            url: `/roles/${id}/edit`,
            success: function(response) {
                $('#form-update-role #body_form').html(response);
            }
        });
    });
});

/* mensaje de alerta de eliminacion de roles */
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
                url: 'roles/' + id,
                type: 'DELETE',
                success: function (data) {
                    if (data.success) {
                        swal("Listo!", "Rol Eliminado con Exito!", "success")
                        .then((value) => {
                            window.location.replace('/roles'); 
                            });
                    } else {
                        swal('Error!','El rol no pudo ser eliminado.','error');
                    }
                }
            }); 
        }
    });
});