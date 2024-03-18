<?php

namespace App\Http\Livewire\Ticket;

use App\Models\Roma\SaveEvent;
use App\Models\Ticket\Category;
use App\Models\Ticket\SubCategory;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FormTicketSubCategory extends Component
{
    public $category;
    public SubCategory $subCategory;

    protected $listeners = ['addCategory' => 'refreshCategory'];

    public function refreshCategory()
    {
        $this->category = Category::all();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->subCategory = new SubCategory();
        $this->category = Category::all();
    }

    public function rules (){
        return [
            'subCategory.name' => "required|unique:TK_sub_categories,name,". $this->subCategory->name .",id,category_id,".$this->subCategory->category_id,
            'subCategory.category_id' => "required|exists:TK_categories,id"
        ];
    }

    protected $messages = [
        'subCategory.name.required' => 'Este campo es obligatorio',
        'subCategory.name.unique' => 'Esta Sub Categoria ya existe en esta Categoria, favor validar',
        'subCategory.category_id.required' => 'Este campo es obligatorio',
        'subCategory.category_id.exists' => 'Esta Categoria no es valida',
    ];

    public function render()
    {
        return view('livewire.tickets.form-ticket-sub-category', [
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
            $event->Comentario = "Ingreso de Sub Categoria";
            $event->save();
        });

        $this->subCategory->name = null;
        $this->subCategory->category_id = null;

        $this->emit('addSubCategory');
        session()->flash('message', 'Sub Categoria guardada');
    }
}
