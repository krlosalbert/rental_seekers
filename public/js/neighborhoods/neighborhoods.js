/* inicializar el modal de inicio automaticamente */
$(document).ready(function() {
    // Llamamos al botón del modal y le hacemos clic automáticamente
    $('#btn-view_neighborhoods').trigger('click');
});

/* modal para el formulario de un nuevo barrio */
$(document).ready(function() {
    $('.form-neighborhoods').click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/neighborhoods/create",
            success: function(response) {
                $('#form-neighborhoods #body_form').html(response);
            }
        });
    });
});

/* modal para el formulario de edicion de un barrio seleccionado */
$(document).ready(function() {
    $('.form-update-neighborhoods').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        console.log(id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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
            swal("Listo!", "Barrio Eliminado con Exito!", "success")
            .then((value) => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                 });
                $.ajax({
                    url: '/neighborhoods/' + id,
                    type: 'DELETE',
                    success: function (data) {
                        if (data.success) {
                            window.location.replace('/neighborhoods'); 
                        } else {
                            swal('Error!','el barrio no se pudo borrar.','error');
                        }
                    }
                });
            }) 
        }
    });
    
});