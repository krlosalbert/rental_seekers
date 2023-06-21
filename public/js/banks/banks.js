import { headerAjax } from '../functions/functions.js';
import { datatables } from '../functions/functions.js';

$(document).ready(function() {
    
    var x = "#tbl-banks";
    datatables(x);
    
    /* modal para el formulario de nuevo banco */
    $('.form-banks').click(function() {
        headerAjax();
        $.ajax({
            url: "/banks/create",
            success: function(response) {
                $('#form-banks #body_form').html(response);
            }
        });
    });

    /* modal para el formulario de edicion del banco seleccionado */
    $('.form-update-banks').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        headerAjax();
        $.ajax({
            type: "get",
            url: `/banks/${id}/edit`,
            success: function(response) {
                $('#form-update-banks #body_form').html(response);
            }
        });
    });
});

/* mensaje de alerta de eliminacion de bancos */
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
                url: 'banks/' + id,
                type: 'DELETE',
                success: function (data) {
                    if (data.success) {
                        swal("Listo!", "Banco Eliminado con Exito!", "success")
                        .then((value) => {
                            window.location.replace('/banks'); 
                        });
                    } else {
                        swal('Error!','El banco no se pudo ser eliminado.','error');
                    }
                }
            });
        }
    });
    
});