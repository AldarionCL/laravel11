<?php

namespace App\Http\Livewire\Accessory;

use App\Models\AccessoryTicket\AccessoryCategory;
use App\Models\AccessoryTicket\AccessorySubCategory;
use App\Models\Roma\SaveEvent;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AccessoryFormTicketSubCategory extends Component
{
    public $accessoryCategory;
    public AccessorySubCategory $accessorySubCategory;

    protected $listeners = ['addCategoryAccessory' => 'refreshCategory'];

    public function refreshCategory(): void
    {
        $this->accessoryCategory = AccessoryCategory::all();
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->accessorySubCategory = new AccessorySubCategory();
        $this->accessoryCategory = AccessoryCategory::all();
    }

    public function rules (): array
    {
        return [
            'accessorySubCategory.name' => "required|unique:TKa_sub_categories,name,". $this->accessorySubCategory->name .",id,category_id,".$this->accessorySubCategory->category_id,
            'accessorySubCategory.category_id' => "required|exists:TKa_categories,id"
        ];
    }

    protected $messages = [
        'accessorySubCategory.name.required' => 'Este campo es obligatorio',
        'accessorySubCategory.name.unique' => 'Esta Sub Categoria ya existe en esta Categoria, favor validar',
        'accessorySubCategory.category_id.required' => 'Este campo es obligatorio',
        'accessorySubCategory.category_id.exists' => 'Esta Categoria no es valida',
    ];

    public function render()
    {
        return view('livewire.accesory.accessory-form-ticket-sub-category', [
            'categories' => $this->accessoryCategory
        ]);
    }

    public function submit(): void
    {
        $this->validate();

        DB::transaction( function () {
            $this->accessorySubCategory->FechaCreacion = date('Y-m-d ');
            $this->accessorySubCategory->EventoCreacionID = 129;
            $this->accessorySubCategory->UsuarioCreacionID = auth()->user()->id;
            $this->accessorySubCategory->save();

            $event = new SaveEvent();
            $event->FechaCreacion = date('Y-m-d H:i:s');
            $event->EventoCreacionID = 129;
            $event->UsuarioCreacionID = auth()->user()->ID;
            $event->ReferenciaID = $this->accessorySubCategory->id;
            $event->MenuSecundarioID = 94;
            $event->Comentario = "Ingreso de Sub Categoria";
            $event->save();
        });

        $this->accessorySubCategory->name = null;
        $this->accessorySubCategory->category_id = null;

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
