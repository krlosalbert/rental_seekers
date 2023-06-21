<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\roles;


class rolesController extends Controller
{
    public function index()
    {
        $roles = roles::All();

        return view('roles.index', compact('roles'));
    }

    /* metodo para mostrar el formulario de crear nuevo rol */
    public function create()
    {
        return view('roles.create');
    }

    /* metodo para insertar en la db el nuevo rol */
    protected function store(Request $request)
    {
        
        $roles = $request->validate([
            'name' => ['required', 'string'],
        ]);
    
        // Crear un nuevo rol
        $role = roles::create([
            'name' => $roles['name'],
        ]);
        
        // Redireccionar a la vista de roles
        return redirect()->route('roles.index')->with('success', 'Rol Guardado  con exito');
    }

    /* metodo para actualizar un rol */
    public function edit($id)
    {
        $roles = roles::select('*', 'roles.id as role_id')
        ->where('roles.id', '=', $id)
        ->get();
    
        return view('roles.edit', compact('roles'));
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
        return redirect()->route('roles.index')->with('update', 'Rol actualizado con exito');
    }

    /* metodo para eliminar los roles */
    public function destroy($id){
        $role = roles::findOrFail($id);
        //pregunto su fue exitoso la eliminacion
        if ($role->delete()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);

    }
}

