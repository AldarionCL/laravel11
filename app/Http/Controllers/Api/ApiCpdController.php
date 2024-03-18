<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Cpd\CpdController;
use Illuminate\Http\Request;
use Laminas\Soap\AutoDiscover as WsdlAutoDiscover;
use Laminas\Soap\Server as SoapServer;

class ApiCpdController extends Controller
{

    public function wsdlAction()
    {
        if (!$this->request->isMethod('get')) {
            return $this->prepareClientErrorResponse('GET');
        }

        $wsdl = new WsdlAutoDiscover();

        $wsdl->setUri(route('soap-server'))
            ->setServiceName('crearCpdVenta');


        $this->populateServer($wsdl);


        return response()->make($wsdl->toXml())
            ->header('Content-Type', 'application/xml');
    }



    public function serverAction()
    {
        if (!$this->request->isMethod('post')) {
            return $this->prepareClientErrorResponse('POST');
        }

        $server = new SoapServer(
            route('soap-wsdl'),
            [
                'actor' => route('soap-server'),
            ]
        );

        $server->setReturnResponse(true);
        $this->populateServer($server);
        $soapResponse = $server->handle();

        return response()->make($soapResponse)->header('Content-Type', 'application/xml');
    }


    private function prepareClientErrorResponse($allowed)
    {
        return response()->make('Method not allowed', 405)->header('Allow', $allowed);

    }


    private function populateServer($server)
    {
        // Expose a class and its methods:
        $server->setClass(CpdController::class);

        // Expose an object instance and its methods:
        // $server->setObject($this->env);

        // Expose a function:
        // $server->addFunction('Acme\Model\ping');
    }


}
