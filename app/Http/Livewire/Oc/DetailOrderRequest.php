<?php

namespace App\Http\Livewire\Oc;

use App\Http\Utils\ProcessOrderRequest;
use App\Mail\NotificationModifiedOrders;
use App\Models\OrderRequest\OcDetailOrderRequest;
use App\Models\OrderRequest\OcOrderRequest;
use App\Models\PurchaseOrder\Approval;
use App\Models\PurchaseOrder\OcPurchaseOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DetailOrderRequest extends Component
{
    use AuthorizesRequests;

    public OcOrderRequest $ocOrderRequest;
    public $message;
    public $modifiedProducts = [];
    public $productsFromPreviousOrders;

    public function mount(OcOrderRequest $ocOrderRequest)
    {
        if ($ocOrderRequest->state === 6) {
            return redirect()->to('/listado-solicitud-de-pedidos');
        }
        $this->ocOrderRequest = $ocOrderRequest;

        $this->ocOrderRequest->load('ocDetailOrderRequest.ocProduct');



    }

    public function render(): Renderable
    {
        $ordersId = Arr::flatten( OcOrderRequest::ocOrderRequestForBranch( $this->ocOrderRequest->branch_id, $this->ocOrderRequest->id )->get()->toArray() );
        $productsId = Arr::flatten( OcDetailOrderRequest::select('ocProduct_id' )->where('ocOrderRequest_id', $this->ocOrderRequest->id )->get()->toArray() );

        $this->productsFromPreviousOrders = OcDetailOrderRequest::select( 'id', 'ocProduct_id', 'amount', DB::raw('DATE_FORMAT( MAX( created_at ), "%d-%m-%Y" ) as fecha') )
            ->whereIn( 'ocOrderRequest_id', $ordersId )
            ->whereIn( 'ocProduct_id', $productsId )->groupBy( 'ocProduct_id')->get();

        return view('livewire.oc.detail-order-request', [
            'previousOrders' => $this->productsFromPreviousOrders
        ]);
    }

    public function submit()
    {
        $this->authorize('update', $this->ocOrderRequest);

        $process = new ProcessOrderRequest($this->ocOrderRequest, 'passed');
        $response = $process->states();

        if (!empty($this->modifiedProducts)) {
            $this->modificationNotification();
        }
        $this->alertSuccess($response['type'], $response['message']);
    }

    public function decline()
    {
        $this->authorize('update', $this->ocOrderRequest);

        $this->validate(
            [
                'message' => 'required|max:5000',
            ],
            [
                'message.required' => 'Este campo es obligatorio, en caso de rechazar Solicitud de compra',
                'message.max' => 'El campo puede tener un maximo de 5000 caracteres',
            ]
        );

        $process = new ProcessOrderRequest($this->ocOrderRequest, 'refused');
        $response = $process->states();

        $this->alertSuccess($response['type'], $response['message']);
    }

    public function alertSuccess($type, $message)
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => $type,
            'message' => $message
        ]);
    }

    public function plus($id)
    {
        $this->authorize('update', $this->ocOrderRequest);

        OcDetailOrderRequest::where('id', $id)
            ->where('ocOrderRequest_id', $this->ocOrderRequest->id)
            ->increment('amount', 1);

        $this->detailOfModifiedProducts($id);

        $this->hydrateOcOrderRequest();
    }

    public function minus($id)
    {
        $this->authorize('update', $this->ocOrderRequest);

        $product = OcDetailOrderRequest::with('ocProduct:id,name,sku')
            ->where('id', $id)
            ->where('ocOrderRequest_id', $this->ocOrderRequest->id)
            ->select('id as idOcDetailOrderRequest', 'ocProduct_id', 'ocOrderRequest_id', 'amount')
            ->get()
            ->toArray();

        if ($product[0]['amount'] > 1) {
            OcDetailOrderRequest::where('id', $id)
                ->where('ocOrderRequest_id', $this->ocOrderRequest->id)
                ->decrement('amount', 1);

            $this->detailOfModifiedProducts($product[0]['oc_product']);

        } else {

            $this->detailOfModifiedProducts($product[0]['oc_product']);
            $this->trash($id);
        }

        $this->hydrateOcOrderRequest();
    }

    public function trash($id): void
    {
        $this->authorize('update', $this->ocOrderRequest);

        OcDetailOrderRequest::where('id', $id)
            ->where('ocOrderRequest_id', $this->ocOrderRequest->id)
            ->delete();

        $this->hydrateOcOrderRequest();
    }

    public function hydrateOcOrderRequest(): void
    {
        $this->ocOrderRequest->refresh();
    }

    public function detailOfModifiedProducts($product): void
    {
        if (empty($this->modifiedProducts)) {
            $this->modifiedProducts[] = $product;
        } else {

            $modifiedList = collect($this->modifiedProducts);

            if (!$modifiedList->containsStrict('id', $product)) {
                $this->modifiedProducts[] = $product;
            }

        }
    }

    public function modificationNotification(): void
    {
        try {
            Mail::mailer('solicitudes')->to($this->ocOrderRequest->recorder->Email)->send(new NotificationModifiedOrders($this->ocOrderRequest->recorder->Nombre, $this->ocOrderRequest->id, $this->modifiedProducts, "Solicitud de compra"));
        } catch (Exception $exception) {
            Log::error("Se produjo un error al enviar correo OC detalle: $exception");
        }
    }

    public function pdfDownload($value): StreamedResponse
    {
        $ocPurchaseOrder = OcPurchaseOrder::where('id', $value)->get();

        $id = $ocPurchaseOrder->toArray();

        $dataApproveals = Approval::where('ocOrderRequest_id', $value)->where('type', 2)->orderBy('id', 'desc')->limit(2)->get();

        $arrayFiles = array_map('intval', json_decode($id[0]['ocOrderRequest_ids'], true));

        $ocDetailPurchaseOrder = '';

        foreach ($ocPurchaseOrder as $detail) {
            $ocDetailPurchaseOrder = $detail;
        }

        $applicant = "";

        if ($arrayFiles) {
            $data = OcOrderRequest::find($arrayFiles[0]);
            $applicant = $data->recorder->Nombre;
        }

        $pdfContent = PDF::loadView('oc.document.despacho', ['ocPurchaseOrder' => $ocDetailPurchaseOrder, 'ocDetailPurchaseOrder' => $ocDetailPurchaseOrder->ocDetailPurchaseOrder, 'date' => $dataApproveals->first()->updated_at, 'approver' => $dataApproveals, 'applicant' => $applicant, 'excenta' => null])->output();

        return response()->streamDownload(
            fn() => print($pdfContent),
            "Orden de Compra N° " . $id[0]['id'] . ".pdf"
        );
    }

    public function cancel($value): void
    {
        DB::transaction(function () use ($value) {

            OcOrderRequest::where('id', $value)
                ->update([
                    'state' => 6
                ]);

            $this->dispatchBrowserEvent('swal:success', [
                'type' => 'success',
                'message' => 'Solicitud Anulada'
            ]);

        });
    }
}
