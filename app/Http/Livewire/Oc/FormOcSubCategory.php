<?php

namespace App\Http\Livewire\Oc;

use App\Models\OrderRequest\OcCategory;
use App\Models\OrderRequest\OcSubCategory;
use App\Models\Roma\SaveEvent;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FormOcSubCategory extends Component
{
    public $category;
    public OcSubCategory $subCategory;

    protected $listeners = ['addCategory' => 'refreshCategory'];

    public function refreshCategory()
    {
        $this->category = OcCategory::all();
    }

    public function mount()
    {
        $this->category = OcCategory::select('id', 'name')->orderBy('name', 'ASC')->get()->toArray();
        $this->subCategory = new OcSubCategory();
    }

    public function rules (){
        return [
            'subCategory.name' => "required|unique:SP_oc_sub_categories,name,". $this->subCategory->name .",id,ocCategory_id,".$this->subCategory->category_id,
            'subCategory.ocCategory_id' => "required|exists:SP_oc_categories,id"
        ];
    }

    protected $messages = [
        'subCategory.name.required' => 'Este campo es obligatorio',
        'subCategory.ocCategory_id.required' => 'Este campo es obligatorio',
    ];

    public function render()
    {
        return view('livewire.oc.form-oc-sub-category', [
            'categories' => $this->category
        ]);
    }

    public function submit()
    {
        $this->validate();

        DB::transaction( function () {
            $this->subCategory->FechaCreacion = date('Y-m-d ');
            $this->subCategory->EventoCreacionID = 129;
            $this->subCategory->UsuarioCreacionID = auth()->user()->id;
            $this->subCategory->save();

            $event = new SaveEvent();
            $event->FechaCreacion = date('Y-m-d H:i:s');
            $event->EventoCreacionID = 129;
            $event->UsuarioCreacionID = auth()->user()->ID;
            $event->ReferenciaID = $this->subCategory->id;
            $event->MenuSecundarioID = 94;
            $event->Comentario = "Ingreso de Sub Categoria OC";
            $event->save();
        });

        $this->subCategory->name = null;
        $this->subCategory->category_id = null;

        $this->emit('addSubCategory');
        $this->alertSuccess();

    }

    public function alertSuccess()
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'success',
            'message' => 'Sub Categoria OC guardado'
        ]);
    }
}
