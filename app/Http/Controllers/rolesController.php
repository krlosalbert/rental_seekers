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

    /* metodo para actualizar un rol */
    public function read_update(Request $request)
    {
        $roles = roles::select('*', 'roles.id as role_id')
        ->where('roles.id', '=', $request->id)
        ->get();
    
        return view('roles.update', compact('roles'));
    }

    /* metodo para actualizar un rol */
    public function update(Request $request, $id)
    {
        $role = roles::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $role->fill($validatedData);
        $role->save();
        return redirect()->route('view_roles')->with('update', 'Rol actualizado con exito');
    }

    /* metodo para eliminar los usuarios */
    public function destroy($id){
        $role = roles::findOrFail($id);
        //pregunto su fue exitoso la eliminacion
        if ($role->delete()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);

    }
}

