<?php

namespace App\Http\Livewire\Oc;

use App\Models\OrderRequest\OcOrderRequest;
use App\Models\PurchaseOrder\Approval;
use App\Models\PurchaseOrder\OcPurchaseOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Prueba extends Component
{
    public $oc;
    public $exempt;
    public $state;
    public $reception;
    public $pre_oc;

    public function mount(OcPurchaseOrder $purchaseorder )
    {
        $this->oc = $purchaseorder;

        $exitsFile = $this->oc->orderRequest->load(['preOcPurchaseOrder:id', 'preOcPurchaseOrder.preFilePurchaseOrder:oc_id,url']);

        $this->state = false ?? $this->incrementPostCount();
        $this->reception = OcPurchaseOrder::where('id', $this->oc->id )->whereHas( 'receptions' )->exists();

        /*$this->pre_oc = $this->oc->pre_oc && PreOcPurchaseOrder::whereHas('preFilePurchaseOrder', function ($query) {
            $query->where('oc_id', $this->oc->orderRequest[0]->request_id);
        })->exists();*/
    }
    public function render()
    {
        return view('livewire.oc.prueba');
    }

    public function incrementPostCount()
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'success',
            'message' => 'Recepcion Guardada'
        ]);
    }

    public function pdfDownload( $value )
    {
        $dataApproveals = Approval::where('ocOrderRequest_id', $this->oc->id)->where('type', 2)->orderBy('id', 'desc')->limit(2)->get();

        $arrayFiles = array_map('intval', json_decode( $this->oc->ocOrderRequest_ids, true ));

        $applicant = "";

        if ($arrayFiles){
            $data = OcOrderRequest::find( $arrayFiles[0] );
            $applicant = $data->recorder->Nombre;
        }

        $pdfContent = PDF::loadView('oc.document.despacho', ['ocPurchaseOrder' => $this->oc, 'ocDetailPurchaseOrder' => $this->oc->ocDetailPurchaseOrder, 'date' => $dataApproveals->first()->updated_at, 'approver' => $dataApproveals, 'applicant' => $applicant, 'excenta' => $this->exempt ])->output();

        return response()->streamDownload(
            fn () => print($pdfContent),
            "Orden de Compra N° ".$this->oc->id.".pdf"
        );
    }

    public function cancel( $value )
    {
        DB::transaction( function () use ($value) {

            OcPurchaseOrder::where('id', $value['id'] )
                ->update([
                    'state' => 6
                ]);

            $this->dispatchBrowserEvent('swal:success', [
                'type' => 'success',
                'message' => 'OC Anulada'
            ]);

        });
    }

    public function reception( $value )
    {
        DB::transaction( function () use ($value) {

            OcPurchaseOrder::where('id', $value['id'] )
                ->update([
                    'state' => 6
                ]);

            $this->dispatchBrowserEvent('swal:success', [
                'type' => 'success',
                'message' => 'OC Anulada'
            ]);

        });
    }
}
