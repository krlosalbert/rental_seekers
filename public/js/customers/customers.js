import { headerAjax } from '../functions/functions.js';

$(document).ready(function() {
    // modal para digitar el cliente que se va a buscar
    // Llamamos al botón del modal y le hacemos clic automáticamente
    $('#btn-customers').trigger('click');

    //para activar el modal y buscar los clientes
    $('#buscar-btn').click(function() {
        var search = $('#search').val();
        if(search === ''){
            swal({
                text: "Por favor, ingrese algo en el campo de búsqueda.",
                icon: "error",
            });
        }else{
            $('#modal-customers').modal('hide');
            headerAjax();
            $.ajax({
                type: "get",
                url: "/customers/" + search,
                success: function(response) {
                    $('#searchs-customers #body_form').html(response);
                    $('#searchs-customers').modal('show');
                }
            });
        }  
    }); 
});

