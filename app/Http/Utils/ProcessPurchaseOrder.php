<?php

namespace App\Http\Utils;

use App\Mail\ApprovalSpOc;
use App\Models\OrderRequest\OcProduct;
use App\Models\PurchaseOrder\AccountingBudget;
use App\Models\PurchaseOrder\Approval;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ProcessPurchaseOrder
{
    private $state;
    private $order;
    private $subject;
    private $url;
    protected $message = [];

    public function __construct($order, $updateState)
    {
        $this->order = $order;
        $this->subject = "Orden de Compra";
        $this->url = "https://apibackend.pompeyo.cl/detalle-orden-de-compra/";
        $this->state = $updateState;
    }

    public function states()
    {
        switch ( $this->state ){
            case 'passed':
                return $this->approval();
            case 'refused':
                return $this->rejection();
        }
    }

    private function approval(): array
    {
        $data = $this->order->approvals->load('user:ID,Nombre,Email')->where('type', 2)->where('state', '!=', 1)->where('level', '>', array_values($this->order->approvals->where('state', 1)->toArray())[0]['level']);

        DB::transaction(function () use ($data) {

            if (sizeof($data) !== 0) {

                $this->order->approvals->where('state', 1)->toQuery()->update([
                    'state' => 0
                ]);

                $data->toQuery()->first()->update([
                    'state' => 1
                ]);

                saveNotification(
                    auth()->user()->ID,
                    rand( 1, 20 ),
                    request()->ip(),
                    $this->order->id,
                    array_values($data->toArray())[0]['approver_id'],
                    "Nueva OC a revisar para aprobación",
                    rand( 1, 20 ),
                    rand( 1, 20 ),
                );

                try {
//                    Mail::mailer('solicitudes')->to( $data->first()['user']['Email'] )->send(new ApprovalSpOc($data->first()['user']['Nombre'], $this->url, $this->order->id, $this->subject, "Le fue asignada para ser gestionada", $this->order->ocDetailPurchaseOrder ) );
                }catch (Exception $exception){
                    Log::error( "Se produjo un error al enviar correo OC procesar: $exception");
                }

            } else {

                $this->order->state = 2;
                $this->order->save();

                $this->order->approvals->where('state', 1)->toQuery()->update([
                    'state' => 0
                ]);

                $this->budgetReduction();

                try {
//                    Mail::mailer('solicitudes')->to( $this->order->recorder->Email )->send(new ApprovalSpOc($this->order->recorder->Nombre, $this->url, $this->order->id, $this->subject, "Solicitud de Compra, fue aprobada y pasara a Compras", $this->order, true ) );
                    Storage::delete('/public/' . "archivo{$this->order->id}.pdf");
                }catch (Exception $exception){
                    Log::error( "Se produjo un error al enviar correo OC procesar: $exception");
                }
            }

            $this->message = ['message' => 'Se ha procesado aprobación', 'type' => 'success'];

        });

        return $this->message;
    }

    private function rejection()
    {

        DB::transaction(function () {
            $this->order->state = 3;
            $this->order->save();

            try {
//                Mail::mailer('solicitudes')->to( $this->order->recorder->Email )->send(new ApprovalSpOc( $this->order->recorder->Name, $this->url, $this->order->id, $this->subject, "Orden de compra fue rechazada, revisar los motivos en sistema", $this->order->ocDetailPurchaseOrder, null,  $this->order->comment ) );
            }catch (Exception $exception){
                Log::error( "Se produjo un error al enviar correo OC procesar: $exception");
            }

            Approval::where('approver_id', auth()->user()->ID)
                ->where( 'ocOrderRequest_id', $this->order->id )
                ->update([
                    'state' => 0
                ]);

            $this->message = ['message' => 'Se ha procesado rechazo de orden de compra', 'type' => 'warning'];
        });

        return $this->message;
    }

    public function budgetReduction(): void
    {
        $month = date('n');

        foreach ( $this->order->ocDetailPurchaseOrder as $details )
        {

            $items = OcProduct::with(['accountingBudget' => function ($query) use ( $month, $details ) {
                $query->where('Year', date('Y'))->select( 'AccountID', "M" . $month, "S" . $month );
            }])->where('id', $details->ocProduct_id )
                ->select('AccountID')
                ->get();

            foreach ( $items as $budget )
            {
                AccountingBudget::where('AccountID', $budget->AccountID )->increment( "S" . $month , $details->totalPrice );
            }

        }
    }
}
