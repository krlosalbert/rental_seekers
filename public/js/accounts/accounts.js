/* inicializar el modal de inicio automaticamente */
$(document).ready(function() {
    // Llamamos al botón del modal y le hacemos clic automáticamente
    $('#btn-view_accounts').trigger('click');
});

/* modal para el formulario de nuevo cuenta */
$(document).ready(function() {
    $('.form-accounts').click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/create_accounts",
            success: function(response) {
                $('#form-accounts #body_form').html(response);
            }
        });
    });
});

/* modal para el formulario de edicion de la cuenta seleccionada */
$(document).ready(function() {
    $('.form-update-accounts').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        console.log(id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "/form_update_accounts",
            data: { id: id },
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
            swal("Listo!", "Cuenta Eliminada con Exito!", "success")
            .then((value) => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                 });
                $.ajax({
                    url: 'delete_accounts/' + id,
                    type: 'DELETE',
                    success: function (data) {
                        if (data.success) {
                            window.location.replace('/view_accounts'); 
                        } else {
                            swal('Error!','La cuenta no se pudo borrar.','error');
                        }
                    }
                });
            }) 
        }
    });
    
});