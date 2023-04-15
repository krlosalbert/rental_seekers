// Detectar cuando se cambia la opción seleccionada en el select de bancos
neighborhoods_Select.addEventListener('change', () => {
    // Obtener el ID del banco seleccionado
    const neighborhood = neighborhoods_Select.value;
    console.log(neighborhood);
    
    // Si se seleccionó la opción "Seleccione", vaciar el select de las cuentas
    if (neighborhood === '0') {
        property_Select.innerHTML = '<option value="0">Seleccione</option>';
        return;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "post",
        url: '/get-property',
        data: { neighborhood: neighborhood },
        success: function(response) {
            $('#properties').html(response);
            
        }
    }); 
});
