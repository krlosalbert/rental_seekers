<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\porcentages;
use App\Models\supervisors;

class supervisorsController extends Controller
{
    /* metodo para mostrar los supervisores */
    public function read(){
        $supervisors = supervisors::select('*', 'name as name_supervisors', 'lastname as lastname_supervisors')
        ->join('users', 'supervisors.user_id', '=', 'users.id')
        ->get();

        return view('supervisors.view', compact('supervisors'));
    }
    /* metodo para mostar el formulario de creacion de nuevo supervisor */
    public function form()
    {
        $users = User::All();
        return view('supervisors.form', compact('users'));
    }

    /* metodo para insertar en la db el nuevo supervisor */
    protected function create(Request $request)
    {
        
        $supervisors = $request->validate([
            'user_id' => ['required', 'integer'],
        ]);
    
        // Crear un nuevo supervisor
        $supervisor = supervisors::create([
            'user_id' => $supervisors['user_id'],
            'porcentage_id' => 2,
        ]);
        
        // Redireccionar a la vista de roles
        return redirect()->route('view_supervisors')->with('success', 'supervisor Guardado  con exito');
    }
}
