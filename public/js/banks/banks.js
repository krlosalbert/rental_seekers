/* inicializar el modal de inicio automaticamente */
$(document).ready(function() {
    // Llamamos al botón del modal y le hacemos clic automáticamente
    $('#btn-view_banks').trigger('click');
});

/* modal para el formulario de nuevo banco */
$(document).ready(function() {
    $('.form-banks').click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/form_banks",
            success: function(response) {
                $('#form-banks #body_form').html(response);
            }
        });
    });
});

/* modal para el formulario de edicion del banco seleccionado */
$(document).ready(function() {
    $('.form-update-banks').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        console.log(id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "/form_update_banks",
            data: { id: id },
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
            swal("Listo!", "Banco Eliminado con Exito!", "success")
            .then((value) => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                 });
                $.ajax({
                    url: 'delete_banks/' + id,
                    type: 'DELETE',
                    success: function (data) {
                        if (data.success) {
                            window.location.replace('/view_banks'); 
                        } else {
                            swal('Error!','El banco no se pudo borrar.','error');
                        }
                    }
                });
            }) 
        }
    });
    
});