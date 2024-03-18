<?php

namespace App\Http\Livewire\Accessory;

use App\Models\AccessoryTicket\AccessoryCategory;
use App\Models\Roma\SaveEvent;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AccessoryFormTicketCategory extends Component
{
    public AccessoryCategory $accessoryCategory;

    protected $rules = [
        'accessoryCategory.name' => 'required|unique:TKc_categories,name'
    ];

    protected $messages = [
        'accessoryCategory.name.required' => 'Este campo es obligatorio',
        'accessoryCategory.name.unique' => 'La Categoria ya existe, favor de revisar',
    ];

    public function mount(): void
    {
        $this->accessoryCategory = new AccessoryCategory();
    }

    public function render()
    {
        return view('livewire.accesory.accessory-form-ticket-category');
    }

    public function submit()
    {
        $this->validate();

        DB::transaction( function () {
            $this->accessoryCategory->FechaCreacion = date('Y-m-d ');
            $this->accessoryCategory->EventoCreacionID = 129;
            $this->accessoryCategory->UsuarioCreacionID = auth()->user()->id;
            $this->accessoryCategory->save();

            $event = new SaveEvent();
            $event->FechaCreacion = date('Y-m-d H:i:s');
            $event->EventoCreacionID = 129;
            $event->UsuarioCreacionID = auth()->user()->ID;
            $event->ReferenciaID = $this->accessoryCategory->id;
            $event->MenuSecundarioID = 94;
            $event->Comentario = "Ingreso de Categoria";
            $event->save();
        });

        $this->accessoryCategory = new AccessoryCategory();

        $this->emit('addCategoryAccessory');
        $this->alertSuccess();
    }

    public function alertSuccess(): void
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'success',
            'message' => 'Categoria guardada'
        ]);
    }
}
