<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\advisors;

class advisorsController extends Controller
{
    public function read()
    {
        $advisors = advisors::All();

        return view('advisors.view', compact('advisors') );
    }
}
