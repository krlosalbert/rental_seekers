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

    /* metodo para motrar los usuarios */
    public function index()
    {
        $users_with_roles = User::select('users.id as user_id', 
                                        'users.name',
                                        'users.lastname',
                                        'users.addres', 
                                        'users.phone', 
                                        'users.email',
                                        'users.active', 
                                        'roles.name as role_name')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->where('users.active', '=', 1)
        ->get();
        return view('users.index', compact('users_with_roles'), ['x'=>0]);
    }

    /* metodo para motrar los detalles completos de los usuarios */
    public function show($id){
        $users = User::select('users.id as user_id',
                             'users.name', 
                             'users.lastname',
                             'users.addres', 
                             'users.phone', 
                             'users.email', 
                             'roles.name as role_name',
                             'users.active')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->where('users.id', '=', $id)
        ->get();
        //dd($user);
        return view('users.show', compact('users'));
    }

    /* metodo para llamar el formulario de registro */
    public function create(Request $request)
    {
        // Obtener todos los roles
        $roles = roles::all();
        //dd($roles);
        $supervisors = supervisors::select('supervisors.id as id_supervisors', 'users.name as name', 'users.lastname as lastname')
        ->join('users', 'supervisors.user_id', '=', 'users.id')
        ->get();
        //dd($supervisors);
        return view('auth.register', compact('roles', 'supervisors'));
    }
    
    /* metodo para motrar el formulario para la edicion de los usuarios */
    public function edit(Request $request){
        $users = (object) User::select('users.id as user_id', 'users.name', 'users.lastname', 'users.addres', 'users.phone', 'users.email', 'users.role_id as user_role', 'roles.name as role_name')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->where('users.id', '=', $request->id)
        ->get();

        $roles = roles::All();
        //dd($user);
        return view('users.edit', compact('users', 'roles'));
    }

    /* metodo para actualizar los usuarios */
    public function update(Request $request, $id){
        $user = User::find($id);
        $user->fill($request->all());
        $user->save();
        return redirect()->route('users.index')->with('done', 'Usuario Actualizado con exito');
    }

    /* metodo para eliminar los usuarios */
    public function destroy($id){
        $user = User::findOrFail($id);
        $user->active = 2;
        //pregunto su fue exitoso la eliminacion
        if ($user->save()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);

    }
}
