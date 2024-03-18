<?php

namespace App\Http\Livewire\Oc;

use App\Models\PurchaseOrder\OcDetailPurchaseOrder;
use App\Models\PurchaseOrder\OcPurchaseOrder;
use Livewire\Component;

class ReceptionFormOc extends Component
{
    public OcPurchaseOrder $ocPurchaseOrder;
    public $ocDetailOrderRequest;
    public $amount = [];
    public $document;


    public function rules()
    {
        return [
            'amount.*' => [ 'required', 'array', 'min:1', 'numeric' ],
            'document' => [ 'required'],
        ];
    }

    public function mount()
    {
        $this->ocDetailOrderRequest = OcDetailPurchaseOrder::with('ocProduct.ocSubCategory.ocCategory')->where('ocPurchaseOrder_id', $this->ocPurchaseOrder->id)->get();
    }

    public function render()
    {
        return view('livewire.oc.reception-form-oc');
    }

    public function submit()
    {
        $this->validate();
    }
}
