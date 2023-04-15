<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\banks;

class banksController extends Controller
{
    //metodo para la vista de los bancos
    public function view()
    {
        $banks = banks::All();

        return view('banks.view', compact('banks'));
    }
}
