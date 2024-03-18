<?php

namespace App\Http\Utils;

use App\Mail\ApprovalRendition;
use App\Models\Cash\CashierApprovals;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProcessCash
{
    private $state;
    private $cash;
    protected $message = [];

    public function __construct($cash, $updateState)
    {
        $this->cash = $cash;
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

        $data = $this->cash->cashierApprovals->load('user:ID,Nombre,Email')->where('state', '!=', 1)->where('active', '!=', 1)->where('level', '>', array_values($this->cash->cashierApprovals->where('state', 1)->toArray())[0]['level']);

        DB::transaction(function () use ($data) {

            if (sizeof($data) !== 0) {

                $this->cash->cashierApprovals->where('state', 1)->toQuery()->update([
                    'state' => 0
                ]);

                $data->toQuery()->first()->update([
                    'state' => 1
                ]);

                try {
                    Mail::mailer('roma')
                        ->to( $data->first()['user']['Email'] )
                        ->send(new ApprovalRendition( $data->first()['user']['Nombre'], $this->cash->id, "Asignación de Rendición", "Le fue asignada para ser gestionada", $this->cash->cashDetails ) );
                }catch (Exception $exception){
                    Log::error( "Se produjo un error al enviar correo Caja procesar: $exception");
                }

            } else {

                $this->cash->status = 2;
                $this->cash->save();

                $this->cash->cashierApprovals->where('state', 1)->toQuery()->update([
                    'state' => 0
                ]);

                try {
                    Mail::mailer('roma')->to( $this->cash->user->Email )
                        ->send(new ApprovalRendition($this->cash->user->Nombre, $this->cash->id, "Rendición Aprobada", "Rendición, fue aprobada y se procedera a su reembolso", $this->cash->cashDetails ) );
                }catch (Exception $exception){
                    Log::error( "Se produjo un error al enviar correo Caja Procesar: $exception");
                }
            }

            $this->message = ['message' => 'Se ha procesado aprobación', 'type' => 'success'];

        });

        return $this->message;
    }

    private function rejection()
    {

        DB::transaction(function () {
            $this->cash->status = 3;
            $this->cash->save();

            try {
                Mail::mailer('roma')
                    ->to( $this->cash->user->Email )
                    ->send(new ApprovalRendition( $this->cash->user->Nombre, $this->cash->id, "rendición fue rechazada, caja chica ", "La rendición de caja chica fue rechazada, favor revisar los motivos en sistema", $this->cash->details, $this->cash->comment ) );
            }catch (Exception $exception){
                Log::error( "Se produjo un error al enviar correo Caja procesar: $exception");
            }

            CashierApprovals::where('cashier_approver_id', auth()->user()->ID)
                ->where( 'cash_id', $this->cash->id )
                ->update([
                    'state' => 0
                ]);

            $this->message = ['message' => 'Se ha procesado rechazo de orden de compra', 'type' => 'warning'];
        });

        return $this->message;
    }

    public static function updatePermissionCash( $cash_id ): bool
    {

        $data = collect(
            CashierApprovals::where('cash_id', $cash_id)
                ->where('cashier_approver_id', auth()->user()->ID)
                ->where('state', "=", 1)
                ->where('active', "=", 0)
                ->get()
                ->toArray());

        return $data->isNotEmpty();
    }
}
