<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\advisors;
use App\Models\supervisors;


class advisorsController extends Controller
{
    public function read()
    {
        $advisors = advisors::select('*', 'name as name_advisors', 'lastname as lastname_advisors', 'advisors.supervisor_id as supervisor')
        ->join('users', 'advisors.user_id', '=', 'users.id')
        ->get(); 

        return view('advisors.view', compact('advisors') );
    }

    public function supervisor_advisor(Request $request)
    {
        $supervisors = supervisors::select('*', 'name as name_supervisors', 'lastname as lastname_supervisors')
        ->join('users', 'supervisors.user_id', '=', 'users.id')
        ->where('supervisors.id', '=', $request->id)
        ->get();

        return view('advisors.supervisor', compact('supervisors'));

    }
}
