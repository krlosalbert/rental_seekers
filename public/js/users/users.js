//modal para visualizar los detalles de los usuarios
$(document).ready(function() {
    $('.details-btn').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "/details_users",
            data: { id: id },
            success: function(response) {
                $('#details-users #body_form').html(response);
            }
        });
    });
});

//modal para editar los usuarios
$(document).ready(function() {
    $('.update-btn').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url: "/form_update_users",
            data: { id: id },
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
                    url: 'delete_users/' + id,
                    type: 'DELETE',
                    success: function (data) {
                        if (data.success) {
                            window.location.replace('/view_users'); 
                        } else {
                            swal('Error!','The record could not be deleted.','error');
                        }
                    }
                });
            }) 
        }
    });
    
});