<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    public function store(Request $request)
    {
        try {
            Customer::updateOrCreate(
                [
                    'Rut' => $request->rut,
                    'Email' => $request->email,
                    'Telefono' => $request->telefono
                ],
                [
                    'Nombre' => $request->nombre,
                    'FechaNacimiento' => $request->fechaNacimiento,
                    'Direccion' => $request->direccion,
                    'ComunaID' => $request->comunaID,
                    'RegionID' => $request->regionID,
                    'EstadoCivilID' => $request->estadoCivilID,
                    'ProfesionID' => $request->profesionID,
                    'EventoCreacionID' => 1,
                ]
            );

            return response()->json('Datos guardados', 201);

        }catch (Exception $e){
            Log::error($e->getMessage());
            return response()->json('Error al ingresar los datos', 500);
        }


    }
}
