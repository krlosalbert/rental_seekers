<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\properties;


class propertiesController extends Controller
{
    //metodo para ver los inmuebles registrados
    public function index()
    {
        $properties = properties::All();
        return view('properties.index', compact('properties'));
    }

    //metodo para el formulario de una nueva propiedad
    public function create()
    {
        return view('properties.create');
    }

    //metodo para crear una nueva propiedad
    public function store(Request $request)
    {
        $properties = $request->validate([
            'name' => ['required', 'string']
        ]);
        // Crear una nueva propiedad
        $property = properties::create([
            'name' => $properties['name']
        ]);
        // Redireccionar a la vista de propiedades
        return redirect()->route('properties.index')->with('success', 'Inmueble Guardado  con exito');
    }

    /* metodo para el formulario de edicion de una propiedad */
    public function edit($id)
    {
        $properties = properties::select('*')
        ->where('properties.id', '=', $id)
        ->get();
        //mando las variables a la vista
        return view('properties.edit', compact('properties'));
    }

    /* metodo para actualizar una nueva propiedad */
    public function update(Request $request, $id)
    {
        $properties = properties::findOrFail($id);

        //valido la informacion
        $validatedData = $request->validate([
            'name' => 'required|string|max:255'

        ]);
        //mando la informacion validad para guardar los cambios
        $properties->fill($validatedData);
        //guardo la informacion en la db
        $properties->save();
        //redirecciono a la vista
        return redirect()->route('properties.index')->with('update', 'Inmueble actualizado con exito');
    }

     /* metodo para eliminar una Propiedad */
     public function destroy($id){
        $property = properties::findOrFail($id);
        //eliminar el registro relacionado de la tabla secundaria
        $property->properties_neighborhoods()->delete();
        //pregunto su fue exitoso la eliminacion
        if ($property->delete()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
