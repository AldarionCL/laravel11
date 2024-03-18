<?php

namespace App\Http\Livewire\Operation;

use App\Models\OperationTicket\OperationCategory;
use App\Models\Roma\SaveEvent;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OperationFormTicketCategory extends Component
{
    public OperationCategory $operationCategory;

    protected $rules = [
        'operationCategory.name' => 'required|unique:TKc_categories,name'
    ];

    protected $messages = [
        'operationCategory.name.required' => 'Este campo es obligatorio',
        'operationCategory.name.unique' => 'La Categoria ya existe, favor de revisar',
    ];

    public function mount(): void
    {
        $this->operationCategory = new OperationCategory();
    }

    public function render(): Renderable
    {
        return view('livewire.operation.operation-form-ticket-category');
    }

    public function submit(): void
    {
        $this->validate();

        DB::transaction( function () {
            $this->operationCategory->FechaCreacion = date('Y-m-d ');
            $this->operationCategory->EventoCreacionID = 129;
            $this->operationCategory->UsuarioCreacionID = auth()->user()->id;
            $this->operationCategory->save();

            $event = new SaveEvent();
            $event->FechaCreacion = date('Y-m-d H:i:s');
            $event->EventoCreacionID = 129;
            $event->UsuarioCreacionID = auth()->user()->ID;
            $event->ReferenciaID = $this->operationCategory->id;
            $event->MenuSecundarioID = 94;
            $event->Comentario = "Ingreso de Categoria";
            $event->save();
        });

        $this->operationCategory = new OperationCategory();

        $this->emit('addCategoryOperation');
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
