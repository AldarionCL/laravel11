<?php

namespace App\Http\Utils;

use App\Mail\ApprovalRenditionRejected;
use App\Models\Cash\CashDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ProcessCashItemsRejected
{
    protected mixed $cash;
    protected array $cashDetailsIds;
    protected mixed $message;

    public function __construct($cash, $message, array $cashDetailsIds)
    {
        $this->cash = $cash;
        $this->message = $message;
        $this->cashDetailsIds = $cashDetailsIds;
        $this->process();
    }

    private function process(): void
    {
        $details = $this->cash->cashDetails->whereIn('id', $this->cashDetailsIds);

        DB::transaction(function () use ($details) {

            $this->cash->update([
                'comment' => $this->message
            ]);

            CashDetail::whereIn('id', $this->cashDetailsIds)->update([
                'state' => 0
            ]);

            /*Mail::mailer('roma')
                ->to($this->cash->user->Email)
                ->send(new ApprovalRenditionRejected($this->cash->user->Nombre, $this->cash->id, $this->message,  $details));*/

        });
    }
}
