<?php

namespace App\Http\Livewire\Oc;

use App\Models\OrderRequest\FileOrderRequest;
use App\Models\OrderRequest\OcDetailOrderRequest;
use App\Models\OrderRequest\OcOrderRequest;
use App\Models\OrderRequest\OcQuoteGenerator;
use App\Models\OrderRequest\Stock;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;

class PricesOrderRequest extends Component
{
    use WithFileUploads, AuthorizesRequests;

    public $editedDetailIndex = null;
    public $editedDetailField = null;
    public OcOrderRequest $ocOrderRequest;
    public $ocDetailOrderRequest = [];
    public $detail;
    public $files = [];

    public function mount()
    {
        $this->authorize( 'create', new OcQuoteGenerator );

        $this->detail();
    }

    public function render()
    {
        return view('livewire.oc.prices-order-request', [
            'ocDetailOrderRequest' => $this->ocDetailOrderRequest
        ]);
    }

    public function editDetail($detailIndex)
    {
        $this->editedDetailIndex = $detailIndex;
    }

    public function editDetailField($detailIndex, $fieldUnitPrice)
    {
        $this->editedDetailField = $detailIndex . '.' . $fieldUnitPrice;
    }

    public function saveDetail($detailIndex)
    {
        $this->validate(
            [
                'ocDetailOrderRequest.*.unitPrice' => ['required', 'numeric']
            ],

            [
                'ocDetailOrderRequest.*.unitPrice.required' => 'Este campo es requerido',
                'ocDetailOrderRequest.*.unitPrice.numeric' => 'Debe ser un número',
            ]
        );

        $detail = $this->ocDetailOrderRequest[$detailIndex] ?? null;

        if (!is_null($detail)) {
            $ocDetailOrderRequest = OcDetailOrderRequest::find($detail['id']);
            $ocDetailOrderRequest->unitPrice = $detail['unitPrice'];
            $ocDetailOrderRequest->totalPrice = $detail['unitPrice'] * $ocDetailOrderRequest->amount;
            $ocDetailOrderRequest->save();
        }

        $this->editedDetailIndex = null;
        $this->editedDetailField = null;

        $this->mount();

        return response()->json(200);
    }

    public function submit()
    {
        $this->validate(
            [
                'files' => [ 'max:3' ],
                'files.*' => [ 'mimes:jpg,png,pdf', 'max:5000' ],
            ],
            [
                'files.*.mimes' => 'Debe ser un documento tipo jpg,png,pdf',
                'files.*.max' => 'El docuemento debe tener un maximo de 5M',
            ]

        );

        if ($this->files){
            foreach ($this->files as $item) {

                $file = new FileOrderRequest();
                $path = $item->store('public/purchaseorder');
                $file->url = $path;
                $file->ocOrderRequest_id = $this->ocOrderRequest->id;
                $file->branchOffice_id = auth()->user()->quoteGenerator->branchOffice_id;
                $file->save();

                /*$enteredPrices = OcDetailOrderRequest::where('ocOrderRequest_id', $this->ocOrderRequest->id )->where('unitPrice', '=', 0)->get()->isEmpty() ;

                if ( $enteredPrices ){
                    $this->ocOrderRequest->update([
                        'state' => 4
                    ]);
                }*/

                $this->alertSuccess('success', 'Documentación guardada!!!');

                $this->files = [];
            }
        }
        $this->alertSuccess('success', 'Documentación guardada!!!');
    }

    public function inStock( OcDetailOrderRequest $ocDetailOrderRequest )
    {
        $stock = Stock::create([
            'ocCategory_id' => $ocDetailOrderRequest->ocCategory_id,
            'ocSubCategory_id' => $ocDetailOrderRequest->ocSubCategory_id,
            'ocProduct_id' => $ocDetailOrderRequest->ocProduct_id,
            'amount' => $ocDetailOrderRequest->amount,
            'unitPrice' => $ocDetailOrderRequest->unitPrice,
            'totalPrice' => $ocDetailOrderRequest->totalPrice,
            'ocOrderRequest_id' => $ocDetailOrderRequest->ocOrderRequest_id,
            'state' => $ocDetailOrderRequest->state,
            'description' => $ocDetailOrderRequest->description,
        ]);

        $ocDetailOrderRequest->delete();

        $this->alertSuccess('info', 'Enviado a Stock');

        $this->detail();
    }

    public function alertSuccess($type, $message): void
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => $type,
            'message' => $message
        ]);
    }

    /**
     * @return void
     */
    public function detail(): void
    {
        $this->ocDetailOrderRequest = OcDetailOrderRequest::whereHas('ocProduct', function ($query) {
            $query->where('costCenter_id', auth()->user()->quoteGenerator->branchOffice_id);
        })->with(['ocProduct.ocSubCategory.ocCategory'])
            ->where('ocOrderRequest_id', $this->ocOrderRequest->id)
            ->where('unitPrice', '=', 0)
            ->get()->toArray();
    }
}
