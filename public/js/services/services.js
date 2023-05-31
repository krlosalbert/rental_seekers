/* inicializar el modal de inicio automaticamente */
$(document).ready(function() {
    // Llamamos al botón del modal y le hacemos clic automáticamente
    $('#btn-view_services').trigger('click');
});

/* modal para el formulario de nuevo servicio */
$(document).ready(function() {
    $('.form-services').click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/services/create",
            success: function(response) {
                $('#form-services #body_form').html(response);
            }
        });
    });
});

/* modal para el formulario de edicion de el servicio seleccionado */
$(document).ready(function() {
    $('.form-update-services').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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
            swal("Listo!", "Servicio Eliminado con Exito!", "success")
            .then((value) => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                 });
                $.ajax({
                    url: '/services/' + id,
                    type: 'DELETE',
                    success: function (data) {
                        if (data.success) {
                            window.location.replace('/services'); 
                        } else {
                            swal('Error!','El servicio no se pudo borrar.','error');
                        }
                    }
                });
            }) 
        }
    });
    
});