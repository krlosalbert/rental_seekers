/* inicializar el modal de inicio automaticamente */
$(document).ready(function() {
    // Llamamos al botón del modal y le hacemos clic automáticamente
    $('#btn-view_properties').trigger('click');
});

/* modal para el formulario de nuevo inmueble */
$(document).ready(function() {
    $('.form-properties').click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/properties/create",
            success: function(response) {
                $('#form-properties #body_form').html(response);
            }
        });
    });
});

/* modal para el formulario de edicion de la propiedad seleccionada */
$(document).ready(function() {
    $('.form-update-properties').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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
    console.log(id);
    swal({
        title: "¿Estas Seguro?",
        text: "Una vez eliminado no se puede acceder a la informacion",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            swal("Listo!", "Inmueble Eliminado con Exito!", "success")
            .then((value) => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                 });
                $.ajax({
                    url: '/properties/' + id,
                    type: 'DELETE',
                    success: function (data) {
                        if (data.success) {
                            window.location.replace('/properties'); 
                        } else {
                            swal('Error!','La ciudad no se pudo borrar.','error');
                        }
                    }
                });
            }) 
        }
    });
    
});