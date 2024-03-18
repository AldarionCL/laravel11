<?php

namespace App\Http\Livewire\CallCenter;

use App\Models\CallCenterTicket\CallCenterCategory;
use App\Models\CallCenterTicket\CallCenterSubCategory;
use Livewire\Component;

class CallCenterFormTicketSubCategory extends Component
{
    public $callCenterCategory;
    public CallCenterSubCategory $callCenterSubCategory;

    protected $listeners = ['addCategoryCallCenter' => 'refreshCategory'];

    public function refreshCategory()
    {
        $this->callCenterCategory = CallCenterCategory::all();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->callCenterSubCategory = new CallCenterSubCategory();
        $this->callCenterCategory = CallCenterCategory::all();
    }

    public function rules (){
        return [
            'callCenterSubCategory.name' => "required|unique:TKc_sub_categories,name,". $this->callCenterSubCategory->name .",id,category_id,".$this->callCenterSubCategory->category_id,
            'callCenterSubCategory.category_id' => "required|exists:TKc_categories,id"
        ];
    }

    protected $messages = [
        'callCenterSubCategory.name.required' => 'Este campo es obligatorio',
        'callCenterSubCategory.name.unique' => 'Esta Sub Categoria ya existe en esta Categoria, favor validar',
        'callCenterSubCategory.category_id.required' => 'Este campo es obligatorio',
        'callCenterSubCategory.category_id.exists' => 'Esta Categoria no es valida',
    ];

    public function render()
    {
        return view('livewire.call-center.call-center-form-ticket-sub-category', [
            'categories' => $this->callCenterCategory
        ]);
    }

    public function submit()
    {
        $this->validate();

        DB::transaction( function () {
            $this->callCenterSubCategory->FechaCreacion = date('Y-m-d ');
            $this->callCenterSubCategory->EventoCreacionID = 129;
            $this->callCenterSubCategory->UsuarioCreacionID = auth()->user()->id;
            $this->callCenterSubCategory->save();

            $event = new SaveEvent();
            $event->FechaCreacion = date('Y-m-d H:i:s');
            $event->EventoCreacionID = 129;
            $event->UsuarioCreacionID = auth()->user()->ID;
            $event->ReferenciaID = $this->callCenterSubCategory->id;
            $event->MenuSecundarioID = 94;
            $event->Comentario = "Ingreso de Sub Categoria";
            $event->save();
        });

        $this->callCenterSubCategory->name = null;
        $this->callCenterSubCategory->category_id = null;

        $this->emit('addSubCategory');
        $this->alertSuccess();
    }

    public function alertSuccess()
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'success',
            'message' => 'Sub Categoria guardada'
        ]);
    }
}
