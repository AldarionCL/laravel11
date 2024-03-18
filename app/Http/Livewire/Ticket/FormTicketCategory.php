<?php

namespace App\Http\Livewire\Ticket;

use App\Models\Roma\SaveEvent;
use App\Models\Ticket\Category;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FormTicketCategory extends Component
{
    public Category $category;

    protected $rules = [
      'category.name' => 'required|unique:TK_categories,name'
    ];

    protected $messages = [
        'category.name.required' => 'Este campo es obligatorio',
        'category.name.unique' => 'La Categoria ya existe, favor de revisar',
    ];

    public function mount()
    {
        $this->category = new Category();
    }

    public function render()
    {
        return view('livewire.tickets.form-ticket-category');
    }

    public function submit()
    {
        $this->validate();

        DB::transaction( function () {
            $this->category->FechaCreacion = date('Y-m-d ');
            $this->category->EventoCreacionID = 129;
            $this->category->UsuarioCreacionID = auth()->user()->id;
            $this->category->save();

            $event = new SaveEvent();
            $event->FechaCreacion = date('Y-m-d H:i:s');
            $event->EventoCreacionID = 129;
            $event->UsuarioCreacionID = auth()->user()->ID;
            $event->ReferenciaID = $this->category->id;
            $event->MenuSecundarioID = 94;
            $event->Comentario = "Ingreso de Categoria";
            $event->save();
        });

        $this->category->name = null;

        $this->emit('addCategory');
        session()->flash('message', 'Categoria guardada');
    }
}
