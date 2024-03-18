<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{


    public function index()
    {

        /*$user = DB::select(
            'CALL SIS_ListarMenuSecundario(' . 2074 . ',' . "'coockie'" . ",'192.168.0.1','".app_path()."');"
        );*/

/*        dd($user);*/

        return view('ventas.ventas');
    }
}
