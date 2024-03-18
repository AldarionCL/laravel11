<?php

namespace App\Http\Livewire\Operation;

use App\Models\OperationTicket\OperationCategory;
use App\Models\OperationTicket\OperationSubCategory;
use App\Models\Roma\SaveEvent;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OperationFormTicketSubCategory extends Component
{
    public $operationCategory;
    public OperationSubCategory $operationSubCategory;

    protected $listeners = ['addCategoryOperation' => 'refreshCategory'];

    public function refreshCategory(): void
    {
        $this->operationCategory = OperationCategory::all();
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function mount(): void
    {
        $this->operationSubCategory = new OperationSubCategory();

    }

    public function rules (): array
    {
        return [
            'operationSubCategory.name' => "required|unique:TKo_sub_categories,name,". $this->operationSubCategory->name .",id,category_id,".$this->operationSubCategory->category_id,
            'operationSubCategory.category_id' => "required|exists:TKo_categories,id"
        ];
    }

    protected $messages = [
        'operationSubCategory.name.required' => 'Este campo es obligatorio',
        'operationSubCategory.name.unique' => 'Esta Sub Categoria ya existe en esta Categoria, favor validar',
        'operationSubCategory.category_id.required' => 'Este campo es obligatorio',
        'operationSubCategory.category_id.exists' => 'Esta Categoria no es valida',
    ];

    public function render(): Renderable
    {
        $this->operationCategory = OperationCategory::all();

        return view('livewire.operation.operation-form-ticket-sub-category', [
            'categories' => $this->operationCategory
        ]);
    }

    public function submit(): void
    {
        $this->validate();

        DB::transaction( function () {
            $this->operationSubCategory->FechaCreacion = date('Y-m-d ');
            $this->operationSubCategory->EventoCreacionID = 129;
            $this->operationSubCategory->UsuarioCreacionID = auth()->user()->id;
            $this->operationSubCategory->save();

            $event = new SaveEvent();
            $event->FechaCreacion = date('Y-m-d H:i:s');
            $event->EventoCreacionID = 129;
            $event->UsuarioCreacionID = auth()->user()->ID;
            $event->ReferenciaID = $this->operationSubCategory->id;
            $event->MenuSecundarioID = 94;
            $event->Comentario = "Ingreso de Sub Categoria";
            $event->save();
        });

        $this->operationSubCategory->name = null;
        $this->operationSubCategory->category_id = null;

        $this->emit('addSubCategory');
        $this->alertSuccess();
    }

    public function alertSuccess(): void
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'success',
            'message' => 'Sub Categoria guardada'
        ]);
    }
}
