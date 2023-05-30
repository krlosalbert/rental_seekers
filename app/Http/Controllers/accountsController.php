<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\banks;
use App\Models\accounts;

class accountsController extends Controller
{
    //metodo para ver las cuentas registradas
    public function index()
    {
        $accounts = accounts::select('*', 'accounts.id as accounts_id', 'accounts.number', 'banks.name as bank_name')
        ->join('banks', 'accounts.banks_id', '=', 'banks.id')
        ->get();
        return view('accounts.index', compact('accounts'));
    }

    //metodo para el formulario de nueva cuenta
    public function create()
    {
        $banks = banks::All();
        return view('accounts.create', compact('banks'));
    }

    //metodo para crear una nueva cuenta
    public function store(Request $request)
    {
        $accounts = $request->validate([
            'number' => ['required', 'integer'],
            'banks_id' => ['required', 'integer']
        ]);
        // Crear una nueva cuenta
        $account = accounts::create([
            'number' => $accounts['number'],
            'banks_id' => $accounts['banks_id']
        ]);
        // Redireccionar a la vista de cuentas
        return redirect()->route('accounts.index')->with('success', 'cuenta Guardada  con exito');
    }

    /* metodo para el formulario de edicion de la cuenta*/
    public function edit($id)
    {
        $accounts = accounts::select('*', 
                                    'accounts.id as account_id',
                                    'accounts.number as account_number',
                                    'accounts.banks_id as bank_id', 
                                    'banks.name as bank_name')
        ->join('banks', 'accounts.banks_id', '=', 'banks.id')
        ->where('accounts.id', '=', $id)
        ->get();
        //traigo todos los bancos que se encuentran registrados en la db
        $banks = banks::All();
        //mando las variables a la vista
        return view('accounts.edit', compact('accounts', 'banks'));
    }

    /* metodo para actualizar una cuenta */
    public function update(Request $request, $id)
    {
        $accounts = accounts::findOrFail($id);

        //valido la informacion
        $validatedData = $request->validate([
            'number' => 'required|integer',
            'banks_id' => 'required|integer',

        ]);
        //mando la informacion validad para guardar los cambios
        $accounts->fill($validatedData);
        //guardo la informacion en la db
        $accounts->save();
        //redirecciono a la vista
        return redirect()->route('accounts.index')->with('update', 'Cuenta actualizada con exito');
    }

     /* metodo para eliminar una cuenta */
     public function destroy($id){
        $accounts = accounts::findOrFail($id);
        //pregunto su fue exitoso la eliminacion
        if ($accounts->delete()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
