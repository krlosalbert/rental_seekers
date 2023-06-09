<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\banks;

class banksController extends Controller
{
    //metodo para la vista de los bancos
    public function index()
    {
        $banks = banks::All();

        return view('banks.index', compact('banks'));
    }

    //metodo para el formulario de registro del banco
    public function create()
    {
        return view('banks.create');
    }

    /* metodo para insertar en la db el nuevo banco */
    protected function store(Request $request)
    {        
        $banks = $request->validate([
            'name' => ['required', 'string'],
        ]);
    
        // Crear un nuevo banco
        $bank = banks::create([
            'name' => $banks['name'],
        ]);
        
        // Redireccionar a la vista de bancos
        return redirect()->route('banks.index')->with('success', 'banco Guardado  con exito');
    }

    /* metodo para actualizar un banco */
    public function edit($id)
    {
        $banks = banks::select('*', 'banks.id as banks_id')
        ->where('banks.id', '=', $id)
        ->get();
    
        return view('banks.edit', compact('banks'));
    }

    /* metodo para actualizar un banco */
    public function update(Request $request, $id)
    {
        $bank = banks::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $bank->fill($validatedData);
        $bank->save();
        return redirect()->route('banks.index')->with('update', 'Banco actualizado con exito');
    }

    /* metodo para eliminar los bancos */
    public function destroy($id){
        $bank = banks::findOrFail($id);
        //eliminar el registro relacionado de la tabla secundaria
        $bank->accounts()->delete();
        //pregunto su fue exitoso la eliminacion
        if ($bank->delete()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);

    }
}
