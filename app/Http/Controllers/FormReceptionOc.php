<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormReceptionCreateRequest;
use App\Models\OrderRequest\DetailReception;
use App\Models\OrderRequest\OcOrderRequest;
use App\Models\PurchaseOrder\AccountingBudget;
use App\Models\PurchaseOrder\Approval;
use App\Models\PurchaseOrder\FileReception;
use App\Models\PurchaseOrder\OcDetailPurchaseOrder;
use App\Models\PurchaseOrder\OcPurchaseOrder;
use App\Models\PurchaseOrder\Reception;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class FormReceptionOc extends Controller
{
    public function show(OcPurchaseOrder $ocPurchaseOrder)
    {
        // TODO hacer policy
        //$this->authorize( 'create', $ocPurchaseOrder );

        $ocDetailPurchaseOrder = OcDetailPurchaseOrder::with('detailReception')->where('ocPurchaseOrder_id', $ocPurchaseOrder->id)->get();

        return view('form.show', compact('ocPurchaseOrder', 'ocDetailPurchaseOrder'));
    }

    public function store(FormReceptionCreateRequest $request)
    {
        DB::transaction( function () use ( $request ){

            $reception = new Reception();
            $reception->ocOrderRequest_id = $request->id;
            $reception->document = $request->document;
            $reception->save();

            $file = new FileReception();
            $path = $request->file('invoice')->store('public/purchaseorder');
            $file->url = $path;
            $file->reception_id = $reception->id;
            $file->save();

            // TODO revisar user 1405
            foreach ($request->received as $key => $detail)
            {
                $ocDetailPurchaseOrder = OcDetailPurchaseOrder::with('ocProduct')->where('id', $key)->get();

                foreach ($ocDetailPurchaseOrder as $detailOrder )
                {
                    $detailReception = new DetailReception();
                    $detailReception->ocDetailOrderRequest = $key;
                    $detailReception->amount = $detailOrder->amount;
                    $detailReception->received = $detail;
                    $detailReception->save();

                    $month = date('n');

                    $budgets = AccountingBudget::where( 'AccountID', $detailOrder->ocProduct->AccountID)->where( 'Year', date('Y') )->get();

                    foreach ( $budgets as $budget)
                    {
                        $budget->{"S".$month} = $budget->{"S".$month} - ( $detail * $detailOrder->unitPrice );
                        $budget->save();
                    }

                }
            }

        });

        return redirect()->back()->with('status', 'Recepción guardada!');
    }

    public function createPDF( OcPurchaseOrder $ocPurchaseOrder)
    {
        $dataApproveals = Approval::where('ocOrderRequest_id', $ocPurchaseOrder->id)->where('type', 2)->limit(2)->get();

        $arrayFiles = array_map('intval', json_decode( $ocPurchaseOrder->ocOrderRequest_ids, true ));

        $applicant = "";

        if ($arrayFiles){
            $data = OcOrderRequest::find( $arrayFiles[0] );
            $applicant = $data->recorder->Nombre;
        }

        $pdf = PDF::loadView('oc.document.despacho', ['ocPurchaseOrder' => $ocPurchaseOrder, 'ocDetailPurchaseOrder' => $ocPurchaseOrder->ocDetailPurchaseOrder, 'date' => $dataApproveals->first()->updated_at, 'approver' => $dataApproveals, 'applicant' => $applicant, 'excenta' => null ]);

        return $pdf->download("Orden de Compra N° ".$ocPurchaseOrder->id.".pdf");
    }
}
