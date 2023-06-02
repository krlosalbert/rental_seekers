// obtener la fecha de inicio
const date_start = document.getElementById('date_start');

// obtener la fecha final
const date_end = document.getElementById('date_end');

//contenedor del elemento donde va el resultado
const contenedor = document.getElementById('amount');

//contenedor del elemento donde va el resultado
const contenedor2 = document.getElementById('amount2');

//contenedor del elemento donde va el resultado
const valor = document.getElementById('valor');

//obtener el id del asesor
const id_advisors = document.getElementById('id_advisors');

//obtener la tabla
const table = document.getElementById('table');

date_end.addEventListener('change', () => {
  const date_start_value = date_start.value;
  const date_end_value = date_end.value;
  const id = id_advisors.value;
      
  if(date_start_value != ""  && date_end_value != ""){
      
    fetch('/reports', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      body: JSON.stringify({
          date_start_value: date_start_value,
          date_end_value: date_end_value,
          id: id
      })
    })
    .then(response => response.json())
    .then(data => {
      /* declaro las variables y les asigno el valor que viene del controlador */
      const sales_general = data.sales_general;
      const sales_special = data.sales_special;
      const total = data.total;
      const sales = data.sales;
      /* const amount_general = sales_general.length;
      const amount_special = sales_special.length; */
      let x = 0;
      //pinto los html en la vista
      contenedor.innerHTML = sales_general.length;
      contenedor2.innerHTML = sales_special.length;
      valor.innerHTML = total.toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 });
      table.innerHTML = sales.map(sale => {
        let total_service = sale.total * sale.service_commission;
        return `<tr>
            <td class="text-center">${x += 1}</td>
            <td class="text-center">${sale.service_name}</td>
            <td class="text-center">${sale.total}</td>
            <td class="text-center">${sale.service_valor.toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 })}</td>
            <td class="text-center">${sale.service_commission.toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 })}</td>
            <td class="text-center">
                ${total_service.toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 })}
            </td>
        </tr>`;
      }).join('');
    })
    .catch(error => {
        console.error('Error:', error);
    }); 
  }           
});

