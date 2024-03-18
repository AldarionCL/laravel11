<?php

namespace App\Http\Livewire\Oc;

use App\Models\OrderRequest\Currency;
use App\Models\OrderRequest\Measure;
use App\Models\OrderRequest\OcCategory;
use App\Models\OrderRequest\OcProduct;
use App\Models\OrderRequest\OcSubCategory;
use App\Models\PurchaseOrder\Account;
use App\Models\Roma\BranchOffice;
use App\Models\Roma\SaveEvent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FormRegisterProductOc extends Component
{
    use AuthorizesRequests;

    public $category;
    public $branchOffice;
    public $measures;
    public $currencies;
    public $accounts;
    public OcProduct $product;
    public $categories;
    public $subCategories;

    public function render()
    {
        $this->authorize('view', new OcProduct);

        $this->categories = OcCategory::select( 'id', 'name' )->orderBy('name', 'ASC')->get()->toArray();
        $this->branchOffice = BranchOffice::where('VisibleOC', 1)->select('ID', 'Sucursal')->orderBy('Sucursal', 'ASC')->get()->toArray();
        $this->currencies = Currency::all();
        $this->measures = Measure::all();
        $this->accounts = Account::select('ID', 'name')->orderBy('name', 'ASC')->get()->toArray();

        return view('livewire.oc.form-register-product-oc', [
            'categories' => $this->categories,
            'branchOffice' => $this->branchOffice,
            'currencies' => $this->currencies,
            'measures' => $this->measures,
            'accounts' => $this->accounts
        ]);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function rules()
    {
        return [
            'category' => 'required|exists:SP_oc_categories,id',
            'product.ocSubCategory_id' => "required|exists:SP_oc_sub_categories,id,ocCategory_id,{$this->category}",
            'product.name' => "required|unique:SP_oc_products,name,{$this->product->name},id,ocSubCategory_id,{$this->product->ocSubCategory_id}",
            'product.costCenter_id' => "required|exists:MA_Sucursales,ID",
            'product.measure_id' => "required|exists:SP_measures,id",
            'product.currency_id' => "required|exists:SP_currencies,id",
            'product.AccountID' => "required|exists:OC_gl_Account,ID",
        ];
    }

    protected $messages = [
        'category.required' => 'Este campo es obligatorio',
        'category.exists' => 'La Categoria seleccionada no es valida',
        'product.ocSubCategory_id.required' => 'Este campo es obligatorio',
        'product.ocSubCategory_id.exists' => 'La Sub Categoria seleccionada no es valida',
        'product.name.required' => 'Este campo es obligatorio',
        'product.name.unique' => 'El Producto ya existe en esta Sub Categoria, favor de validar',
        'product.costCenter_id.required' => 'Este campoo es obligatorio',
        'product.costCenter_id.exists' => 'El Centro de Costo seleccionado no es valido',
        'product.measure_id.required' => 'El campo es obligatorio',
        'product.measure_id.exists' => 'La Unidad de Medida seleccionada no es valida',
        'product.currency_id.required' => 'El campo es obligatorio',
        'product.currency_id.exists' => 'El Tipo de Moneda seleccionada no es valida',
        'product.AccountID.required' => "El campo es obligatorio",
        'product.AccountID.exists' => "La Cuenta seleccionada no es valida",
    ];

    public function mount()
    {
        $this->product = new OcProduct();
        $this->subCategories = array();
    }

    public function updatedCategory($value): array
    {
        return $this->subCategories = OcSubCategory::where('ocCategory_id', $value)->get()->toArray();
    }

    public function submit()
    {
        $this->validate();

        DB::transaction( function () {

            $this->product->FechaCreacion = date('Y-m-d ');
            $this->product->EventoCreacionID = 129;
            $this->product->UsuarioCreacionID = auth()->user()->ID;
            $this->product->save();

            $event = new SaveEvent();
            $event->FechaCreacion = date('Y-m-d H:i:s');
            $event->EventoCreacionID = 129;
            $event->UsuarioCreacionID = 3;
            $event->ReferenciaID = $this->product->id;
            $event->MenuSecundarioID = 94;
            $event->Comentario = "Creación de Articulo";
            $event->save();

        });

        $this->category = null;
        $this->product = new OcProduct();

        $this->alertSuccess();
    }

    public function alertSuccess()
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'success',
            'message' => 'Articulo OC guardado'
        ]);
    }
}
