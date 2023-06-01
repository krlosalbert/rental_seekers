/* inicializa el modal */
$(document).ready(function() {
    // Llamamos al botón del modal y le hacemos clic automáticamente
    $('#btn-view_advisors').trigger('click');
});

//modal para visualizar los detalles de las ventas
$(document).ready(function() {
    $('.show_sales-btn').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url: "/advisors/" + id,
            success: function(response) {
                $('#show_sales #body_form').html(response);
            }
        });
    });
});


