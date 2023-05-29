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
      
    fetch('/view_informe', {
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


//contenedor del elemento donde esta el supervisor a buscar
const supervisors = document.getElementById('supervisor');

//contenedor del elemento donde va el resultado
const table_supervisor = document.getElementById('table-supervisor');

/* Buscador de supervisores */
$('#btn-supervisor').click(function (e) {
  const supervisor = supervisors.value;

  if(supervisor != ""){

   /* $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        type: "post",
        url: "/search_supervisor",
        data: { supervisor: supervisor },
        success: function(response) {
            $('#table-supervisor').html(response);
        }
    });
 */
    fetch('/search_supervisor', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      body: JSON.stringify({
        supervisor: supervisor
      })
    })
    .then(response => response.json())
    .then(data => {
      console.log(data);
      /* const amount_sales_general = data.amount_sale_general;
      const amount_sales_special = data.amount_sale_special;
      const total = data.total;
      contenedor.innerHTML = amount_sales_general.scalar;
      contenedor2.innerHTML = amount_sales_special.scalar;
      valor.innerHTML = total.toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0  });
  */
    
    /* .then(sales => {
        
      sales.forEach(sale => {
        sale.forEach(datos => {
          console.log(datos);
          contenedor.innerHTML = datos.id ;
        });
      });     */         
    })
    .catch(error => {
        console.error('Error:', error);
    }); 
 
  }else{
    swal("Error!", "Campo vacio", "error");
  }

});

/* Buscador de supervisores */
$('.btn-supervisor').click(function (e) {
  
  //contenedor del elemento donde esta el nombre
  const search_supervisor = document.getElementById('search-supervisor');
  const value_supervisor = search_supervisor.value;
  swal("Listo!", value_supervisor, "success");

});
    /* $(document).ready(function() {
      async function obtenerDatos() {  */
    /*  try {
      const respuesta = await axios.post('App\Http\Controllers\informesController@supervisors', {
        parametro1: date_start_value,
        parametro2: date_end_value
      });
      
      const contenedor = document.getElementById('amount');

      let html = '';
      
      datos.forEach((dato) => {
        html += `<p>${dato}</p>`;
      });
      
      contenedor.innerHTML = html;

    } catch (error) {
      console.error(error);
    } */