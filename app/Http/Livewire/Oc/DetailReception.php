<?php

namespace App\Http\Livewire\Oc;

use App\Models\OrderRequest\OcOrderRequest;
use App\Models\PurchaseOrder\Approval;
use App\Models\PurchaseOrder\Reception;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class DetailReception extends Component
{
    public Reception $reception;

    public function render()
    {
        return view('livewire.oc.detail-reception');
    }

    public function pdfDownload( $value )
    {
        $dataApproveals = Approval::where('ocOrderRequest_id', $this->reception->ocPurchaseOrder->id)->where('type', 2)->orderBy('id', 'desc')->limit(2)->get();

        $arrayFiles = array_map('intval', json_decode( $this->reception->ocPurchaseOrder->ocOrderRequest_ids, true ));

        $applicant = "";

        if ($arrayFiles){
            $data = OcOrderRequest::find( $arrayFiles[0] );
            $applicant = $data->recorder->Nombre;
        }

        $pdfContent = PDF::loadView('oc.document.despacho', ['ocPurchaseOrder' => $this->reception->ocPurchaseOrder, 'ocDetailPurchaseOrder' => $this->reception->ocPurchaseOrder->ocDetailPurchaseOrder, 'date' => $dataApproveals->first()->updated_at, 'approver' => $dataApproveals, 'applicant' => $applicant ])->output();

        return response()->streamDownload(
            fn () => print($pdfContent),
            "Orden de Compra N° ".$this->reception->ocPurchaseOrder->id.".pdf"
        );
    }
}
