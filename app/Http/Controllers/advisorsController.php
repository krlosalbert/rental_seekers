<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\advisors;
use App\Models\supervisors;
use App\Models\sales;
use Illuminate\Support\Facades\DB;

class advisorsController extends Controller
{
    //metodo para visualizar los asesores registrados en la db
    public function index()
    {
        //instancio la clase para llamar a todos los asesores
        $advisors = advisors::select('*', 
                                    'advisors.id as advisor_id',
                                    'name as name_advisors',
                                    'lastname as lastname_advisors',
                                    'advisors.supervisor_id as supervisor')
        ->join('users', 'advisors.user_id', '=', 'users.id')
        ->get(); 
        //retorno la variable a la vista
        return view('advisors.index', compact('advisors') );
    }

    //metodo para ver las ventas por asesor
    public function show(Request $requet, $id)
    {
        $id_advisors = $id;
        //instancio la clase para traer las ventas por asesor
        $sales = sales::select('services.name as service_name',
                                'services.valor as service_valor',
                                'services.commission as service_commission',
                                DB::raw('COUNT(*) as total'))
        ->join('services', 'sales.service_id', '=', 'services.id')
        ->where('sales.advisor_id', '=', $id)
        ->groupBy('services.name', 'services.valor', 'services.commission') 
        ->get();

        //instancio la clase para llamar al supervisor del asesor
        $advisors = advisors::select('*')
        ->where('advisors.id', '=', $id)        
        ->get(); 

        foreach( $advisors as $advisor){

            // detalles del supervisor del asesor
            $supervisors = supervisors::select('*', 'name as name_supervisors', 'lastname as lastname_supervisors')
            ->join('users', 'supervisors.user_id', '=', 'users.id')
            ->where('supervisors.id', '=', $advisor->supervisor_id)
            ->get();
       
        }
        return view('advisors.show', compact('sales', 'supervisors', 'id_advisors'));
    }

    //metodo para editar el supervisor de los asesores
    public function edit($id)
    {
        //asigno el valor del id mandado a la variable para retornarlo a la vista
        $advisor_id = $id;
        //instancio la calse para traer los supervisores
        $supervisors = supervisors::select( '*', 'supervisors.id as supervisor_id')
        ->join('users', 'supervisors.user_id', '=', 'users.id')
        ->get();
        //retorno las variables a la vista
        return view('advisors.edit', compact('supervisors', 'advisor_id'));
    }

    /* metodo para actualizar el supervisor */
    public function update(Request $request, $id)
    {
        $advisors = advisors::findOrFail($id);
        //valido la informacion
        $validatedData = $request->validate([
            'supervisor_id' => 'required|integer'
        ]);
        //mando la informacion validad para guardar los cambios
        $advisors->fill($validatedData);
        //guardo la informacion en la db
        $advisors->save();
        //redirecciono a la vista
        return redirect()->route('advisors.index')->with('update', 'Supervisor asigando correctamente');
    }

    //metodo para ver informe de los asesores
    public function reports($id)
    {
        // detalles del supervisor del asesor
        $advisors = advisors::select('*', 
                                    'advisors.id as id_advisors',
                                    'name as name_advisors',
                                    'lastname as lastname_advisors',
                                    'addres as addres_advisors',
                                    'email as email_advisors',
                                    'phone as phone_advisors')
        ->join('users', 'advisors.user_id', '=', 'users.id')
        ->where('advisors.id', '=', $id)
        ->get();

        $sales = array();

        foreach($advisors as $advisor){}
        return view('reports.index', compact('advisor', 'sales'));
    }
}
