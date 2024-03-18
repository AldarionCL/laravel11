<?php

namespace App\Http\Utils;

use App\Mail\ApprovalSpOc;
use App\Models\PurchaseOrder\Approval;
use App\Models\PurchaseOrder\Approver;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProcessOrderRequest
{
    private $state;
    private $order;
    private $subject;
    private $url;
    protected $message = [];

    public function __construct($order, $updateState)
    {
        $this->order = $order;
        $this->subject = "Solicitud de Compra";
        $this->url = "https://apibackend.pompeyo.cl/detalle-solicitud-de-pedidos/";
        $this->state = $updateState;
    }

    public function states()
    {
        switch ($this->state) {
            case 'passed':
                return $this->approval();
            case 'refused':
                return $this->rejection();
        }
    }

    private function approval(): array
    {
        $approver = Approver::select('level')->where('user_id', auth()->user()->ID)->where('branchOffice_id', $this->order->branch_id )->get()->toArray();

        // TODO revisar Array key 0
        $approverNext = Approval::where('ocOrderRequest_id', $this->order->id)->where('type', 1)->where('level', '>', $approver[0]['level'])->orderBy('id')->first();


        DB::transaction(function () use ($approverNext) {

            if ($approverNext !== null) {

                Approval::where('approver_id', auth()->user()->ID)
                    ->where('ocOrderRequest_id', $this->order->id)
                    ->update([
                    'state' => 0
                ]);

                $approverNext->update([
                    'state' => 1
                ]);

                saveNotification(
                    auth()->user()->ID,
                    rand( 1, 20 ),
                    request()->ip(),
                    $this->order->id,
                    $approverNext->approver_id,
                    "Nueva SolPed a revisar para aprobación",
                    rand( 1, 20 ),
                    rand( 1, 20 ),
                );

                try {
//                    Mail::mailer('solicitudes')->to( $approverNext->user->Email )->send( new ApprovalSpOc( $approverNext->user->Nombre, $this->url, $this->order->id, $this->subject, "Le fue asignada para ser gestionada", $this->order->ocDetailOrderRequest ) );
                }catch (Exception $exception){
                    Log::error( "Se produjo un error al enviar correo OC procesar: $exception");
                }

            } else {
                $this->order->state = 2;
                $this->order->save();

                Approval::where('approver_id', auth()->user()->ID)
                    ->where( 'ocOrderRequest_id', $this->order->id )
                    ->update([
                    'state' => 0
                ]);

                try {
                    Mail::mailer('solicitudes')->to( $this->order->recorder->Email )->send( new ApprovalSpOc( $this->order->recorder->Nombre, $this->url, $this->order->id, $this->subject, "Solicitud de Compra, fue aprobada y pasara a gestion de Orden de Compra", $this->order->ocDetailOrderRequest ) );
                }catch (Exception $exception){
                    Log::error( "Se produjo un error al enviar correo OC aprobaciones: $exception");
                }

            }
            $this->message = ['message' => 'Se ha procesado aprobación', 'type' => 'success'];

        });

        return $this->message;
    }

    private function rejection(): array
    {

        DB::transaction(function () {
            $this->order->state = 3;
            $this->order->save();
            try {
                Mail::mailer('solicitudes')->to($this->order->recorder->Email)->send(new ApprovalSpOc($this->order->recorder->Name, $this->url, $this->order->id, $this->subject, "Solicitud de compra fue rechazada, revisar los motivos en sistema", $this->order->ocDetailOrderRequest ) );
            }catch (Exception $exception){
                Log::error( "Se produjo un error al enviar correo SC procesar: $exception");
            }

            Approval::where('approver_id', auth()->user()->ID)
                ->where( 'ocOrderRequest_id', $this->order->id )
                ->update([
                    'state' => 0
                ]);

            $this->message = ['message' => 'Se ha procesado rechazo de solicicitud', 'type' => 'warning'];

        });

        return $this->message;
    }

    public static function updatePermissionOrderRequest($ocOrderRequest, $type ): bool
    {

        $data = collect(
            Approval::where('ocOrderRequest_id', $ocOrderRequest->id)
                ->where('approver_id', auth()->user()->ID)
                ->where('state', "=", 1)
                ->where( 'type', $type )
                ->get()
                ->toArray());

        return $data->isNotEmpty();
    }
}
