<?php

namespace App\Http\Livewire\Ticket;

use App\Models\Ticket\Agent;
use App\Models\Ticket\Category;
use App\Models\Ticket\SubCategory;
use App\Models\Ticket\Ticket;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ReassignmentTicket extends ModalComponent
{
    public $category;
    public array $categories;
    public $subCategory;
    public array $subCategories;
    public $ticket;

    public function mount($id): void
    {
        $this->ticket = $id;
            $this->categories = Category::select('id', 'name')->get()->toArray();
            $this->subCategories = array();
    }

    public function render(): Renderable
    {
        return view('livewire.tickets.reassignment-ticket');
    }

    public function submit()
    {
        $this->validate();

        $agent = '';

        $ticket = Ticket::where('subCategory', $this->subCategory)->latest()->first();

        if($ticket !== null )
        {
            $agentNext = Agent::where('subCategory_id', $this->subCategory)->where( 'user_id', '>', $ticket['assigned'])->orderBy('id')->first();

            $agentFirst = Agent::where('subCategory_id', $this->subCategory)->orderBy('user_id', 'ASC')->first()->getAttribute('user_id');

            $agent = $agentNext !== null ? $agentNext->getAttribute('user_id') : $agentFirst;
        }else{

            $agentFirst = Agent::where('subCategory_id', $this->subCategory)->orderBy('id')->first()->getAttribute('user_id');

            $agent = $agentFirst;
        }

        Ticket::where('id', $this->ticket)
            ->update(['category' => $this->category, 'subCategory' => $this->subCategory, 'assigned' => $agent]);

        return redirect()->to('/ticket');
    }

    public function close(): void
    {
        $this->closeModal();
    }

    public function rules (): array
    {
        return [
            'category' => 'required|exists:TK_categories,id',
            'subCategory' => "required|exists:TK_sub_categories,id,category_id,{$this->category}",
        ];
    }

    protected $messages = [
        'category.required' => 'El campo Categoría, es obligatorio',
        'category.exists' => 'La Categoría, no es valida',
        'subCategory.required' => 'El campo Sub Categoría, es obligatorio',
        'subCategory.exists' => 'La Sub Categoría, no es valida'
    ];

    public function updatedCategory($value): array
    {
        return $this->subCategories = SubCategory::where('category_id', $value)->get()->toArray();
    }
}
