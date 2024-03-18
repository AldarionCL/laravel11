<?php

namespace App\Http\Livewire\Oc;

use App\Http\Utils\Workplace;
use App\Mail\ApprovalSpOc;
use App\Mail\NotificationCreateProduct;
use App\Models\OrderRequest\FileOrderRequest;
use App\Models\OrderRequest\OcDetailOrderRequest;
use App\Models\OrderRequest\OcOrderRequest;
use App\Models\OrderRequest\OcProduct;
use App\Models\OrderRequest\OrderRequest;
use App\Models\OrderRequest\Provider;
use App\Models\PurchaseOrder\Approval;
use App\Models\PurchaseOrder\Approver;
use App\Models\PurchaseOrder\ConditionPayment;
use App\Models\PurchaseOrder\FilePurchaseOrder;
use App\Models\PurchaseOrder\OcDetailPurchaseOrder;
use App\Models\PurchaseOrder\OcPurchaseOrder;
use App\Models\PurchaseOrder\OcPurchaseOrderGenerator;
use App\Models\PurchaseOrder\PreOcPurchaseOrder;
use App\Models\PurchaseOrder\SpecialApprovals;
use App\Models\PurchaseOrder\Taxe;
use App\Models\Roma\BranchOffice;
use App\Models\Roma\Commune;
use App\Models\Roma\TypeOfBranche;
use App\Models\Section;
use App\Models\User;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormPurchaseOrder extends Component
{
    use AuthorizesRequests, WithFileUploads;

    public $amount;
    public $area;
    public $arrayProduct;
    public $arraySolPed;
    public $branches;
    public $brands;
    public $business;
    public $businessAreas;
    public $carPatent;
    public $center;
    public $comment;
    public $commune;
    public $condition;
    public $conditions;
    public $contact;
    public $contacts;
    public $description;
    public $files = [];
    public $ids = [];
    public $items;
    public $management;
    public $ocDetailOrderRequestId;
    public $office;
    public $pila = "blanco";
    public $product;
    public $products;
    public $provider;
    public $purchaseOrder;
    public $taxe;
    public $total;
    public $unit;
    public $section;
    public $zone;
    public array $communes;
    public $centers;
    public $centersPre;
    public $sections;
    public array $idCenterDetail = [];
    public bool $pre = false;
    public mixed $address;
    public $filesSP;

    protected $listeners = ['sendOrderRequest' => 'addOrderRequest', 'changeSelect'];
    public $businessAreasPre;

    public function render(): Renderable
    {
        $this->authorize('create', new OcPurchaseOrderGenerator );

        $providers = Provider::select(['id', 'name'])->orderBy('name', 'ASC')->get()->toArray();

        return view('livewire.oc.form-purchase-order', [
            'taxes' => Taxe::select('id', 'name')->get()->toArray(),
            'businesses' => array_values($this->workplace->business()->toArray()),
            'providers' => $providers,
            'zones' => TypeOfBranche::select('ID', 'TipoSucursal')->orderBy('TipoSucursal', 'ASC')->get()->toArray(),
        ]);
    }

    public function mount(): void
    {
        $this->authorize('create', new OcPurchaseOrderGenerator );

        $this->brands = array();
        $this->businessAreas = array();
        $this->branches = array();
        $this->products = array();
        $this->centers = array();
        $this->sections = array();
        $this->contacts = User::select('ID', 'Nombre' )->orderBy( 'Nombre', 'ASC' )->get()->toArray();

        $this->communes =  Commune::select('ID', 'Comuna' )->orderBy('Comuna', 'ASC' )->get()->toArray();

        $this->conditions = ConditionPayment::select( 'id', 'name' )->get()->toArray();

        $this->centersPre = BranchOffice::select('ID', 'Sucursal' )->where('Activa', 1)->where('VisibleOC', 1)->get()->toArray();
        $this->businessAreasPre = TypeOfBranche::select('ID', 'TipoSucursal')->get()->toArray();
        $this->sectionsPre = Section::select('ID', 'Seccion')->get()->toArray();

        $this->contact = Auth::user()->ID;

        if (session()->has('ocProducts')) {
            $this->arrayProduct = session('ocProducts');
            foreach ($this->arrayProduct as $item){

                $this->pre = isset($item['type']) && $item['type'] === 'provider' ?? false;

                $this->total += $item['total'];
                $this->business = $item['business_id'] ?? '';

                isset( $item['brand_id'] ) ? $this->brands = $this->workplace->brands( $item['business_id'] )->toArray() : '';
                $this->management = $item['brand_id'] ?? '';

                isset( $item['branch_id'] ) ? $this->businessAreas = $this->workplace->businessAreas( $item['brand_id'] )->toArray() : '';
                $this->office = $item['branch_id'] ?? '';

                isset( $item['typeOfBranch_id'] ) ? $this->branches = $this->workplace->branches( $item['brand_id'], $item['typeOfBranch_id'] )->toArray() : '';
                $this->area = $item['typeOfBranch_id'] ?? '';

                $this->provider = $item['provider_id'] ?? '';
                $this->condition = $item['condition'] ?? '';
                $this->address = $item['direction'] ??'';
                $this->commune = $item['commune'] ?? '';
                $this->contact = $item['contact_id'] ?? '';

                $first = Arr::first($this->arrayProduct, function ($value, $key) {
                    return $value;
                });

                $ids = !empty( $first['idsOrderRequest'] ) ? $first['idsOrderRequest'] : [];

                $this->filesSP = FileOrderRequest::select('url')->whereIn('ocOrderRequest_id', $ids)->get()->toArray();
            }
        }
    }

    public function updatedBusiness( $value ): array
    {
        return $this->brands = $this->workplace->brands( $value )->toArray();
    }

    public function updatedManagement($value): array
    {
        return $this->businessAreas = $this->workplace->businessAreas($value)->toArray();
    }

    public function updatedArea($value): array
    {
        return $this->branches = $this->workplace->branches($this->management, $value)->toArray();
    }

    public function updatedOffice( $value ): void
    {
        $branch = BranchOffice::with('commune:ID,Comuna')->select('ID as id', 'ComunaID', 'Direccion' )->where('Activa', 1)->where('VisibleOC', 1)->where( 'id', $value )->get();

        foreach ( $branch as $item){
            $this->address = $item->Direccion;
            $this->commune = $item->commune->ID;
        }

        $products =  OcProduct::with('ocSubCategory')->where('costCenter_id', $value)->where('active', 1)->orderBy('name', 'ASC')->get()->toArray();

        foreach ($products as $product){
            $this->products[] = [ "id" => $product["id"], "name" => $product["name"]." - ".$product["oc_sub_category"]["name"]];
        }
    }

    public function updatedZone( $value ): void
    {
        $this->centers = BranchOffice::select('ID', 'Sucursal' )->where( 'TipoSucursalID', $value )->where('Activa', 1)->where('VisibleOC', 1)->get()->toArray();
        $this->sections = Section::select('ID', 'Seccion')->where('TipoSucursalID', $value )->get()->toArray();
    }

    public function getWorkplaceProperty(): Workplace
    {
        return new Workplace();
    }

    /**
     * @throws AuthorizationException
     */
    public function submit()
    {
        $this->authorize('create', new OcPurchaseOrderGenerator );

        $this->validate(
            [
                'business' => 'required|exists:MA_PompeyoEmpresas,ID',
                'management' => 'required|exists:MA_Gerencias,ID',
                'area' => 'required|exists:MA_TipoSucursal,ID',
                'office' => "required|exists:MA_Sucursales,id,GerenciaID,$this->management",
                'provider' => "required|exists:SP_providers,id",
                'condition' => "required|exists:OC_payments,id",
                'commune' => "required|exists:MA_Comunas,ID",
                'address' => "required",
                'contact' => "required",
                'files.*' => [ 'mimes:jpg,png,pdf', 'max:5000' ],
            ],
            [
                'business.required' => 'Este campo es requerido',
                'business.exists' => 'La Empresa seleccionada no es valida',
                'management.required' => 'Este campo es requerido',
                'management.exists' => 'La Marca - Gerenciaseleccionada no es valida',
                'area.required' => 'Este campo es requerido',
                'area.exists' => 'El Area de Negocio seleccionada no es valida',
                'office.required' => 'Este campo es requerido',
                'office.exists' => 'La Sucursal - Taller - Departamento seleccionada no es valida',
                'provider.required' => "Este campo es requerido",
                'provider.in' => "El Proveedor seleccionado no es valido",
                'condition.required' => "Este campo es requerido",
                'condition.exists' => "La Condición de Pago seleccionada no es valida",
                'commune.required' => "El campo Comuna es obligatorio",
                'commune.exists' => "La comuna seleccionada no es valida",
                'address.required' => "La Dirección es obligatorio",
                'contact.required' => "EL campo es obligatorio",
                'files.*.mimes' => 'Debe ser un documento tipo jpg,png,pdf',
                'files.*.max' => 'El docuemento debe tener un maximo de 5M',
            ]
        );

        if (!empty($this->arrayProduct)) {

            $first = Arr::first($this->arrayProduct, function ($value, $key) {
                return $value;
            });

            $this->ids = !empty( $first['idsOrderRequest'] ) ? $first['idsOrderRequest'] : [];

            DB::transaction(function () use ($first) {

                $this->purchaseOrder = OcPurchaseOrder::create(
                    [
                        'business_id' => $this->business,
                        'brand_id' => $this->management,
                        'branch_id' => $this->office,
                        'typeOfBranch_id' => $this->area,
                        'buyers_id' => auth()->user()->ID,
                        'state' => 1,
                        'provider' => $this->provider,
                        'condition' => $this->condition,
                        'ocOrderRequest_ids' => json_encode( $this->ids ),
                        'direction' => $this->address,
                        'commune' => $this->commune,
                        'contact_id' => $this->contact,
                        'comment' => $this->comment,
                        'pre_oc' => $this->pre ? 1 : 0
                    ]
                );

                if ( !empty( $this->ids )){
                    foreach ( $this->ids as $id ){
                        OrderRequest::create( [
                           'order_id' => $this->purchaseOrder->id,
                            'request_id' => $id
                        ]);
                    }
                }

                $totalPurchaseRequest = 0;

                foreach ($this->arrayProduct as $producto) {

                    $taxRate = Taxe::select('id', 'rate')->where('id', $producto['taxe'] ?? 1 )->get()->toArray();
                    $idSection = Section::select('ID')->where('TipoSucursalID', $producto['idZone'])->get()->toArray();

                    OcDetailPurchaseOrder::create([
                        'ocCategory_id' => $producto['idCategory'],
                        'ocSubCategory_id' => $producto['idSubCategory'],
                        'ocProduct_id' => $producto['id'],
                        'amount' => $producto['amount'],
                        'unitPrice' => $producto['unit'],
                        'totalPrice' => $producto['total'],
                        'taxAmount' => $taxRate[0]['rate'] > 0 ? $producto['total'] * ( $taxRate[0]['rate'] / 100 ) : 0,
                        'taxe' => $taxRate[0]['id'],
                        'branch_id' => $producto['idCenter'],
                        'ocPurchaseOrder_id' => $this->purchaseOrder->id,
                        'description' => $producto['description'] ?? " ",
                        'typeOfBranch_id' => $producto['idZone'],
                        'section_id' => $producto['idSection'] ?? $idSection[0]['ID'],
                    ]);


                    if ( isset( $producto['ocDetailOrderRequest_id'] ) ){

                        $this->ocDetailOrderRequestId = $producto['ocDetailOrderRequest_id'] ;

                        OcDetailOrderRequest::where( 'id', $producto['ocDetailOrderRequest_id'] )
                            ->where( 'ocProduct_id', $producto['id'] )
                            ->update( [
                                'state' => 1
                            ] );
                    }

                    if ($this->pre)
                    {
                        PreOcPurchaseOrder::where('id', $this->ids[0])
                            ->update([
                                'state' => 2,
                                'oc_id' => $this->purchaseOrder->id
                            ]);
                    }

                    $totalPurchaseRequest += $producto['total'];
                }

//                $approvers = '';
//
//                if  ( isset($first['type']) && $first['type'] === 'request' /*&& $maximumAmount[0] >= $this->total*/)
//                {
//                    $approvers = SpecialApprovals::select('level', 'user_id')
//                        ->where('branchOfficeApprover_id', $this->purchaseOrder->branch_id )
//                        ->where('branchOfficeBuyer_id', $first['idCenter'] )
//                        ->get();
//                }
//                else
//                {
                    $approvers = Approver::select('level', 'user_id')
                        ->where('branchOffice_id', $this->purchaseOrder->branch_id )
                        ->where('min', '<', $totalPurchaseRequest)
                        ->orderBy('level', 'ASC')
                        ->get();
//                }

                foreach ( $approvers as $approver ) {

                    Approval::create([
                        'level' => $approver->level,
                        'ocOrderRequest_id' => $this->purchaseOrder->id,
                        'approver_id' => $approver->user_id,
                        'state' => 0,
                        'type' => 2,
                    ]);

                }

                $changeState = Approval::where( 'ocOrderRequest_id', $this->purchaseOrder->id )->where('type', 2)->first();
                $changeState->state = 1;
                $changeState->save();

                saveNotification(
                    auth()->user()->ID,
                    rand( 1, 20 ),
                    request()->ip(),
                    $this->purchaseOrder->id,
                    $changeState->approver_id,
                    "Nueva OC a revisar para aprobación",
                    rand( 1, 20 ),
                    rand( 1, 20 ),
                );

                if ($this->files){
                    foreach ($this->files as $item) {
                        $file = new FilePurchaseOrder();
                        $path = $item->store('public/purchaseorder');
                        $file->url = $path;
                        $file->ocPurchaseOrder_id = $this->purchaseOrder->id;
                        $file->save();
                    }
                }

                $approver = User::where('ID', $approvers->first()->user_id )->get()->toArray();

                try {
//                    Mail::mailer('solicitudes')->to( $approver[0]['Email'] )->send( new ApprovalSpOc( $approver[0]['Nombre'],"https://apibackend.pompeyo.cl/detalle-solicitud-de-pedidos/",  $this->purchaseOrder->id , "Orden de Compra", "Le fue asignada para ser gestionada", $this->purchaseOrder->ocDetailPurchaseOrder ) );
                    Log::info('Correo enviado a: '.$approver[0]['Email']);
                }catch (Exception $exception){
                    Log::error( "Se produjo un error al enviar correo OC: $exception");
                }

            });

            $this->remove();



            $this->changeStateOrderRequest( $this->ids );

            $this->alertSuccess('success', 'Fue enviada a aprobación!!!');



        } else {

            $this->alertSuccess('warning', 'Orden de compra esta vacía, no se puede generar!!!');
        }

        $this->business = '';
        $this->management = '';
        $this->area = '';
        $this->office = '';
        $this->provider = '';
        $this->condition = '';
        $this->total = 0;
        $this->contact = '';
        $this->commune = '';
        $this->address = '';
        $this->carPatent = '';
    }

    public function alertSuccess($type, $message): void
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => $type,
            'message' => $message
        ]);
    }

    public function add(): void
    {
        $this->validate(
            [
                'product' => "required|exists:SP_oc_products,id",
                'amount' => 'required|integer',
                'unit' => 'required|integer',
                'zone' => 'required|exists:MA_TipoSucursal,ID',
                'section' => 'required|exists:MA_Seccion,ID',
                'center' => 'required|exists:MA_Sucursales,ID',
                'description' => 'nullable|string|max:500',
                'taxe' => 'required|exists:OC_taxes,id'
            ],
            [
                'product.required' => 'Este campo es requerido',
                'product.exists' => 'El Material seleccionado no es valido',
                'amount.required' => 'Este campo es requerido',
                'amount.integer' => 'Debe ser un numero entero',
                'unit.required' => 'Este campo es requerido',
                'unit.integer' => 'Debe ser un numero entero',
                'zone.required' => 'Este campo es requerido',
                'zone.exists' => 'Area de Negocios, no valido',
                'section.required' => 'Este campo es requerido',
                'section.exists' => 'Sección, no valido',
                'center.required' => 'Este campo es requerido',
                'center.exists' => 'Centro de Costo, no valido',
                'description.string' => 'El campo Descripción, debe contener texto',
                'description.max' => 'El campo Descripción, debe contener maximo 500 caracteres',
                'taxe.required' => 'Este campo es requerido',
                'taxe.exists' => 'El Impuesto seleccionado no es valido',
            ]
        );

        if (!session()->has('ocProducts')) {
            session()->put('ocProducts', []);
        }

        $this->arrayProduct = session('ocProducts');

        $this->items = OcProduct::with(['accountingBudget' => function ( $query ){
            $query->where('Year', date('Y'));
        }])->where('id', $this->product)->get();

        $costCenter = BranchOffice::whereId($this->center)->select('Sucursal')->get();
        $zone = TypeOfBranche::whereId($this->zone)->select('TipoSucursal')->get();
        $section = Section::whereId($this->section)->select('Seccion')->get()->toArray();

        $month = date('n');

        foreach ($this->items as $item) {
            $this->arrayProduct[] = ['id' => $item->id, 'idCategory' => $item->ocSubCategory->ocCategory->id, 'category' => $item->ocSubCategory->ocCategory->name, 'idSubCategory' => $item->ocSubCategory->id, 'sku' => $item->sku, 'product' => $item->name, 'amount' => $this->amount, 'unit' => $this->unit, 'total' => $this->amount * $this->unit, 'idCenter' => $this->center, 'center' => $costCenter[0]['Sucursal'], 'idZone' => $this->zone, 'zone' => $zone[0]['TipoSucursal'], 'idSection' => $this->section, 'section' => $section[0]['Seccion'] ,'budget' => $item->accountingBudget->{"M".$month}, 'balance' => $item->accountingBudget->{"S".$month} + ( $this->amount * $this->unit ), 'description' => $this->description, 'taxe' => $this->taxe ];
            $this->total += $this->amount * $this->unit;
        }

        session()->put('ocProducts', $this->arrayProduct);

        $this->amount = '';
        $this->unit = '';
        $this->center = '';
        $this->description = '';
        $this->product = '';
        $this->taxe = '';
    }

    public function trash($index): void
    {
        unset($this->arrayProduct[$index]);

        $this->setTotal();

        session()->put('ocProducts', $this->arrayProduct);
    }

    public function plus( $index ): void
    {
        $this->arrayProduct[$index]['amount'] += 1;
        $this->arrayProduct[$index]['total'] = $this->arrayProduct[$index]['amount'] * $this->arrayProduct[$index]['unit'];

        $this->setTotal();

        session()->put( 'ocProducts', $this->arrayProduct );
    }

    public function minus( $index ): void
    {
        if ($this->arrayProduct[$index]['amount'] > 1) {
            $this->arrayProduct[$index]['amount'] -= 1;

            $this->arrayProduct[$index]['total'] = $this->arrayProduct[$index]['amount'] * $this->arrayProduct[$index]['unit'];

            session()->put('ocProducts', $this->arrayProduct);
        }else{
            $this->trash( $index );
        }

        $this->setTotal();
    }

    public function modify( $index, $value, $name ): void
    {
        switch ($name){
            case "unitDetail":
                $this->arrayProduct[$index]['unit'] = $value;

                $this->arrayProduct[$index]['total'] = $this->arrayProduct[$index]['amount'] * $this->arrayProduct[$index]['unit'];

                $this->setTotal();
                break;

            case "amountDetail":
                $this->arrayProduct[$index]['amount'] = $value;

                $this->arrayProduct[$index]['total'] = $this->arrayProduct[$index]['amount'] * $this->arrayProduct[$index]['unit'];

                $this->setTotal();
                break;

            case "descriptionDetail":
                $this->arrayProduct[$index]['description'] = $value;
                break;

            case "idCenterDetail":
                $this->arrayProduct[$index]['idCenter'] = $value;
                break;
            case "idTypeBranchDetail":
                $this->arrayProduct[$index]['idZone'] = $value;
                break;
            case "idSectionDetail":
                $this->arrayProduct[$index]['idSection'] = $value;
                break;
        }

        session()->put( 'ocProducts', $this->arrayProduct );
    }

    public function remove(): void
    {
        foreach ($this->arrayProduct as $key => $value) {
            unset($this->arrayProduct[$key]);
        }
        session()->put('ocProducts', $this->arrayProduct);
    }

    public function changeSelect($value): void
    {
        $index = explode('.', $value[0]);
        $this->modify( $index[1], $value[1], $value[2] );
    }

    public function addOrderRequest($order): void
    {
        $this->ids = $order;

        $ocOrderRequests = OcOrderRequest::with('ocDetailOrderRequest')->whereIn('id', $order)->get();

        if (!session()->has('ocProducts')) {
            session()->put('ocProducts', []);
        }

        $this->arrayProduct = session('ocProducts');

        $month = date('n');

        foreach ($ocOrderRequests as $ocOrderRequest) {

            foreach ($ocOrderRequest->ocDetailOrderRequest as $ocDetailOrderRequest) {
                $this->items = OcProduct::with(['accountingBudget' => function ( $query ){
                    $query->where('Year', date('Y'));
                }])->where('id', $ocDetailOrderRequest->ocProduct_id)->get();

                $costCenter = BranchOffice::whereId($ocOrderRequest->branch_id)->select( 'ID', 'Sucursal')->get();

                foreach ($this->items as $item) {
                    $this->arrayProduct[] = ['taxe' => 1, 'id' => $item->id, 'idCategory' => $item->ocSubCategory->ocCategory->id, 'category' => $item->ocSubCategory->ocCategory->name, 'idSubCategory' => $item->ocSubCategory->id, 'sku' => $item->sku, 'product' => $item->name, 'amount' => $ocDetailOrderRequest->amount, 'unit' => $ocDetailOrderRequest->unitPrice, 'total' => $ocDetailOrderRequest->amount * $ocDetailOrderRequest->unitPrice, 'idCenter' => $costCenter[0]['ID'], 'center' => $costCenter[0]['Sucursal'], 'budget' => $item->accountingBudget->{"M".$month}, 'balance' => $item->accountingBudget->{"M".$month} - ( $ocDetailOrderRequest->amount * $ocDetailOrderRequest->unitPrice ), 'description' => $ocDetailOrderRequest->description ];
                }
            }

        }

        session()->put('ocProducts', $this->arrayProduct);
    }

    public function changeStateOrderRequest(array $orders): void
    {
        if ( OcDetailOrderRequest::whereIn( 'ocOrderRequest_id', $orders )->where( 'state', 0 )->count() <= 0 )
        {
            OcOrderRequest::whereIn('id', $orders)
                ->update([
                    'state' => 5
                ]);
        }
    }

    public function createProduct(): void
    {
        try {
            Mail::mailer('solicitudes')->to( "juan.ordenes@pompeyo.cl" )->send( new NotificationCreateProduct( "Juan Ordenes", auth()->user()->Nombre ));
        }catch (Exception $exception){
            Log::error( "Se produjo un error al enviar correo Articulos: $exception");
        }

        $this->alertSuccess( 'success', 'La Solicitud de creación de producto fue enviada!!!');
    }

    private function setTotal(): void
    {
        $this->total = 0;

        foreach ($this->arrayProduct as $item) {
            $this->total += $item['unit'] * $item['amount'] ;
        }
    }
}
