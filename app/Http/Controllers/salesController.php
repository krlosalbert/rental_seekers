<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cities;
use App\Models\supervisors;
use App\Models\advisors;
use App\Models\banks;
use App\Models\accounts;
use App\Models\customers;
use App\Models\neighborhoods;
use App\Models\properties;
use App\Models\sales;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



class salesController extends Controller
{
    //metodo para ver las ventas registradas en la db
    public function view(){
        
        //instancio la clase para traer las ventas
        $sales = sales::select('*', 'sales.id as sale_id', 'services.name as service', 'users.name as advisor', 'sales.service_id as service_number')
        ->join('services', 'sales.service_id', '=', 'services.id')
        ->join('advisors', 'sales.advisor_id', '=', 'advisors.id')
        ->join('users', 'advisors.user_id', '=', 'users.id')
        ->get();
        //retono la variable a la vista
        return view('sales.view', compact('sales'));
    }

    //metodo para ver los detalles de la venta
    public function details_sales(Request $request)
    {
        //pregunto si es un servicio personalizado
        if($request->service == 2)
        {
            //instancio la clase para la consulta a la db
            $sales = sales::select(
                                    '*',
                                    'customers.name as name_customer',
                                    'customers.lastname as lastname_customer',
                                    'customers.phone as phone_customer',
                                    'services.name as name_service',
                                    'cities.name as name_city',
                                    'neighborhoods.name as name_neighborhood',
                                    'properties.name as name_property',
                                    'users.name as name_advisor',
                                    'users.lastname as lastname_advisor',
                                    'advisors.supervisor_id as id_supervisors',
                                    'banks.name as name_banks',
                                    'accounts.number as number_account',    
            )
            ->join('customers', 'sales.customer_id', '=', 'customers.id')
            ->join('services', 'sales.service_id', '=', 'services.id')
            ->join('cities', 'sales.city_id', '=', 'cities.id')
            ->join('neighborhoods', 'sales.neighborhood_id', '=', 'neighborhoods.id')
            ->join('properties', 'sales.property_id', '=', 'properties.id')
            ->join('advisors', 'sales.advisor_id', '=', 'advisors.id')
            ->join('accounts', 'sales.account_id', '=', 'accounts.id')
            ->join('banks', 'accounts.banks_id', '=', 'banks.id')
            ->join('users', 'advisors.user_id', '=', 'users.id')
            ->where('sales.id', '=', $request->id)
            ->get();

        }else{
            //pregunto si es una venta general
            if($request->service == 1)
            {
                //instancio la clase para consultar en la db
                $sales = sales::select(
                                        '*',
                                        'customers.name as name_customer',
                                        'customers.lastname as lastname_customer',
                                        'customers.phone as phone_customer',
                                        'services.name as name_service',
                                        'cities.name as name_city',
                                        'users.name as name_advisor',
                                        'users.lastname as lastname_advisor',
                                        'advisors.supervisor_id as id_supervisors',
                                        'banks.name as name_banks',
                                        'accounts.number as number_account',    
                )
                ->join('customers', 'sales.customer_id', '=', 'customers.id')
                ->join('services', 'sales.service_id', '=', 'services.id')
                ->join('cities', 'sales.city_id', '=', 'cities.id')
                ->join('advisors', 'sales.advisor_id', '=', 'advisors.id')
                ->join('accounts', 'sales.account_id', '=', 'accounts.id')
                ->join('banks', 'accounts.banks_id', '=', 'banks.id')
                ->join('users', 'advisors.user_id', '=', 'users.id')
                ->where('sales.id', '=', $request->id)
                ->get();
            }
        }
        //recorro el array para poder hallar el nombre del supervisor
        foreach($sales as $sale)
        {
            $supervisors = supervisors::select('users.name as name_supervisor', 'users.lastname as lastname_supervisor')
            ->join('users', 'supervisors.user_id', 'users.id')
            ->where('supervisors.id', '=', $sale->id_supervisors)
            ->get();
            //recorro el array de supervisor para poder mandarlo a la vista
            foreach($supervisors as $supervisor){}
        }
        return view('sales.details_sales', compact('sale', 'supervisor'));
    }

    //metodo para el formulario de ventas
    public function form()
    {
        $cities = cities::All();
        $supervisors = supervisors::select('*', 'supervisors.id as supervisor_id','users.name as name', 'users.lastname as lastname')
        ->join('users', 'supervisors.user_id', '=', 'users.id')
        ->get();
        $banks = banks::All();
        //dd($customers);
        //retorno los datos obtenidos a la vista
        return view('sales.form', compact('cities', 'supervisors', 'banks'));
    }

    /* metodo para obtener los barrios dependiendo de la ciudad seleccionada */
    public function get_neighborhoods(Request $request)
    {
        $neighborhoods = neighborhoods::select('*', 'neighborhoods.id as neighborhood_id','neighborhoods.name as name', 'cities.name as city_name')
        ->join('cities', 'neighborhoods.city_id', '=', 'cities.id')
        ->where('neighborhoods.city_id', '=', $request->cityId)
        ->get();
        return view('sales.neighborhoods', compact('neighborhoods'));
    }

    /* metodo para obtener los barrios dependiendo de la ciudad seleccionada */
    public function get_property(Request $request)
    {
        $properties = properties::All();
        return view('sales.properties', compact('properties'));
    }
 
    /* metodo para obtener los asesores dependiendo del supervisor seleccionado */
    public function get_advisors(Request $request)
    {
        $advisors = advisors::select('*', 'advisors.id as advisor_id','users.name as name', 'users.lastname as lastname')
        ->join('users', 'advisors.user_id', '=', 'users.id')
        ->where('advisors.supervisor_id', '=', $request->supervisorId)
        ->get();
        return view('sales.advisor', compact('advisors'));
    }

    /* metodo para obtener la cuentas dependiendo del banco seleccionado */
    public function get_accounts(Request $request)
    {
        $accounts = accounts::select('*', 'accounts.number as number')
        ->join('banks', 'accounts.banks_id', '=', 'banks.id')
        ->where('accounts.banks_id', '=', $request->bankId)
        ->get();
        return view('sales.accounts', compact('accounts'));
    }

    /* metodo para crear una nueva venta */
    public function create(Request $request)
    {
        //asigno a la variable la fecha actual
        $date = Carbon::now();

        //tomo los archivos que vienen y le asigno una variable
        $comprobante = $request->comprobante;
        $terminos = $request->terminos;

        //guardo el comprobante en el servidor y le asigno nombre
        $filename_comprobante = time() . '_' . $comprobante->getClientOriginalName();
        $comprobante->move(public_path('uploads'), $filename_comprobante);

        //guardo el archivo de terminos y condiciones y le asigno nombre
        $filename_terminos = time() . '_' . $terminos->getClientOriginalName();
        $terminos->move(public_path('uploads'), $filename_terminos);

        //asigno la ubicacion de los archivos a una variable para guardarlo en la db
        $name_comprobante = 'uploads/'. $filename_comprobante;
        $name_terminos = 'uploads/'. $filename_terminos;
        
        //pregunto si se mando el id del cliente
        if(!$request->has('id'))
        {
            //valido la informacion del cliente
            $customers = $request->validate([
                'new_customer'         => ['required', 'string'],
                'newlastname_customer' => ['required', 'string'],
                'new_phone_customers'  => ['required', 'integer'],
            ]);
            //creo el cliente en su respectiva tabla
            $customer = customers::create([
                'name'     => $customers['new_customer'],
                'lastname' => $customers['newlastname_customer'],
                'phone'    => $customers['new_phone_customers'] ,
            ]);
            
            //obtener el ultimo id del cliente recien registrado
            $lastregister = customers::latest()->latest()->value('id');

            //valido la informacion de la venta
            $sales = $request->validate([
                'type_sales' => ['required', 'integer'],
                'city'       => ['required', 'integer'],
                'supervisor' => ['required', 'integer'],
                'advisor'    => ['required', 'integer'],
                'banks'      => ['required', 'integer'],
                'accounts'   => ['required', 'integer'],
                'referencia' => ['required', 'string'],
            ]);
            
            // pregunto si es un tipo de venta personalizado
            if ($request->type_sales == 2 ){
                //valido el resto de informacion que se necesita para el registro en la db
                $sales_special = $request->validate([
                    'neighborhoods' => ['required', 'integer'],
                    'property'      => ['required', 'integer'],
                    'number_rooms'  => ['required', 'integer'],
                    'parking'       => ['required', 'integer'],
                    'cannon'        => ['required', 'numeric', 'min:0', 'regex:/^\d*(\.\d{1,2})?$/'],
                ]);

                // Crear un nueva venta personalizada
                $sale_special = sales::create([
                    'date'            => $date,
                    'city_id'         => $sales['city'],
                    'customer_id'     => $lastregister,
                    'neighborhood_id' => $sales_special['neighborhoods'],
                    'property_id'     => $sales_special['property'],
                    'number_rooms'    => $sales_special['number_rooms'],
                    'parking'         => $sales_special['parking'],
                    'advisor_id'      => $sales['advisor'],
                    'account_id'      => $sales['accounts'],
                    'canon'           => $sales_special['cannon'],
                    'referencia'      => $sales['referencia'],
                    'comprobante'     => $name_comprobante,
                    'terminos'        => $name_terminos,
                    'service_id'   => $sales['type_sales']
                ]);
                
                // Redireccionar al formulario
                return redirect()->route('view_sales')->with('sale_special', 'venta registrada con exito');

            }else{

                // pregunto si es un tipo de venta general
                if ($request->type_sales == 1 ){
                    
                    // Crear un nueva venta general
                    $sale_general = sales::create([
                        'date'          => $date,
                        'customer_id'   => $lastregister,
                        'city_id'       => $sales['city'],
                        'advisor_id'    => $sales['advisor'],
                        'account_id'    => $sales['accounts'],
                        'referencia'    => $sales['referencia'],
                        'comprobante'   => $name_comprobante,
                        'terminos'      => $name_terminos,
                        'service_id' => $sales['type_sales'],
                    ]);

                    // Redireccionar al formulario
                    return redirect()->route('view_sales')->with('sale_general', 'venta registrada con exito');

                }else{

                    //pregunto si el tipo de venta esta vacio es decir si es igual a 0
                    if ($request->type_sales == 0 ){  
                        
                        //redirecciono con un mensaje de error
                        return redirect()->route('form_sales')->with('success', 'venta registrada con exito');
                    }
                }//fin del segundo condicional de venta general
            }//fin del primer condicional de venta personalizada

        }else{
            //si el cliente no existe valido la informacion mandada por el formulario
            $sales = $request->validate([
                'type_sales' => ['required', 'integer'],
                'city' => ['required', 'integer'],
                'supervisor' => ['required', 'integer'],
                'advisor' => ['required', 'integer'],
                'banks' => ['required', 'integer'],
                'accounts' => ['required', 'integer'],
                'referencia' => ['required', 'string'],
            ]);
            
            // pregunto si es un tipo de venta personalizada
            if ($request->type_sales == 2 ){
                //valido el resto de la informacion para el registro en la db
                $sales_special = $request->validate([
                    'neighborhoods' => ['required', 'integer'],
                    'property'      => ['required', 'integer'],
                    'number_rooms'  => ['required', 'integer'],
                    'parking'       => ['required', 'integer'],
                    'cannon'        => ['required', 'numeric', 'min:0', 'regex:/^\d*(\.\d{1,2})?$/'],
                ]);

                // Crear un nueva venta personalizada
                $sale_special = sales::create([
                    'date'            => $date,
                    'city_id'         => $sales['city'],
                    'customer_id'     => $request->id,
                    'neighborhood_id' => $sales_special['neighborhoods'],
                    'property_id'     => $sales_special['property'],
                    'number_rooms'    => $sales_special['number_rooms'],
                    'parking'         => $sales_special['parking'],
                    'advisor_id'      => $sales['advisor'],
                    'account_id'      => $sales['accounts'],
                    'canon'           => $sales_special['cannon'],
                    'referencia'      => $sales['referencia'],
                    'comprobante'     => $name_comprobante,
                    'terminos'        => $name_terminos,
                    'service_id'   => $sales['type_sales']
                
                ]);

                // Redireccionar al formulario
                return redirect()->route('view_sales')->with('sale_special', 'venta registrada con exito');
            }else{
               // pregunto si es un tipo de venta general
               if ($request->type_sales == 1 ){

                    // Crear un nueva venta general
                    $sale_general = sales::create([
                        'date'          => $date,
                        'customer_id'   => $request->id,
                        'city_id'       => $sales['city'],
                        'advisor_id'    => $sales['advisor'],
                        'account_id'    => $sales['accounts'],
                        'referencia'    => $sales['referencia'],
                        'comprobante'   => $name_comprobante,
                        'terminos'      => $name_terminos,
                        'service_id' => $sales['type_sales'],
                    ]);

                    // Redireccionar al formulario
                    return redirect()->route('view_sales')->with('sale_general', 'venta registrada con exito');
                }else{

                    if ($request->type_sales == 0 ){
                        // Redireccionar al formulario
                        return redirect()->route('form_sales')->with('success', 'venta registrada con exito');
                    }
                }//fin del segundo condicional de venta general
            }//fin del primer condicional de venta personalizada
        }//fin del la validacion raiz si existe cliente registrado
    }//fin del metodo para crear la venta

    
    public function destroy($id)
    {
        $sale = sales::findOrFail($id);
        //pregunto su fue exitoso la eliminacion
        if ($sale->delete()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
