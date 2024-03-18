<?php

namespace App\Http\Controllers;

use App\Models\Gerencias;
use App\Models\reception\Visitas;
use DateTime;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


class RecepcionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        return view('reception.index');
    }

    public function asistencia_diaria()
    {
        $gerencias = Gerencias::where("Activo",1)->get();
        return view('reception.lista', compact('gerencias'));

    }

    public function agendamiento_diario()
    {
        $gerencias = Gerencias::where("Activo",1)->get();
        return view('reception.agendamiento', compact('gerencias'));

    }

    public function marcar_salida(Request $request,$id)
    {
        if($id != '')
        {
            $visita=  Visitas::find($id);

            // calcula el tiempo entre fecha ingreso y fecha salida
            $date1 = new DateTime($visita->FechaCreacion);
            $date2 = new DateTime(date('Y-m-d H:i:s'));
            $diff = $date1->diff($date2);
            $diff =  ($diff->d * 1440) + ($diff->h * 60) + ( $diff->i );

            Visitas::find($id)->update(array(
                'Fecha_salida' => date('Y-m-d H:i:s'),
                'UsuarioSalidaID' => Auth::user()->ID,
                'MinutosVisita' => $diff
            ));

            if($request->patente)
            {
                Visitas::find($id)->update(array(
                    'retiroPatente' => str_replace('.','',str_replace('-','',strtoupper($request->patente)))
                ));

            }
        }
        return redirect(route('recepcion'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('recepcion::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('recepcion::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('recepcion::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
