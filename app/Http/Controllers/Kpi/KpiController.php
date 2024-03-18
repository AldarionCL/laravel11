<?php

namespace App\Http\Controllers\Kpi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KpiController extends Controller
{

    public function index()
    {


        return view('kpi.index');
    }
}
