// modal para digitar el cliente que se va a buscar
$(document).ready(function() {
    // Llamamos al botón del modal y le hacemos clic automáticamente
    $('#btn-customers').trigger('click');
});

//para activar el modal y buscar los clientes
$(document).ready(function() {
    $('#buscar-btn').click(function() {
        var search = $('#search').val();
        console.log(search);
        //cerrar el modal anterior
        $('#modal-customers').modal('hide');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "/search_customers",
            data: { search: search },
            success: function(response) {
            $('#searchs-customers #body_form').html(response);
            }
        });
    });
});

