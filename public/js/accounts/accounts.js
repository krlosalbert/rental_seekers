import { headerAjax } from '../functions/functions.js';
import { datatables } from '../functions/functions.js';

$(document).ready(function() {
    
    var x = "#tbl-accounts";
    datatables(x);

    /* modal para el formulario de nuevo cuenta */
    $('.form-accounts').click(function() {
        headerAjax();
        $.ajax({
            url: "/accounts/create",
            success: function(response) {
                $('#form-accounts #body_form').html(response);
            }
        });
    });

    /* modal para el formulario de edicion de la cuenta seleccionada */
    $('.form-update-accounts').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        headerAjax();
        $.ajax({
            type: "get",
            url: `accounts/${id}/edit`,
            success: function(response) {
                $('#form-update-accounts #body_form').html(response);
            }
        });
    });
});

/* mensaje de alerta de eliminacion de las cuentas */
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
                url: '/accounts/' + id,
                type: 'DELETE',
                success: function (data) {
                    if (data.success) {
                        swal("Listo!", "Cuenta Eliminada con Exito!", "success")
                        .then((value) => {
                            window.location.replace('/accounts'); 
                        });
                    } else {
                        swal('Error!','La cuenta no se pudo ser eliminada.','error');
                    }
                }
            });
        }
    });
});