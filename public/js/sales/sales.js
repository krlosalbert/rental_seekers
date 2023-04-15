// obtener el supervisor seleccionado
const supervisorSelect = document.getElementById('supervisor');

// obtener el bancos seleccionado
const bankSelect = document.getElementById('banks');

// obtener el tipo de venta seleccionada
const type_sales_Select = document.getElementById('type_sales');

// obtener la ciudad seleccionada
const city_Select = document.getElementById('city');

// obtener el barrio seleccionado
const neighborhoods_Select = document.getElementById('neighborhoods');

// obtener el tipo de inmueble seleccionado
const property_Select = document.getElementById('property');

// obtener el numero de habitaciones seleccionada
const number_rooms_Select = document.getElementById('number_rooms');

// obtener el parqueadero seleccionado
const parking_Select = document.getElementById('parking');

// obtener el cannon seleccionado
cannon_Select = document.getElementById('cannon');

// Detectar cuando se cambia la opción seleccionada en el select de supervisor
supervisorSelect.addEventListener('change', () => {
// Obtener el ID del supervisor seleccionado
    const supervisorId = supervisorSelect.value;
    
    // Si se seleccionó la opción "Seleccione", vaciar el select de asesor
    if (supervisorId === '0') {
        advisorSelect.innerHTML = '<option value="0">Seleccione</option>';
        return;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "post",
        url: '/get-advisors',
        data: { supervisorId: supervisorId },
        success: function(response) {
            $('#advisors').html(response);
            
        }
    }); 

    /* fetch(`/get-advisors/${supervisorId}`)
    .then(response => response.json())
    .then(advisors => {
        const executiveSelect = document.getElementById('executive');
        executiveSelect.innerHTML = '<option value="0">Seleccione</option>';
        advisors.forEach(advisor => {
            const option = document.createElement('option');
            option.value = advisor.id;
            option.text = advisor.name;
            executiveSelect.appendChild(option);
        });
    }); */
});


// Detectar cuando se cambia la opción seleccionada en el select de bancos
bankSelect.addEventListener('change', () => {
// Obtener el ID del banco seleccionado
    const bankId = bankSelect.value;
    
    // Si se seleccionó la opción "Seleccione", vaciar el select de las cuentas
    if (bankId === '0') {
        accountSelect.innerHTML = '<option value="0">Seleccione</option>';
        return;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "post",
        url: '/get-accounts',
        data: { bankId: bankId },
        success: function(response) {
            $('#accounts').html(response);
            
        }
    }); 
});

// Detectar cuando se cambia la opción seleccionada en el select de type ventas
type_sales_Select.addEventListener('change', () => {
    // Obtener el ID del tipo de venta seleccionada
    const type_sales = type_sales_Select.value;
    
    // Si se seleccionó la opción "Seleccione", vaciar el select de los barrios
    if (type_sales === '0') {
        neighborhoods_Select.setAttribute("readOnly", "true");
        property_Select.setAttribute("readOnly", "true");
        number_rooms_Select.setAttribute("readOnly", "true");
        parking_Select.setAttribute("readOnly", "true");
        cannon_Select.setAttribute("readOnly", "true");
        neighborhoods_Select.innerHTML = '<option value="0">Seleccione</option>';
        property_Select.innerHTML = '<option value="0">Seleccione</option>';
        number_rooms_Select.innerHTML = '<option value="0">Seleccione</option>';
        parking_Select.innerHTML = '<option value="0">Seleccione</option>';
        return;
    } 

    // Si se seleccionó la opción "General", no mostrar los barrios
    if (type_sales === '1') {
        neighborhoods_Select.setAttribute("readOnly", "true");
        property_Select.setAttribute("readOnly", "true");
        number_rooms_Select.setAttribute("readOnly", "true");
        parking_Select.setAttribute("readOnly", "true");
        cannon_Select.setAttribute("readOnly", "true");
        neighborhoods_Select.innerHTML = '<option value="0">Seleccione</option>';
        property_Select.innerHTML = '<option value="0">Seleccione</option>';
        number_rooms_Select.innerHTML = '<option value="0">Seleccione</option>';
        parking_Select.innerHTML = '<option value="0">Seleccione</option>';
        return;
    } 

    // Si se seleccionó la opción "Perzonalizado", Mostrar los barrios dependiendo de la ciudad
    if (type_sales === '2') {
        neighborhoods_Select.removeAttribute("readOnly");
        property_Select.removeAttribute("readOnly");
        number_rooms_Select.removeAttribute("readOnly");
        parking_Select.removeAttribute("readOnly");
        cannon_Select.removeAttribute("readOnly");

        number_rooms_Select.innerHTML = `<option value="0">Seleccione</option> 
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>`;

        parking_Select.innerHTML = `<option value="0">Seleccione</option> 
                                    <option value="1">SI</option>
                                    <option value="2">NO</option>`;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "post",
            url: '/get_property',
            success: function(response) {
                $('#property').html(response);    
            }
        }); 

        // Detectar cuando se cambia la opción seleccionada en el select de type ventas
        city_Select.addEventListener('change', () => {
            // Obtener el ID del banco seleccionado
            const cityId = city_Select.value;
            console.log(cityId);
            
            if (cityId === '0') {
                neighborhoods_Select.innerHTML = '<option value="0">Seleccione</option>';
                return;
            }
        
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: '/get-neighborhoods',
                data: { cityId : cityId },
                success: function(response) {
                    $('#neighborhoods').html(response);    
                }
            }); 

        });

    } 
});






    
