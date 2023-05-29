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
    public function store()
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
        return redirect()->route('index_accounts')->with('success', 'cuenta Guardada  con exito');
    }
}
