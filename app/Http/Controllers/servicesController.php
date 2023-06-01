<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\services;

class servicesController extends Controller
{
    //metodo para ver los servicios registrados
    public function index()
    {
        $services = services::All();
        return view('services.index', compact('services'));
    }

    //metodo para el formulario de un nuevo servicio
    public function create()
    {
        return view('services.create');
    }

    //metodo para crear una nuevo servicio
    public function store(Request $request)
    {
        $services = $request->validate([
            'name' => ['required', 'string'],
            'valor' =>['required', 'numeric', 'min:0', 'regex:/^\d*(\.\d{1,2})?$/'],
            'commission' =>['required', 'numeric', 'min:0', 'regex:/^\d*(\.\d{1,2})?$/'],
            'residue' =>['required', 'numeric', 'min:0', 'regex:/^\d*(\.\d{1,2})?$/']
        ]);
        // Crear un nuevo servicio
        $service = services::create([
            'name' => $services['name'],
            'valor' => $services['valor'],
            'commission' => $services['commission'],
            'residue' => $services['residue']
        ]);
        // Redireccionar a la vista de propiedades
        return redirect()->route('services.index')->with('success', 'Servicio Guardado  con exito');
    }

    /* metodo para el formulario de edicion de una propiedad */
    public function edit($id)
    {
        $services = services::select('*')
        ->where('services.id', '=', $id)
        ->get();
        //mando las variables a la vista
        return view('services.edit', compact('services'));
    }

    /* metodo para actualizar un nuevo servicio */
    public function update(Request $request, $id)
    {
        $services = services::findOrFail($id);

        //valido la informacion
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'valor' =>['required', 'numeric', 'min:0', 'regex:/^\d*(\.\d{1,2})?$/'],
            'commission' =>['required', 'numeric', 'min:0', 'regex:/^\d*(\.\d{1,2})?$/'],
            'residue' =>['required', 'numeric', 'min:0', 'regex:/^\d*(\.\d{1,2})?$/']
        ]);
        //mando la informacion validad para guardar los cambios
        $services->fill($validatedData);
        //guardo la informacion en la db
        $services->save();
        //redirecciono a la vista
        return redirect()->route('services.index')->with('update', 'Servicio actualizado con exito');
    }

     /* metodo para eliminar un servicio */
     public function destroy($id){
        $service = services::findOrFail($id);
        //eliminar el registro relacionado de la tabla secundaria
        //$service->properties_neighborhoods()->delete();
        //pregunto su fue exitoso la eliminacion
        if ($service->delete()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
