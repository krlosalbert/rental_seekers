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

date_end.addEventListener('change', () => {
  const date_start_value = date_start.value;
  const date_end_value = date_end.value;
      
  if(date_start_value != ""  && date_end_value != ""){
      
    fetch('/reports', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      body: JSON.stringify({
          date_start_value: date_start_value,
          date_end_value: date_end_value
      })
    })
    .then(response => response.json())
    .then(data => {
      const amount_sales_general = data.amount_sale_general;
      const amount_sales_special = data.amount_sale_special;
      const total = data.total;
      contenedor.innerHTML = amount_sales_general.scalar;
      contenedor2.innerHTML = amount_sales_special.scalar;
      valor.innerHTML = total.toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 });
    })
    .catch(error => {
        console.error('Error:', error);
    }); 
  }           
});

