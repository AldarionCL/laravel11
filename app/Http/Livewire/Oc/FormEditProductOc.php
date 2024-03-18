<?php

namespace App\Http\Livewire\Oc;

use App\Models\OrderRequest\Currency;
use App\Models\OrderRequest\Measure;
use App\Models\OrderRequest\OcCategory;
use App\Models\OrderRequest\OcProduct;
use App\Models\OrderRequest\OcSubCategory;
use App\Models\Roma\BranchOffice;
use App\Models\Roma\SaveEvent;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FormEditProductOc extends Component
{
    public OcProduct $ocProduct;
    public $branchOffice;
    public $measures;
    public $currencies;
    public $category;
    public $categories;
    public $subCategories;


    public function mount()
    {
        $this->category = $this->ocProduct->ocSubCategory->ocCategory->id;
        $this->categories = OcCategory::select( 'id', 'name' )->get()->toArray();
        $this->branchOffice = BranchOffice::where('VisibleOC', 1)->select('ID', 'Sucursal')->get()->toArray();
        $this->currencies = Currency::all();
        $this->measures = Measure::all();
        $this->subCategories = OcSubCategory::where( 'id', $this->ocProduct->ocSubCategory->id )->get()->toArray();
    }

    public function render()
    {
        return view('livewire.oc.form-edit-product-oc');
    }

    public function rules()
    {
        return [
            'category' => 'required|exists:SP_oc_categories,id',
            'ocProduct.ocSubCategory_id' => "required|exists:SP_oc_sub_categories,id,ocCategory_id,{$this->category}",
            'ocProduct.name' => "required|unique:SP_oc_products,name,{$this->ocProduct->id},id,ocSubCategory_id,{$this->ocProduct->ocSubCategory_id}",
            'ocProduct.costCenter_id' => "required|exists:MA_Sucursales,ID",
            'ocProduct.measure_id' => "required|exists:SP_measures,id",
            'ocProduct.currency_id' => "required|exists:SP_currencies,id",
        ];
    }

    protected $messages = [
        'category.required' => 'Este campo es obligatorio',
        'category.exists' => 'La Categoria seleccionada no es valida',
        'ocProduct.ocSubCategory_id.required' => 'Este campo es obligatorio',
        'ocProduct.ocSubCategory_id.exists' => 'La Sub Categoria seleccionada no es valida',
        'ocProduct.name.required' => 'Este campo es obligatorio',
        'ocProduct.name.unique' => 'El Producto ya existe en esta Sub Categoria, favor de validar',
        'ocProduct.costCenter_id.required' => 'Este campoo es obligatorio',
        'ocProduct.costCenter_id.exists' => 'El Centro de Costo seleccionado no es valido',
        'ocProduct.measure_id.required' => 'El campo es obligatorio',
        'ocProduct.measure_id.exists' => 'La Unidad de Medida seleccionada no es valida',
        'ocProduct.currency_id.required' => 'El campo es obligatorio',
        'ocProduct.currency_id.exists' => 'EL Tipo de Moneda seleccionada no es valida',
    ];

    public function updatedCategory($value)
    {
        return $this->subCategories = OcSubCategory::where('ocCategory_id', $value)->get()->toArray();
    }

    public function submit()
    {
        $this->validate();

        DB::transaction( function () {

            $this->ocProduct->FechaCreacion = date('Y-m-d ');
            $this->ocProduct->EventoCreacionID = 129;
            $this->ocProduct->UsuarioCreacionID = auth()->user()->ID;
            $this->ocProduct->save();

            $event = new SaveEvent();
            $event->FechaCreacion = date('Y-m-d H:i:s');
            $event->EventoCreacionID = 129;
            $event->UsuarioCreacionID = 3;
            $event->ReferenciaID = $this->ocProduct->id;
            $event->MenuSecundarioID = 94;
            $event->Comentario = "Edición de Articulo";
            $event->save();

        });

        $this->alertSuccess();
    }

    public function alertSuccess()
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'success',
            'message' => 'Articulo editado'
        ]);
    }
}
