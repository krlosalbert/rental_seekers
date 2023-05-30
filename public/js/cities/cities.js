/* inicializar el modal de inicio automaticamente */
$(document).ready(function() {
    // Llamamos al botón del modal y le hacemos clic automáticamente
    $('#btn-view_cities').trigger('click');
});

/* modal para el formulario de nuevo ciudad */
$(document).ready(function() {
    $('.form-cities').click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/cities/create",
            success: function(response) {
                $('#form-cities #body_form').html(response);
            }
        });
    });
});

/* modal para el formulario de edicion de la ciudad seleccionada */
$(document).ready(function() {
    $('.form-update-cities').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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
            swal("Listo!", "Ciudad Eliminada con Exito!", "success")
            .then((value) => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                 });
                $.ajax({
                    url: '/cities/' + id,
                    type: 'DELETE',
                    success: function (data) {
                        if (data.success) {
                            window.location.replace('/cities'); 
                        } else {
                            swal('Error!','La ciudad no se pudo borrar.','error');
                        }
                    }
                });
            }) 
        }
    });
    
});