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