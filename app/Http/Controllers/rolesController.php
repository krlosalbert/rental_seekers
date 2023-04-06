<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\roles;


class rolesController extends Controller
{
    public function read()
    {
        $roles = roles::All();

        return view('roles.view', compact('roles'));
    }

    /* metodo para mostrar el formulario de crear nuevo rol */
    public function form()
    {
        return view('roles.form');
    }

    /* metodo para insertar en la db el nuevo supervisor */
    protected function create(Request $request)
    {
        
        $roles = $request->validate([
            'name' => ['required', 'string'],
        ]);
    
        // Crear un nuevo supervisor
        $role = roles::create([
            'name' => $roles['name'],
        ]);
        
        // Redireccionar a la vista de roles
        return redirect()->route('view_roles')->with('success', 'Rol Guardado  con exito');
    }
}
