<?php

namespace App\Http\Livewire\CallCenter;

use App\Models\CallCenterTicket\CallCenterCategory;
use App\Models\Roma\SaveEvent;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CallCenterFormTicketCategory extends Component
{
    public CallCenterCategory $callCenterCategory;

    protected $rules = [
        'callCenterCategory.name' => 'required|unique:TKc_categories,name'
    ];

    protected $messages = [
        'callCenterCategory.name.required' => 'Este campo es obligatorio',
        'callCenterCategory.name.unique' => 'La Categoria ya existe, favor de revisar',
    ];

    public function mount()
    {
        $this->callCenterCategory = new CallCenterCategory();
    }

    public function render()
    {
        return view('livewire.call-center.call-center-form-ticket-category');
    }

    public function submit()
    {
        $this->validate();

        DB::transaction( function () {
            $this->callCenterCategory->FechaCreacion = date('Y-m-d ');
            $this->callCenterCategory->EventoCreacionID = 129;
            $this->callCenterCategory->UsuarioCreacionID = auth()->user()->id;
            $this->callCenterCategory->save();

            $event = new SaveEvent();
            $event->FechaCreacion = date('Y-m-d H:i:s');
            $event->EventoCreacionID = 129;
            $event->UsuarioCreacionID = auth()->user()->ID;
            $event->ReferenciaID = $this->callCenterCategory->id;
            $event->MenuSecundarioID = 94;
            $event->Comentario = "Ingreso de Categoria";
            $event->save();
        });

        $this->callCenterCategory->name = null;

        $this->emit('addCategoryCallCenter');
        $this->alertSuccess();
    }

    public function alertSuccess()
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'success',
            'message' => 'Categoria guardada'
        ]);
    }
}
