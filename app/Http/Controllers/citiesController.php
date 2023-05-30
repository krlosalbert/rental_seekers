<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cities;

class citiesController extends Controller
{
    //metodo para ver las ciudades registradas
    public function index()
    {
        $cities = cities::All();
        return view('cities.index', compact('cities'));
    }

    //metodo para el formulario de nueva ciudad
    public function create()
    {
        return view('cities.create');
    }

    //metodo para crear una nueva ciudad
    public function store(Request $request)
    {
        $cities = $request->validate([
            'name' => ['required', 'string']
        ]);
        // Crear una nueva ciudad
        $city = cities::create([
            'name' => $cities['name']
        ]);
        // Redireccionar a la vista de ciudades
        return redirect()->route('cities.index')->with('success', 'ciudad Guardada  con exito');
    }

    /* metodo para el formulario de edicion de la ciudad*/
    public function edit($id)
    {
        $cities = cities::select('*')
        ->where('cities.id', '=', $id)
        ->get();
        //mando las variables a la vista
        return view('cities.edit', compact('cities'));
    }

    /* metodo para actualizar una ciudad */
    public function update(Request $request, $id)
    {
        $cities = cities::findOrFail($id);

        //valido la informacion
        $validatedData = $request->validate([
            'name' => 'required|string|max:255'

        ]);
        //mando la informacion validad para guardar los cambios
        $cities->fill($validatedData);
        //guardo la informacion en la db
        $cities->save();
        //redirecciono a la vista
        return redirect()->route('cities.index')->with('update', 'Ciudad actualizada con exito');
    }

     /* metodo para eliminar una ciudad */
     public function destroy($id){
        $city = cities::findOrFail($id);
        //pregunto su fue exitoso la eliminacion
        if ($city->delete()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
