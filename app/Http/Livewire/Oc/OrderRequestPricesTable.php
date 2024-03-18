<?php

namespace App\Http\Livewire\Oc;

use App\Models\OrderRequest\OcOrderRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class OrderRequestPricesTable extends DataTableComponent
{
    // protected $model = OcOrderRequest::class;
    public string $filterLayout = 'slide-down';
    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'desc');

        $this->setPaginationEnabled();
    }

    public function builder(): Builder
    {
        return OcOrderRequest::whereHas('ocDetailOrderRequest', function(Builder $query ) {
            $query->whereHas( 'ocProduct', function ( Builder $builder ){
                $builder->where('costCenter_id', auth()->user()->quoteGenerator->branchOffice_id );
            } );
        })
            ->where('state', 2 );

        /*$results =
            DB::select(
                DB::raw("select oc.id,mu.Nombre,oc.created_at,
            case when OC_TotalAsignar(oq.user_id,oc.id,0)=OC_TotalAsignar(oq.user_id,oc.id,1) then 'Pendiente'
            when OC_TotalAsignar(oq.user_id,oc.id,0)>0 and OC_TotalAsignar(oq.user_id,oc.id,1)>0  then 'Parcial'
            when OC_TotalAsignar(oq.user_id,oc.id,0)=0  then 'Realizadas' End Estado
            from oc_order_requests oc
            join MA_Usuarios mu on oc.buyers_id=mu.id
            join oc_detail_order_requests od on oc.id=od.ocOrderRequest_id
            join oc_products op on od.ocProduct_id=op.id
            join oc_quotegenerator oq on op.costCenter_id=oq.branchOffice_id
            where oq.user_id=461 group by oc.id")
            );*/
    }

    public function columns(): array
    {
        return [
                Column::make('Acción', 'id')
                    ->format( fn ($value, $row, Column $column) => view('oc.datatable.route-request-order')->with('id', $value)
                    )
                    ->html(),
            Column::make("Solicitud", "id")
                ->secondaryHeaderFilter('id')
                ->sortable(),
            Column::make("Solicitante", "recorder.Nombre")
                ->secondaryHeaderFilter('recorder')
                ->sortable(),
            Column::make("Ingreso", "created_at")
                ->sortable()
                ->format( fn ( $value ) =>
                Carbon::createFromFormat( "Y-m-d H:i:s", $value)->format( "d-m-Y")
                ),
            Column::make("Estado Asignación", 'state')
                ->sortable()
                ->format(
                    function ( $value, $row, Column $column ) {
                        $data = $row->ocDetailOrderRequest->load(['ocProduct' => fn($query) => $query->where('costCenter_id', auth()->user()->quoteGenerator->branchOffice_id) ]);
                        return $data->where('ocProduct', '!=', null)->count()  === $data->where('ocProduct', '!=', null)->where('unitPrice', '>', 0)->count() ? "Realizada" : ( $data->where('ocProduct', '!=', null)->where('unitPrice', '>', 0)->count() === 0 ? "Pendiente" : "Parcial" );
                    }
                ),
            Column::make('Asignación', 'state')
                ->view('oc.datatable.search' )
        ];
    }

    public function filters(): array
    {
        return [
            DateFilter::make('Desde')
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('SP_oc_order_requests.created_at', '>=', $value.' 00:00:01');
                }),
            DateFilter::make('Hasta')
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('SP_oc_order_requests.created_at', '<=', $value.' 23:59:59');
                }),
            TextFilter::make('Solicitante', 'recorder')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Solicitante',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'MA_Usuarios.Nombre', 'like', "%$value%");
                }),
            TextFilter::make('ID', 'id')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Solicitud',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'SP_oc_order_requests.id', 'like', "%$value%");
                })
        ];
    }
}
