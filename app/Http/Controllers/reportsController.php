<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\sales;
use App\Models\User;
use App\Models\supervisors;



class reportsController extends Controller
{
    //metodo para mostrar informes
    public function index(Request $request)
    {
        $date_start = $request->date_start_value;
        $date_end = $request->date_end_value;

        $amount_sale_general = (object) sales::whereBetween('date', [$date_start, $date_end])
        ->where('sales.service_id', '=', 1)
        ->count();

        $sales_general = (object) sales::select('services.valor as valor')
        ->join('services', 'sales.service_id', 'services.id')
        ->whereBetween('date', [$date_start, $date_end])
        ->where('sales.service_id', '=', 1)
        ->get();

        $amount_sale_special = (object) sales::whereBetween('date', [$date_start, $date_end])
        ->where('sales.service_id', '=', 2)
        ->count();

        $sales_special = (object) sales::select('services.valor as valor')
        ->join('services', 'sales.service_id', 'services.id')
        ->whereBetween('date', [$date_start, $date_end])
        ->where('sales.service_id', '=', 2)
        ->get();
        
        if($amount_sale_general != null || $amount_sale_special != null)
        {
            foreach($sales_general as $sale_general){ 

                foreach($sales_special as $sale_special){ 

                    $amount = $amount_sale_general->scalar;
                    $valor = $sale_general->valor;
        
                    $amount2 = $amount_sale_special->scalar;
                    $valor2 = $sale_special->valor;
        
                    $total = ($amount*$valor)+($amount2*$valor2);
                }
            }
        } 
       
        return response()->json([
            'amount_sale_general' => $amount_sale_general,
            'amount_sale_special' => $amount_sale_special,
            'total' => $total
            
        ]); 
        
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
