/* inicializa el modal */
$(document).ready(function() {
    // Llamamos al botón del modal y le hacemos clic automáticamente
    $('#btn-view_advisors').trigger('click');
});

//modal para visualizar los supervisores de los asesores
$(document).ready(function() {
    $('.supervisor-btn').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        console.log(id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "/supervisor_advisor",
            data: { id: id },
            success: function(response) {
                $('#supervisor_advisor #body').html(response);
                console.log(response);
            }
        });
    });
});