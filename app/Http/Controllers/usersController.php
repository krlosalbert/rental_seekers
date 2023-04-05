<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\roles;
use App\Models\User;
use App\Models\supervisors;


class usersController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    /* metodo para llamar el formulario de registro */
    public function form(){
        // Obtener todos los roles
        $roles = roles::all();

        $supervisors = supervisors::select('supervisors.id as id_supervisors', 'name', 'lastname')
        ->join('users', 'supervisors.user_id', '=', 'users.id')
        ->get();
        return view('auth.register', compact('roles', 'supervisors'));
    }
    /* metodo para motrar los usuarios */
    public function read(Request $request){
        $users_with_roles = User::select('users.id', 'users.name', 'users.lastname', 'users.addres', 'users.phone', 'users.email', 'roles.name as role_name')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->get();
        return view('users.view', compact('users_with_roles'), ['x'=>0]);
    }
}
