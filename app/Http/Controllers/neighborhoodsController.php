<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cities;
use App\Models\neighborhoods;

class neighborhoodsController extends Controller
{
    //metodo para ver los barrios registrados
    public function index()
    {
        $neighborhoods = neighborhoods::select( '*', 
                                                'neighborhoods.id as neighborhood_id',
                                                'neighborhoods.name as neighborhood_name',
                                                'cities.name as city_name')
        ->join('cities', 'neighborhoods.city_id', '=', 'cities.id')
        ->get();
        return view('neighborhoods.index', compact('neighborhoods'));
    }

    //metodo para el formulario de un nuevo barrio
    public function create()
    {
        $cities = cities::All();
        return view('neighborhoods.create', compact('cities'));
    }

    //metodo para crear un nuevo barrio
    public function store(Request $request)
    {
        $neighborhoods = $request->validate([
            'name' => ['required', 'string'],
            'city_id' => ['required', 'integer'],

        ]);
        // Crear un nuevo barrio
        $neighborhood = neighborhoods::create([
            'name' => $neighborhoods['name'],
            'city_id' => $neighborhoods['city_id']

        ]);
        // Redireccionar a la vista de barrios
        return redirect()->route('neighborhoods.index')->with('success', 'Barrio Guardado  con exito');
    }

    /* metodo para el formulario de edicion de un barrio */
    public function edit($id)
    {
        $neighborhoods = neighborhoods::Select( '*',
                                                'neighborhoods.id as neighborhood_id',
                                                'neighborhoods.name as neighborhood_name',
                                                'neighborhoods.city_id as city_id',
                                                'cities.name as city_name')
        ->join('cities', 'neighborhoods.city_id', '=', 'cities.id')
        ->where('neighborhoods.id', '=', $id)
        ->get();

        $cities = cities::All();
        //mando las variables a la vista
        return view('neighborhoods.edit', compact('neighborhoods', 'cities'));
    }

    /* metodo para actualizar un barrio */
    public function update(Request $request, $id)
    {
        $neighborhoods = neighborhoods::findOrFail($id);

        //valido la informacion
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'city_id' => 'required|integer'
        ]);
        //mando la informacion validad para guardar los cambios
        $neighborhoods->fill($validatedData);
        //guardo la informacion en la db
        $neighborhoods->save();
        //redirecciono a la vista
        return redirect()->route('neighborhoods.index')->with('update', 'Barrio actualizado con exito');
    }

    /* metodo para eliminar un barrio */
    public function destroy($id){
        $neighborhoods = neighborhoods::findOrFail($id);
        //eliminar el registro relacionado de la tabla secundaria
        $neighborhoods->properties_neighborhoods()->delete();
        //pregunto su fue exitoso la eliminacion
        if ($neighborhoods->delete()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
