<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cities;
use App\Models\employees;
use App\Models\banks;
use App\Models\accounts;


class salesController extends Controller
{
    public function form()
    {
        $cities = cities::All();
        $employees_1 = employees::select('*')->where('positions_id', '=', 1)->get();
        $employees_2 = employees::select('*')->where('positions_id', '=', 2)->get();
        $banks = banks::All();
        $accounts = accounts::All();
        return view('Sales.form', compact('cities', 'employees_1', 'employees_2', 'banks', 'accounts') );
    }
}
