import { headerAjax } from '../functions/functions.js';

//cuando el documento se carge se ejecuta lo siguiente
$(document).ready(function() {
    
    // Llamamos al botón del modal y le hacemos clic automáticamente
    $('#btn-view_supervisors').trigger('click');
    //boton para el formulario de nuevo supervisor
    $('.form-supervisors').click(function() {
        headerAjax();
        $.ajax({
            url: "/supervisors/create",
            success: function(response) {
                $('#form-supervisors #body_form').html(response);
            }
        });
    });

    //funcion para el modal de editar al supervisor
    $('.show_supervisors-btn').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        headerAjax();
        var clave = 1;
        $.ajax({
            type: "get",
            url: "/supervisors/" + id,
            data: {
                clave: clave
            },
            success: function(response) {
                $('#show_supervisors #body_form').html(response);
            }
        });
    });

    /* mensaje de alerta de sustitucion del supervior */
    $('.btn-delete').click(function () {
        var id = $(this).data('id');
        swal({
            title: "¿Estas Seguro?",
            text: "Para eliminar el supervisor debes asignarle primero uno nuevo a los asesores que tiene a cargo",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                headerAjax();
                var clave = 2;
                $.ajax({
                    type: "get",
                    url: "/supervisors/" + id,
                    data: {
                        clave: clave
                    },
                    //dataType: 'json', // Especificar el tipo de datos esperados como JSON
                    success: function(data) {
                        if (data.success) {
                            swal("Listo!", "Supervisor Eliminado con Exito!", "success")
                            .then((value) => {
                                window.location.replace('/supervisors'); // Redirigir a la página de supervisores
                            }) 
                        } else {
                            $('#show_supervisors #body_form').html(data);
                            $('#show_supervisors').modal('show'); // Mostrar el modal automáticamente
                            swal('Error!','El supervisor tiene todavia asesores a su cargo.','error');
                        }
                    }
                });
            } 
        });
    });

});
