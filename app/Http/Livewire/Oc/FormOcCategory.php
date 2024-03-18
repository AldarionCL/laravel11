<?php

namespace App\Http\Livewire\Oc;

use App\Models\OrderRequest\OcCategory;
use App\Models\Roma\SaveEvent;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FormOcCategory extends Component
{
    public OcCategory $category;

    protected $rules = [
        'category.name' => 'required|unique:SP_oc_categories,name'
    ];

    protected $messages = [
        'category.name.required' => 'Este campo es obligatorio',
        'category.name.unique' => 'La Categoria ya existe, favor de revisar',
    ];

    public function mount()
    {
        $this->category = new OcCategory();
    }

    public function render()
    {
        return view('livewire.oc.form-oc-category');
    }

    public function submit()
    {
        $this->validate();

        DB::transaction( function () {

            $this->category->FechaCreacion = date('Y-m-d ');
            $this->category->EventoCreacionID = 129;
            $this->category->UsuarioCreacionID = auth()->user()->ID;
            $this->category->save();

            $event = new SaveEvent();
            $event->FechaCreacion = date('Y-m-d H:i:s');
            $event->EventoCreacionID = 129;
            $event->UsuarioCreacionID = auth()->user()->ID;
            $event->ReferenciaID = $this->category->id;
            $event->MenuSecundarioID = 94;
            $event->Comentario = "Ingreso de Categoria OC";
            $event->save();
        });

        $this->category->name = null;
        $this->emit('addCategory');
        $this->alertSuccess();
    }

    public function alertSuccess()
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'success',
            'message' => 'Categoria OC guardado'
        ]);
    }
}
