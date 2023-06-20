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

/* modal para el formulario de edicion modificar el supervisor del asesor seleccionado */
$(document).ready(function() {
    $('.form_update-advisors').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url: `/advisors/${id}/edit`,
            success: function(response) {
                $('#form_update-advisors #body_form').html(response);
            }
        });
    });
});

