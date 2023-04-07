/* inicializar el modal de inicio automaticamente */
$(document).ready(function() {
    // Llamamos al botón del modal y le hacemos clic automáticamente
    $('#btn-view_roles').trigger('click');
});

/* modal para el formulario de nuevo rol */
$(document).ready(function() {
    $('.form-role').click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/form_roles",
            success: function(response) {
                $('#form-role #body_form').html(response);
            }
        });
    });
});

/* modal para el formulario de edicion de rol */
$(document).ready(function() {
    $('.form-update-role').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        console.log(id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "/form_update_roles",
            data: { id: id },
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
            swal("Listo!", "Usuario Eliminado con Exito!", "success")
            .then((value) => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                 });
                $.ajax({
                    url: 'delete_roles/' + id,
                    type: 'DELETE',
                    success: function (data) {
                        if (data.success) {
                            window.location.replace('/view_roles'); 
                        } else {
                            swal('Error!','The record could not be deleted.','error');
                        }
                    }
                });
            }) 
        }
    });
    
});