<?php

namespace App\Http\Livewire\Oc;

use App\Http\Utils\Workplace;
use App\Mail\ApprovalSpOc;
use App\Mail\NotificationCreateProduct;
use App\Models\OrderRequest\OcDetailOrderRequest;
use App\Models\OrderRequest\OcOrderRequest;
use App\Models\OrderRequest\OcProduct;
use App\Models\PurchaseOrder\Approval;
use App\Models\PurchaseOrder\Approver;
use App\Models\Section;
use App\Models\User;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Manny\Manny;

class FormPurchaseRequest extends Component
{
    use AuthorizesRequests;

    public $business;
    public $brand;
    public $area;
    public $branch;
    public $product;
    public $amount;
    public $description;
    public array $businesses;
    public $brands;
    public $businessAreas;
    public $branches;
    public $products;
    public $arrayProduct;
    public $items;
    public $orderRequest;
    public $solicitudesCreadas = '';

    public $subCategory;
    public $subCategoryChange;
    public $state = false;
    private bool $changeFamilyProduct = false;
    public $section;
    public $sections;

    public function rules()
    {
        return [
            'business' => 'required|exists:MA_PompeyoEmpresas,ID',
            'brand' => 'required|exists:MA_Gerencias,ID',
            'area' => 'required|exists:MA_TipoSucursal,ID',
            'branch' => "required|exists:MA_Sucursales,ID,GerenciaID,{$this->brand}",
            'section' => 'required|exists:MA_Seccion,ID'
        ];
    }

    public $messages = [
        'business.required' => 'Este campo es requerido',
        'business.exists' => 'La Empresa seleccionada no es valida',
        'brand.required' => 'Este campo es requerido',
        'brand.exists' => 'La Marca - Gerenciaseleccionada no es valida',
        'area.required' => 'Este campo es requerido',
        'area.exists' => 'El Area de Negocio seleccionada no es valida',
        'branch.required' => 'Este campo es requerido',
        'branch.exists' => 'La Sucursal - Taller - Departamento seleccionada no es valida',
        'section.required' => 'Este campo es requerido',
        'section.exists' => 'La Sección no es valida',
    ];

    public function render(): Renderable
    {
        $this->authorize('view', new OcOrderRequest );

        $this->businesses = $this->workplace->business()->toArray();

        $products =  OcProduct::with('ocSubCategory')->where('active', 1)->orderBy('name', 'ASC')->get()->toArray();

        if (!empty($products)){
            foreach ($products as $product){
                $this->products[] = [ "id" => $product["id"], "name" => $product["name"]." - ".$product["oc_sub_category"]["name"]];
            }
        }else{
//            $this->products = array();
        }

        return view('livewire.oc.form-purchase-request', [
            'businesses' => array_values($this->businesses)
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function mount()
    {
        $this->authorize('view', new OcOrderRequest );

        $this->brands = array();
        $this->businessAreas = array();
        $this->branches = array();
        $this->sections = array();

        if ( session()->has( 'products' ))
        {
            $this->arrayProduct = session('products' );
        }
            $products =  OcProduct::with('ocSubCategory')->where('active', 1)->orderBy('name', 'ASC')->get()->toArray();

        if (!empty($products)){
            foreach ($products as $product){
                $this->products[] = [ "id" => $product["id"], "name" => $product["name"]." - ".$product["oc_sub_category"]["name"]];
            }
        }else{
            $this->products = array();
        }
    }

    public function getWorkplaceProperty(): Workplace
    {
        return new Workplace();
    }

    public function updatedBusiness( $value ): array
    {
        return $this->brands = $this->workplace->brands( $value, [ 1, 2, 3 ] )->toArray();
    }

    public function updatedBrand( $value ): array
    {
        return $this->businessAreas = $this->workplace->businessAreas( $value )->toArray();
    }

    public function updatedArea( $value )
    {
        $this->sections = Section::select('ID', 'Seccion')->where('TipoSucursalID', $value )->get()->toArray();
        return $this->branches = $this->workplace->branches( $this->brand, $value )->toArray();
    }

    public function updatedBranch($value)
    {

        if (Approver::where('branchOffice_id', $value)->exists() && auth()->user()->buyer()->where('branchOffice_id', $value)->exists()){
            $this->state = true;
            // $this->alertSuccess('sucess', 'aca');

        }else{
            $this->state = false;
            $this->alertSuccess('warning', 'Ud no esta asignado como comprador o No existen aprobadores para este Centro de Costo');
        }
            /*$approvers = Approver::select('level', 'user_id', 'min', 'max')
                ->where('branchOffice_id', $this->branch )
                ->get();*/

            /*if ( $approvers->isEmpty() ){
                $this->alertSuccess('warning', 'No existen aprobadores para este Centro de Costo');
                return false;
            }
    }
    /*if ( auth()->user()->buyer()->where('branchOffice_id', $value)->exists() ){
        $this->alertSuccess( 'success', 'aca estamos !!!');
    }else{
        $this->alertSuccess( 'success', 'no estamos !!!');
    }*/
    }

    public function updatedProduct( $value ): void
    {
        $this->products = array();

        $this->changeFamilyProduct = true;

        if ($value) {
            $subCategory = OcProduct::select('ocSubCategory_id')->where('id', $value)->get()->toArray();

            $this->subCategory = $subCategory[0]['ocSubCategory_id'];

            $products = OcProduct::with('ocSubCategory')->where('ocSubCategory_id', $subCategory[0]['ocSubCategory_id'])->orderBy('name', 'ASC')->get()->toArray();
            foreach ($products as $product) {
                $this->products[] = ["id" => $product["id"], "name" => $product["name"] . " - " . $product["oc_sub_category"]["name"]];
            }
        }
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    /**
     * @throws AuthorizationException
     */
    public function submit(): void
    {
        $this->authorize('create', new OcOrderRequest );

        $this->validate();

        if (!empty( $this->arrayProduct ) && $this->state ){

            DB::transaction( function () {

                $this->orderRequest = OcOrderRequest::create(
                    [
                        'business_id' => $this->business,
                        'brand_id' => $this->brand,
                        'branch_id' => $this->branch,
                        'typeOfBranch_id' => $this->area,
                        'buyers_id' => auth()->user()->ID,
                        'section_id' => $this->section,
                        'state' => 1,
                    ]
                );

                foreach ($this->arrayProduct as $producto){
                    OcDetailOrderRequest::create([
                        'ocCategory_id' => $producto['idCategory'],
                        'ocSubCategory_id' => $producto['idSubCategory'],
                        'ocProduct_id' => $producto['id'],
                        'amount' => $producto['amount'],
                        'ocOrderRequest_id' => $this->orderRequest->id,
                        'description' => $producto['description'] ?? " ",
                    ]);
                }

                $approvers = Approver::select('level', 'user_id', 'min', 'max')
                    ->where('branchOffice_id', $this->branch )
                    ->get();

                /*if ( $approvers->isEmpty() ){
                    $this->alertSuccess('warning', 'No existen aprobadores para este Centro de Costo');
                    return false;
                }

                dd($approvers);*/

                foreach ( $approvers as $approver ) {

                    Approval::create([
                        'level' => $approver->level,
                        'ocOrderRequest_id' => $this->orderRequest->id,
                        'approver_id' => $approver->user_id,
                        'state' => 0,
                        'type' => 1,
                    ]);

                }

                $changeState = Approval::where( 'ocOrderRequest_id', $this->orderRequest->id )->where('type', 1)->first();
                $changeState->state = 1;
                $changeState->save();

                saveNotification(
                    auth()->user()->ID,
                    rand( 1, 20 ),
                    request()->ip(),
                    $this->orderRequest->id,
                    $changeState->approver_id,
                    "Nueva SolPed a revisar para aprobación",
                    rand( 1, 20 ),
                    rand( 1, 20 ),
                );

                $approver = User::where('ID', $approvers->first()->user_id )->get()->toArray();

                try {
                    Mail::mailer('solicitudes')->to( $approver[0]['Email'] )->send( new ApprovalSpOc( $approver[0]['Nombre'],"https://apibackend.pompeyo.cl/detalle-solicitud-de-pedidos/",  $this->orderRequest->id , "Solicitud de Compra", "Le fue asignada para ser gestionada", $this->orderRequest->ocDetailOrderRequest->load('ocProduct') ) );
                }catch (Exception $exception){
                    Log::error( "Se produjo un error al enviar correo OC: $exception");
                }

            });

            $this->remove();

            $this->alertSuccess( 'success', 'Solicitud '. $this->orderRequest->id.' Fue enviada a aprobación!!!');

        }else{
            $this->state ? $this->alertSuccess( 'warning', 'La Solicitud esta vacía, no se puede generar!!!') : $this->alertSuccess('warning', 'Ud no esta asignado como comprador o No existen aprobadores para este Centro de Costo');
        }
    }



    public function submitMultiple(): void
    {
        $this->authorize('create', new OcOrderRequest );

        $this->validate();

        if (!empty( $this->arrayProduct ) && $this->state ){

            DB::transaction( function () {



                foreach ($this->arrayProduct as $producto){

                    $this->orderRequest = OcOrderRequest::create(
                        [
                            'business_id' => $this->business,
                            'brand_id' => $this->brand,
                            'branch_id' => $this->branch,
                            'typeOfBranch_id' => $this->area,
                            'buyers_id' => auth()->user()->ID,
                            'section_id' => $this->section,
                            'state' => 1,
                        ]
                    );

                    $this->solicitudesCreadas .= $this->orderRequest->id . ', ';

                    OcDetailOrderRequest::create([
                        'ocCategory_id' => $producto['idCategory'],
                        'ocSubCategory_id' => $producto['idSubCategory'],
                        'ocProduct_id' => $producto['id'],
                        'amount' => $producto['amount'],
                        'ocOrderRequest_id' => $this->orderRequest->id,
                        'description' => $producto['description'] ?? " ",
                    ]);

                    $approvers = Approver::select('level', 'user_id', 'min', 'max')
                        ->where('branchOffice_id', $this->branch )
                        ->get();

                    /*if ( $approvers->isEmpty() ){
                        $this->alertSuccess('warning', 'No existen aprobadores para este Centro de Costo');
                        return false;
                    }

                    dd($approvers);*/

                    foreach ( $approvers as $approver ) {

                        Approval::create([
                            'level' => $approver->level,
                            'ocOrderRequest_id' => $this->orderRequest->id,
                            'approver_id' => $approver->user_id,
                            'state' => 0,
                            'type' => 1,
                        ]);

                    }

                    $changeState = Approval::where( 'ocOrderRequest_id', $this->orderRequest->id )->where('type', 1)->first();
                    $changeState->state = 1;
                    $changeState->save();

                    saveNotification(
                        auth()->user()->ID,
                        rand( 1, 20 ),
                        request()->ip(),
                        $this->orderRequest->id,
                        $changeState->approver_id,
                        "Nueva SolPed a revisar para aprobación",
                        rand( 1, 20 ),
                        rand( 1, 20 ),
                    );

                    $approver = User::where('ID', $approvers->first()->user_id )->get()->toArray();

                    try {
                        Mail::mailer('solicitudes')->to( $approver[0]['Email'] )->send( new ApprovalSpOc( $approver[0]['Nombre'],"https://apibackend.pompeyo.cl/detalle-solicitud-de-pedidos/",  $this->orderRequest->id , "Solicitud de Compra", "Le fue asignada para ser gestionada", $this->orderRequest->ocDetailOrderRequest->load('ocProduct') ) );
                    }catch (Exception $exception){
                        Log::error( "Se produjo un error al enviar correo OC: $exception");
                    }


                }





            });

            $this->remove();

            $this->alertSuccess( 'success', 'Solicitudes '. $this->solicitudesCreadas.' Fue enviada a aprobación!!!');

        }else{
            $this->state ? $this->alertSuccess( 'warning', 'La Solicitud esta vacía, no se puede generar!!!') : $this->alertSuccess('warning', 'Ud no esta asignado como comprador o No existen aprobadores para este Centro de Costo');
        }
    }

    public function alertSuccess( $type, $message)
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => $type,
            'message' => $message
        ]);
    }

    public function add()
    {
        $this->validate(
            [
                'product' => "required|exists:SP_oc_products,id,ocSubCategory_id,{$this->subCategory}",
                'amount' => 'required|integer',
                'description' => 'nullable|string|max:500',
            ],
            [
                'product.required' => 'Este campo es requerido',
//                'product.exists' => 'El Material seleccionado no es valida',
                'amount.required' => 'Este campo es requerido',
                'amount.integer' => 'Debe ser un numero entero',
                'description.string' => 'El campo Descripción, debe contener texto',
                'description.max' => 'El campo Descripción, debe contener maximo 500 caracteres',
            ]
        );

        if ( !session()->has( 'products' ))
        {
            session()->put( 'products', [] );
        }

        $this->arrayProduct = session('products' );

        $this->items = OcProduct::where('id', $this->product)->get();

        foreach ($this->items as $item)
        {
            $this->arrayProduct[] = ['id' => $item->id, 'idCategory' => $item->ocSubCategory->ocCategory->id, 'category' => $item->ocSubCategory->ocCategory->name, 'subCategory' => $item->ocSubCategory->name, 'idSubCategory' => $item->ocSubCategory->id, 'sku' => $item->sku, 'product' => $item->name, 'amount' => $this->amount, 'description' => $this->description];
        }

        session()->put( 'products', $this->arrayProduct);

        $this->amount = '';
        $this->subCategory = '';
        $this->description = '';
        $this->product = '';
    }

    public function trash( $index )
    {
        unset($this->arrayProduct[$index]);
        session()->put( 'products', $this->arrayProduct );
    }

    public function plus( $index )
    {
        $this->arrayProduct[$index]['amount'] += 1;
        session()->put( 'products', $this->arrayProduct );
    }

    public function minus( $index )
    {
        if ($this->arrayProduct[$index]['amount'] > 1) {
            $this->arrayProduct[$index]['amount'] -= 1;
            session()->put('products', $this->arrayProduct);
        }else{
            $this->trash( $index );
        }
    }

    public function modify( $index, $value )
    {
        $this->arrayProduct[$index]['description'] = $value;
        session()->put( 'products', $this->arrayProduct );
    }

    public function remove(){
        foreach ($this->arrayProduct as $key => $value){
            unset($this->arrayProduct[$key]);
        }
        session()->put('products', $this->arrayProduct);
    }

    public function createProduct()
    {
        try {
            Mail::mailer('solicitudes')->to( "juan.ordenes@pompeyo.cl" )->send( new NotificationCreateProduct( "Juan Ordenes", auth()->user()->Nombre ));
        }catch (Exception $exception){
            Log::error( "Se produjo un error al enviar correo Productos: $exception");
        }

        $this->alertSuccess( 'success', 'La Solicitud de creación de producto fue enviada!!!');
    }
}
