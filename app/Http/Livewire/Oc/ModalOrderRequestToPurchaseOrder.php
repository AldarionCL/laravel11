<?php

namespace App\Http\Livewire\Oc;

use App\Models\OrderRequest\OcOrderRequest;
use LivewireUI\Modal\ModalComponent;

class ModalOrderRequestToPurchaseOrder extends ModalComponent
{
    public $orderRequest = array();
    public $order;

    public function mount()
    {
        $orderRequest = OcOrderRequest::with('branchOffice:ID,Sucursal')->where('state', 4)->select('id', 'branch_id')->get();

        if ($orderRequest !== null) {
            foreach ($orderRequest as $order) {
                $this->orderRequest[] = ["id" => $order->id, "name" => $order->id . " - " . $order->branchOffice->Sucursal];

            }
        }
    }

    public function render()
    {
        return view('livewire.oc.modal-order-request-to-purchase-order');
    }

    public function submit()
    {
        $this->closeModal();
        $this->emit('sendOrderRequest', $this->order);
    }

    public function close()
    {
        $this->closeModal();
    }
}
