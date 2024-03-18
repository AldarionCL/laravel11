<?php

namespace App\Http\Livewire\Oc;

use App\Models\OrderRequest\OcOrderRequest;
use App\Models\OrderRequest\OcProduct;
use App\Models\Roma\BranchOffice;
use App\Models\Roma\TypeOfBranche;
use App\Models\Section;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class OcOrderRequestApprovedTable extends DataTableComponent
{

//    protected $model = OcOrderRequest::class;

    /**
     * @var array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    private mixed $arrayProduct;
    public array $orders = [];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('ID', 'desc');

        $this->setPaginationVisibilityEnabled();

    }

    public function builder(): Builder
    {
        return  OcOrderRequest::query()
            ->whereHas('ocDetailOrderRequest.ocProduct', function ( $query ) {
                $query->where('costCenter_id', auth()->user()->purchaseOrderGenerator->branchOffice_id )->where( 'state', 0)
                    ->where( 'unitPrice', '>', 0);
            } )
            ->where('state', 2 );
    }

    public function columns(): array
    {
        return [
            Column::make("N°", "id")
                ->sortable(),
            Column::make("Solicitante", "recorder.Nombre")
                ->sortable(),
            Column::make("Detalle", "id")
                ->format(
                    fn( $value, $row, Column $column ) => view('oc.datatable.detail')->with( 'id', $value )
                )
                ->sortable(),
        ];
    }

    public array $bulkActions = [
        'exportSelection' => 'Enviar',
    ];

    public function exportSelection(): void
    {
        if ($this->getSelectedCount() > 0 && $this->getSelectedCount() < 2)
        {
            $this->orders = $this->getSelected();
            $this->addOrderRequestToOc();
            redirect('orden-de-compra');
        }
        else
        {
            $this->dispatchBrowserEvent(
                'swal:success', [
                    'type' => 'info',
                    'message' => "Se debe seleccionar solo una Solicitud"
                ]
            );
        }
    }

    public function addOrderRequestToOc(): void
    {

        $ocOrderRequests = OcOrderRequest::with('ocDetailOrderRequest')->whereIn('id', $this->orders)->get();

        if (!session()->has('ocProducts')) {
            session()->put('ocProducts', []);
        }

        $arrayProduct = session('ocProducts');

        $month = date('n');

        foreach ($ocOrderRequests as $ocOrderRequest) {

            foreach ($ocOrderRequest->ocDetailOrderRequest as $ocDetailOrderRequest) {
                $items = OcProduct::with(['accountingBudget' => function ( $query ){
                    $query->where('Year', date('Y'));
                }])->where('id', $ocDetailOrderRequest->ocProduct_id)
                    ->where('costCenter_id', auth()->user()->purchaseOrderGenerator->branchOffice_id )
                    ->get();

                $costCenter = BranchOffice::whereId($ocOrderRequest->branch_id)->select( 'ID', 'Sucursal')->get();
                $zone = TypeOfBranche::whereId($ocOrderRequest->typeOfBranch_id)->select('ID', 'TipoSucursal')->get();
                $section = Section::whereId($ocOrderRequest->section_id)->select('ID', 'Seccion')->get()->toArray();

                foreach ($items as $item) {
                    if ( $ocDetailOrderRequest->unitPrice  > 0 && $ocDetailOrderRequest->state === 0 ){
                        $arrayProduct[] = [
                            'type' => 'request',
                            'id' => $item->id,
                            'idCategory' => $item->ocSubCategory->ocCategory->id,
                            'category' => $item->ocSubCategory->ocCategory->name,
                            'idSubCategory' => $item->ocSubCategory->id,
                            'sku' => $item->sku,
                            'product' => $item->name,
                            'amount' => $ocDetailOrderRequest->amount,
                            'unit' => $ocDetailOrderRequest->unitPrice,
                            'total' => $ocDetailOrderRequest->amount * $ocDetailOrderRequest->unitPrice,
                            'idCenter' => $costCenter[0]['ID'],
                            'center' => $costCenter[0]['Sucursal'],
                            'idZone' => $zone[0]['ID'] ?? '',
                            'zone' => $zone[0]['TipoSucursal'] ?? '',
                            'idSection' => $section[0]['ID'] ?? '',
                            'section' => $section[0]['Seccion'] ?? '',
                            'budget' => $item->accountingBudget->{"M".$month},
                            'balance' => $item->accountingBudget->{"M".$month} - ( $ocDetailOrderRequest->amount * $ocDetailOrderRequest->unitPrice ),
                            'idsOrderRequest' => $this->orders,
                            'description' => $ocDetailOrderRequest->description,
                            'ocDetailOrderRequest_id' => $ocDetailOrderRequest->id
                        ];
                    }
                }
            }

        }

        session()->put('ocProducts', $arrayProduct);
    }
}
