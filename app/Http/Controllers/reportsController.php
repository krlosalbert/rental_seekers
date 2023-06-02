<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\sales;
use App\Models\User;
use App\Models\supervisors;
use Illuminate\Support\Facades\DB;

class reportsController extends Controller
{
    //metodo para mostrar informes
    public function index(Request $request)
    {
        //tomo las fechas que vienen de la vista para hacer el filtro
        $date_start = $request->date_start_value;
        $date_end = $request->date_end_value;
        $total = 0;

        //consulto las ventas generales
        $sales_general = sales::select('services.valor as valor')
        ->join('services', 'sales.service_id', 'services.id')
        ->whereBetween('date', [$date_start, $date_end])
        ->where('sales.advisor_id', '=', $request->id)
        ->where('sales.service_id', '=', 1)
        ->get();

        //consulto las ventas personalizadas
        $sales_special = sales::select('services.valor as valor')
        ->join('services', 'sales.service_id', 'services.id')
        ->whereBetween('date', [$date_start, $date_end])
        ->where('sales.advisor_id', '=', $request->id)
        ->where('sales.service_id', '=', 2)
        ->get();

        //instancio la clase para traer las ventas por asesor
        $sales = sales::select('services.name as service_name',
                                'services.valor as service_valor',
                                'services.commission as service_commission',
                                DB::raw('COUNT(*) as total'))
        ->join('services', 'sales.service_id', '=', 'services.id')
        ->whereBetween('date', [$date_start, $date_end])
        ->where('sales.advisor_id', '=', $request->id)
        ->groupBy('services.name', 'services.valor', 'services.commission') 
        ->get();
        
        //valido que la informacion traida no sea null
        if($sales_general != null || $sales_special != null)
        {
            $amount_general = count($sales_general);
            $amount_special = count($sales_special);

            foreach($sales_general as $sale_general){}
            foreach($sales_special as $sale_special){}
            
            $total = ($amount_general*$sale_general->valor)+($amount_special*$sale_special->valor);
           
            //retorno las variables a la vista
            return response()->json([
                'sales_general' => $sales_general,
                'sales_special' => $sales_special,
                'sales' => $sales,
                'total' => $total
            ]);              
        } 
    }

    // metodo para buscar al supervisor por el nombre
    public function search_supervisor(Request $request)
    {
        //obtener el id del supervisor 
        $user = User::where('users.name', 'LIKE', "%".$request->supervisor."%")->value('id');
        $supervisor = supervisors::findOrFail($user);

        dd($user);
        return view('reports.supervisors', compact('supervisors'));
        
    }
}
