import { headerAjax } from '../functions/functions.js';
import { datatables } from '../functions/functions.js';

$(document).ready(function() {
    
    var x = "#tbl-advisors";
    datatables(x);
    
    /* modal para el formulario de nuevo asesor*/
    $('.show_sales-btn').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        headerAjax();
        $.ajax({
            type: "get",
            url: "/advisors/" + id,
            success: function(response) {
                $('#show_sales #body_form').html(response);
            }
        });
    });

    /* modal para el formulario de edicion modificar el supervisor del asesor seleccionado */
    $('.form_update-advisors').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        headerAjax();
        $.ajax({
            type: "get",
            url: `/advisors/${id}/edit`,
            success: function(response) {
                $('#form_update-advisors #body_form').html(response);
            }
        });
    });
});

