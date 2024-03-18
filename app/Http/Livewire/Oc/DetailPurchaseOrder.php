<?php

namespace App\Http\Livewire\Oc;

use App\Http\Utils\ProcessPurchaseOrder;
use App\Mail\NotificationModifiedOrders;
use App\Models\OrderRequest\FileOrderRequest;
use App\Models\OrderRequest\OcOrderRequest;
use App\Models\PurchaseOrder\Approval;
use App\Models\PurchaseOrder\Approver;
use App\Models\PurchaseOrder\OcDetailPurchaseOrder;
use App\Models\PurchaseOrder\OcPurchaseOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class DetailPurchaseOrder extends Component
{
    use AuthorizesRequests;

    public OcPurchaseOrder $ocPurchaseOrder;
    public $message;
    public $month;
    public $modifiedProducts = [];
    public $files;
    public $excenta = false;
    public $productsFromPreviousOrders;

    public function mount( OcPurchaseOrder $ocPurchaseOrder )
    {
        $this->authorize('create', new Approver );

        $this->ocPurchaseOrder = $ocPurchaseOrder->load( ['ocDetailPurchaseOrder.ocProduct.accountingBudget' => function( $query ) {
            $query->where( 'Year', date( 'Y' ) );
        }] );

        $arrayFiles = array_map('intval', json_decode( $ocPurchaseOrder->ocOrderRequest_ids, true ));

        $this->files = FileOrderRequest::where( 'branchOffice_id',  $ocPurchaseOrder->recorder->purchaseOrderGenerator->branchOffice_id )
            ->whereIn( 'ocOrderRequest_id', array_map('intval', json_decode( $ocPurchaseOrder->ocOrderRequest_ids, true ) ) )
            ->select('id', 'url', 'ocOrderRequest_id', 'branchOffice_id')->get()->toArray();
    }

    public function render()
    {
        $ordersId = Arr::flatten( OcPurchaseOrder::ocPurchaseOrderForBranch( $this->ocPurchaseOrder->branch_id, $this->ocPurchaseOrder->id )->get()->toArray() );
        $productsId = Arr::flatten( OcDetailPurchaseOrder::select('ocProduct_id' )->where('ocPurchaseOrder_id', $this->ocPurchaseOrder->id )->get()->toArray() );

        $this->productsFromPreviousOrders = OcDetailPurchaseOrder::select( 'id', 'ocProduct_id', 'amount', DB::raw('DATE_FORMAT( MAX( created_at ), "%d-%m-%Y" ) as fecha') )
            ->whereIn( 'ocPurchaseOrder_id', $ordersId )
            ->whereIn( 'ocProduct_id', $productsId )->groupBy( 'ocProduct_id')->get();

        return view('livewire.oc.detail-purchase-order', [
            'previousOrders' => $this->productsFromPreviousOrders
        ]);
    }

    public function submit()
    {

        $this->authorize( 'update', $this->ocPurchaseOrder );

        $this->ocPurchaseOrder->comment = $this->message ?? '';
        $this->ocPurchaseOrder->save();
        $process = new ProcessPurchaseOrder( $this->ocPurchaseOrder, 'passed' );
        $response = $process->states();

        if (!empty($this->modifiedProducts)) {
            $this->modificationNotification();
        }

        $this->alertSuccess( $response['type'], $response['message'] );
    }

    public function decline()
    {
        $this->validate(
            [
                'message' => 'required|max:5000',
            ],
            [
                'message.required' => 'Este campo es obligatorio, en caso de rechazar Solicitud de compra',
                'message.max' => 'El campo puede tener un maximo de 5000 caracteres',
            ]
        );

        $this->ocPurchaseOrder->comment = $this->message ?? '';
        $this->ocPurchaseOrder->save();
        $process = new ProcessPurchaseOrder( $this->ocPurchaseOrder, 'refused' );
        $response = $process->states();

        $this->alertSuccess( $response['type'], $response['message'] );
    }

    public function alertSuccess( $type, $message )
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => $type,
            'message' => $message
        ]);
    }

    public function plus( $id )
    {
        $amount = OcDetailPurchaseOrder::whereId($id)->select('totalPrice', 'unitPrice')->get()->toArray();

        OcDetailPurchaseOrder::where('id', $id)
            ->where('ocPurchaseOrder_id', $this->ocPurchaseOrder->id )
            ->increment('amount', 1, [ 'totalPrice' => $amount[0]['totalPrice'] + $amount[0]['unitPrice'] ]);

        $this->detailOfModifiedProducts($id);

        $this->hydrateOcPurchaseOrder();
    }

    public function minus( $id )
    {

        $product = OcDetailPurchaseOrder::with('ocProduct:id,name,sku')
            ->where('id', $id)
            ->where('ocPurchaseOrder_id', $this->ocPurchaseOrder->id)
            ->select('id as idOcDetailOrderRequest', 'ocProduct_id', 'ocPurchaseOrder_id', 'amount', 'totalPrice', 'unitPrice')
            ->get()
            ->toArray();

//        dd($product);

        if ($product[0]['amount'] > 1){
            OcDetailPurchaseOrder::where('id', $id)
                ->where('ocPurchaseOrder_id', $this->ocPurchaseOrder->id )
                ->decrement('amount', 1, [ 'totalPrice' => $product[0]['totalPrice'] - $product[0]['unitPrice'] ]);
        }else{

            $this->detailOfModifiedProducts($product[0]['oc_product']);
            $this->trash( $id );
        }

        $this->hydrateOcPurchaseOrder();
    }

    public function trash( $id )
    {
        OcDetailPurchaseOrder::where('id', $id)
            ->where('ocPurchaseOrder_id', $this->ocPurchaseOrder->id )
            ->delete();

        $this->hydrateOcPurchaseOrder();
    }

    public function hydrateOcPurchaseOrder()
    {
        $this->ocPurchaseOrder->refresh();
    }

    public function pdfDownload( $value )
    {
        $dataApproveals = Approval::where('ocOrderRequest_id', $this->ocPurchaseOrder->id)->where('type', 2)->orderBY('id', 'desc')->limit(2)->get();

        $arrayFiles = array_map('intval', json_decode( $this->ocPurchaseOrder->ocOrderRequest_ids, true ));

        $applicant = "";

        if ($arrayFiles){
            $data = OcOrderRequest::find( $arrayFiles[0] );
            $applicant = $data->recorder->Nombre;
        }

        $pdfContent = PDF::loadView('oc.document.despacho', ['ocPurchaseOrder' => $this->ocPurchaseOrder, 'ocDetailPurchaseOrder' => $this->ocPurchaseOrder->ocDetailPurchaseOrder, 'date' => $dataApproveals->first()->updated_at, 'approver' => $dataApproveals, 'applicant' => $applicant, 'excenta' => $this->excenta ])->output();

        return response()->streamDownload(
            fn () => print($pdfContent),
            "Orden de Compra N° ".$this->ocPurchaseOrder->id.".pdf"
        );
    }

    public function detailOfModifiedProducts($product): void
    {
        if (empty($this->modifiedProducts)) {
            $this->modifiedProducts[] = $product;
        } else {

            $modifiedList = collect( $this->modifiedProducts );

            if ( !$modifiedList->containsStrict('id',  $product) ) {
                $this->modifiedProducts[] = $product;
            }

        }
    }

    public function modificationNotification(): void
    {
        try {
            Mail::mailer('solicitudes')->to($this->ocPurchaseOrder->recorder->Email)->send(new NotificationModifiedOrders($this->ocPurchaseOrder->recorder->Nombre, $this->ocPurchaseOrder->id, $this->modifiedProducts, "Solicitud de compra"));
        }catch (Exception $exception){
            Log::error( "Se produjo un error al enviar correo OC detalle: $exception");
        }
    }
}
