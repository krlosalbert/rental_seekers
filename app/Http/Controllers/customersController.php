<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customers;
use App\Models\cities;
use App\Models\supervisors;
use App\Models\advisors;
use App\Models\banks;
use App\Models\accounts;
use App\Models\properties;


class customersController extends Controller
{
    /* metodo para ver el formulario para registrar las ventas */
    public function search()
    {
        return view('customers.search');
    }

    //busqueda de clientes en la db
    public function show(Request $request)
    {
        //instancio la clase para traer los datos de la db que contengan lo que lleva la variable search
        $customers = customers::select('*')
        ->where('name', 'LIKE', '%'.$request->search.'%')
        ->get(); 
        //retorno los datos obtenidos a la vista
        return view('customers.show', compact('customers'));
    }

    //busqueda de clientes en la db
    public function choose_customers(Request $request)
    {
        //instancio la clase para traer los datos de la db que contengan lo que lleva la variable search
        $customers = customers::select('*')
        ->where('id', '=', $request->id)
        ->get(); 

        $cities = cities::All();
        $supervisors = supervisors::select('*', 'supervisors.id as supervisor_id','users.name as name', 'users.lastname as lastname')
        ->join('users', 'supervisors.user_id', '=', 'users.id')
        ->get();
        $banks = banks::All();
        //retorno los datos obtenidos a la vista
        return view('sales.create', compact('customers', 'cities', 'supervisors', 'banks'));
    }
}
