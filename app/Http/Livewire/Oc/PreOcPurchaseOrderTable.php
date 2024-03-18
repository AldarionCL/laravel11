<?php

namespace App\Http\Livewire\Oc;

use App\Models\OrderRequest\OcProduct;
use App\Models\PurchaseOrder\PreOcPurchaseOrder;
use App\Models\Roma\BranchOffice;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PreOcPurchaseOrderTable extends DataTableComponent
{
    public $hidenSelectAll = true;
    private array $preOrder;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return PreOcPurchaseOrder::query()
            ->where('branch_id', auth()->user()->purchaseOrderGenerator->branchOffice_id)
            ->where('state', '=', 1);
    }

    public function columns(): array
    {
        return [
            Column::make("N°", "id")
                ->sortable(),
            Column::make("Centro de Costo", "branch.Sucursal")
                ->sortable(),
            Column::make("Proveedor", "provider.name")
                ->sortable(),
            Column::make("Ingresado", "created_at")
                ->sortable()
                ->format(
                    fn($value) => Carbon::createFromFormat("Y-m-d H:i:s", $value)->format("d-m-Y")
                )
        ];
    }

    public array $bulkActions = [
        'sentSelection' => 'Enviar'
    ];

    public function sentSelection(): void
    {
        if ($this->getSelectedCount() > 0 && $this->getSelectedCount() < 2) {
            $this->preOrder = $this->getSelected();
            $this->addOrderRequestToOc();
            redirect('orden-de-compra');
        }
        else
        {
            $this->dispatchBrowserEvent(
                'swal:success', [
                    'type' => 'info',
                    'message' => "Se debe seleccionar solo una Pre OC"
                ]
            );
        }
    }

    private function addOrderRequestToOc(): void
    {
        $preOcPurchaseOrder = PreOcPurchaseOrder::with('ocPreDetailPurchaseOrder')->where('id', $this->preOrder)->get();

        if (!session()->has('ocProducts')) {
            session()->put('ocProducts', []);
        }

        $arrayProduct = session('ocProducts');

        $month = date('n');

        foreach ($preOcPurchaseOrder as $ocPurchaseOrder) {

            foreach ($ocPurchaseOrder->ocPreDetailPurchaseOrder as $preDetailPurchaseOrder) {
                $items = OcProduct::with(['accountingBudget' => function ( $query ){
                    $query->where('Year', date('Y'));
                }])->where('id', $preDetailPurchaseOrder->ocProduct_id)
                    ->where('costCenter_id', auth()->user()->purchaseOrderGenerator->branchOffice_id )
                    ->get();

                $costCenter = BranchOffice::whereId($ocPurchaseOrder->branch_id)->select( 'ID', 'Sucursal')->get();

                foreach ($items as $item) {
                        $arrayProduct[] = [
                            'type' => 'provider',
                            'id' => $item->id,
                            'idCategory' => $item->ocSubCategory->ocCategory->id,
                            'category' => $item->ocSubCategory->ocCategory->name,
                            'idSubCategory' => $item->ocSubCategory->id,
                            'sku' => $item->sku,
                            'product' => $item->name,
                            'amount' => $preDetailPurchaseOrder->quantity,
                            'unit' => $preDetailPurchaseOrder->unitPrice,
                            'total' => $preDetailPurchaseOrder->quantity * $preDetailPurchaseOrder->unitPrice,
                            'idCenter' => $costCenter[0]['ID'],
                            'center' => $costCenter[0]['Sucursal'],
                            'budget' => $item->accountingBudget->{"M".$month},
                            'balance' => $item->accountingBudget->{"M".$month} - ( $preDetailPurchaseOrder->quantity * $preDetailPurchaseOrder->unitPrice ),
                            'idsOrderRequest' => $this->preOrder,
                            'description' => $preDetailPurchaseOrder->description,
                            'ocDetailOrderRequest_id' => $preDetailPurchaseOrder->id,
                            'business_id' => $ocPurchaseOrder->business_id,
                            'brand_id' => $ocPurchaseOrder->brand_id,
                            'branch_id' => $ocPurchaseOrder->branch_id,
                            'idZone' => $ocPurchaseOrder->typeOfBranch_id,
                            'provider_id' => $ocPurchaseOrder->provider_id,
                            'condition' => $ocPurchaseOrder->condition,
                            'direction' => $ocPurchaseOrder->direction,
                            'commune' => $ocPurchaseOrder->commune,
                            'contact_id' => $ocPurchaseOrder->contact_id,
                        ];
                }
            }

        }

        session()->put('ocProducts', $arrayProduct);
    }
}
