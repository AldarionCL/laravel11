<?php

namespace App\Http\Livewire\Operation;

use App\Models\OperationTicket\OperationAgent;
use App\Models\OperationTicket\OperationCategory;
use App\Models\OperationTicket\OperationSubCategory;
use App\Models\Roma\BranchOffice;
use App\Models\Roma\Brand;
use App\Models\Roma\SaveEvent;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OperationFormAssignedAgentTicket extends Component
{
    public $category;
    public $subCategory;
    public $brand;
    public $zone;
    public $branch;
    public $agent;
    public Collection $categories;
    public Collection $subCategories;
    public Collection $brands;
    public Collection $businessAreas;
    public Collection $branches;
    public Collection $agents;

    protected $listeners = ['addSubCategory' => 'refreshSubCategory'];

    public function refreshSubCategory(): void
    {
        $this->categories = OperationCategory::all();
        $this->subCategories = collect([]);
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    protected $rules = [
        'category' => 'required',
        'subCategory' => 'required',
        'brand' => 'required',
        'zone' => 'required',
        'branch' => 'required',
        'agent' => 'required',
    ];

    protected $messages = [
        'category.required' => 'Este campo es obligatorio',
        'subCategory.required' => 'Este campo es obligatorio',
        'brand.required' => 'Este campo es obligatorio',
        'zone.required' => 'Este campo es obligatorio',
        'branch.required' => 'Este campo es obligatorio',
        'agent.required' => 'Este campo es obligatorio',
    ];

    public function mount(): void
    {
        $this->businessAreas = collect([]);
        $this->branches = collect([]);
        $this->subCategories = collect([]);
        $this->agents = collect([]);
    }

    public function updatedBrand( $value ): Collection
    {
        $type = BranchOffice::with(['typeOfBranches' => function ($query) {
            return $query->select('ID', 'TipoSucursal as name')->get();
        }])->select('ID', 'TipoSucursalID')->where('GerenciaID', $value)->get();

        $collect = collect();

        foreach ($type as $item)
        {
            $collect[] = $item->typeOfBranches;

        }

        return $this->businessAreas =  $collect->unique()->collapse();
    }

    public function updatedZone( $value ): Collection
    {
        return $this->branches = BranchOffice::select('ID', 'Sucursal')->where('TipoSucursalID', $value)->get();
    }

    public function updatedBranch( $value )
    {
        $this->agents = BranchOffice::find( $value )->users()->select('MA_Usuarios.ID', 'MA_Usuarios.Nombre')->where('MA_Usuarios.Activo', 1)->whereNotIn('MA_Usuarios.CargoID', [2,4,5,6])->orderBy('Nombre')->get();
    }

    public function updatedCategory($value): Collection
    {
        return $this->subCategories = OperationSubCategory::where('category_id', $value)->get();
    }

    public function render(): Renderable
    {
        $this->brands = Brand::select('ID as id', 'Gerencia as name')->where('Activo', 1)->where('Visible', 1)->orderBy('name', 'asc')->get();
        $this->categories = OperationCategory::all();

        return view('livewire.operation.operation-form-assigned-agent-ticket', [
            'brands' => $this->brands,
            'categories' => $this->categories
        ] );
    }

    public function submit(): void
    {
        $this->validate();

        DB::transaction( function () {
            $agent = new OperationAgent();
            $agent->user_id = $this->agent;
            $agent->subCategory_id = $this->subCategory;
            $agent->FechaCreacion = date('Y-m-d ');
            $agent->EventoCreacionID = 129;
            $agent->UsuarioCreacionID = auth()->user()->id;
            $agent->save();

            $event = new SaveEvent();
            $event->FechaCreacion = date('Y-m-d H:i:s');
            $event->EventoCreacionID = 129;
            $event->UsuarioCreacionID = 3;
            $event->ReferenciaID = $agent->id;
            $event->MenuSecundarioID = 94;
            $event->Comentario = "Asignación de Agente";
            $event->save();

        });

        $this->category = null;
        $this->subCategory = null;
        $this->brand = null;
        $this->zone = null;
        $this->branch = null;
        $this->agent = null;

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
