import { headerAjax } from '../functions/functions.js';
import { datatables } from '../functions/functions.js';

//modal para visualizar los detalles de los usuarios
$(document).ready(function() {

    var x = "#tbl-users";
    datatables(x);
    
    $('.details-btn').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        headerAjax();
        $.ajax({
            type: "get",
            url: "/users/" + id,
            success: function(response) {
                $('#details-users #body_form').html(response);
            }
        });
    });

    //modal para editar los usuarios
    $('.update-btn').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        headerAjax();
        $.ajax({
            type: "get",
            url: `/users/${id}/edit`,
            success: function(response) {
                $('#update-users #body_form').html(response);
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
        text: "El usuario no va a ser eliminado solo va estar en estado inactivo.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            headerAjax();
            $.ajax({
                url: 'users/' + id,
                type: 'DELETE',
                success: function (data) {
                    if (data.success) {
                        swal("Listo!", "Usuario fue inactivado con Exito!", "success")
                        .then((value) => {
                            window.location.replace('/users'); 
                        }) 
                    } else {
                        swal('Error!','El usuario no pudo ser inactivado.','error');
                    }
                }
            });
            
        }
    });
});