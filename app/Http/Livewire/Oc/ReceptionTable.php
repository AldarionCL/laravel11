<?php

namespace App\Http\Livewire\Oc;

use App\Exports\ReceptionExport;
use App\Http\Utils\Workplace;
use App\Models\PurchaseOrder\Reception;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class ReceptionTable extends DataTableComponent
{
    protected $model = Reception::class;

    public string $filterLayout = 'slide-down';

    public ?int $searchFilterDebounce = 500;

    protected Workplace $workplace;
    public $branches;

    public function __construct($id = null)
    {
        $this->workplace = new Workplace();
        $this->branches = $this->branchOffices(null);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('detail.reception', $row->id );
            })
            ->setDefaultSort('id', 'desc');
    }

    public $columnSearch = [
        'recorder' => null,
        'social' => null,
        'branch' => null,
        'document' => null,
        'rut' => null,
    ];

    /*public function builder(): Builder
    {
        return Reception::query()
            ->when($this->columnSearch['recorder'] ?? null, fn ($query, $recorder) => $query->where("MA_Usuarios.Nombre", "like", "%" . $recorder . "%"))
            ->when($this->columnSearch['social'] ?? null, fn ($query, $social) => $query->where("ALEXIS_providers.name", "like", "%" . $social . "%"))
            ->when($this->columnSearch['branch'] ?? null, fn ($query, $branch) => $query->where("MA_Sucursales.Nombre", "like", "%" . $branch . "%"))
            ->when($this->columnSearch['document'] ?? null, fn ($query, $document) => $query->where("ALEXIS_receptions.document", "like", "%" . $document . "%"))
            ->when($this->columnSearch['rut'] ?? null, fn ($query, $rut) => $query->where("ALEXIS_providers.rut", "like", "%" . $rut . "%"));
    }*/

    public function columns(): array
    {
        return [
            Column::make('Acción', 'id')
                ->format( fn ($value, $row, Column $column) => view('oc.datatable.reception-oc')->with('id', $value)
                )
                ->html(),
            Column::make("N° Recepcion", "id")
                ->searchable()
                ->secondaryHeaderFilter('id')
                ->sortable(),
            Column::make("N° OC", "ocPurchaseOrder.id")
                ->searchable()
                ->secondaryHeaderFilter('purchaseorder')
                ->sortable(),
            Column::make("Solicitante", "ocPurchaseOrder.recorder.Nombre")
                ->searchable()
                ->sortable()
                ->secondaryHeaderFilter('recorder')
                /*->secondaryHeader(function() {
                    return view('purchaseorder.datatable.input-search', ['field' => 'recorder', 'name' => 'Solicitante', 'columnSearch' => $this->columnSearch]);
                })*/,
            Column::make("Gerencia", "ocPurchaseOrder.brand.Gerencia")
                ->searchable()
                ->sortable(),
            Column::make("Sucursal - Taller - Departamento", "ocPurchaseOrder.branchOffice.Sucursal")
                ->searchable()
                ->secondaryHeaderFilter('costo')
                ->sortable(),
            Column::make("Ingresado", "created_at")
                ->searchable()
                ->sortable()
                ->format( function ( $value ) {
                        return Carbon::createFromFormat( "Y-m-d H:i:s", $value)->format( "d-m-Y");
                    } ),
            Column::make("N° Fact.", "document")
                ->searchable()
                ->secondaryHeaderFilter('document')
                ->sortable(),
            Column::make("RUT", "ocPurchaseOrder.seller.rut")
                ->format( function ( $value ) {
                    $dato = str_replace(".", "", $value);
                    return number_format( (float) substr ( $dato, 0 , -1 ) , 0, "", ".") . '-' . substr ( $dato, strlen($dato) -1 , 1 );
                })
                ->secondaryHeaderFilter('rut')
                ->searchable()
                ->sortable(),
            Column::make("Razon Social", "ocPurchaseOrder.seller.name")
                ->searchable()
                ->secondaryHeaderFilter('social')
                ->sortable(),
            Column::make("Comentario", "ocPurchaseOrder.comment")
                ->searchable()
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            TextFilter::make('ID', 'id')
                ->config([
                    'placeholder' => 'Buscar N°',
                    'maxlength' => '25',
                ])
                ->hiddenFromAll()
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('OC_receptions.id', 'like', '%'.$value.'%');
                }),
            TextFilter::make('ID', 'purchaseorder')
                ->config([
                    'placeholder' => 'Buscar N°',
                    'maxlength' => '25',
                ])
                ->hiddenFromAll()
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('OC_receptions.ocOrderRequest_id', 'like', '%'.$value.'%');
                }),
            TextFilter::make('Solicitante', 'recorder')
                ->config([
                    'placeholder' => 'Solicitante',
                    'maxlength' => '25',
                ])
                ->hiddenFromAll()
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('MA_Usuarios.Nombre', 'like', '%'.$value.'%');
                }),
            TextFilter::make('Centro de Costo', 'costo')
                ->config([
                    'placeholder' => 'C. de Costo',
                    'maxlength' => '25',
                ])
                ->hiddenFromAll()
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('MA_Sucursales.Sucursal', 'like', '%'.$value.'%');
                }),
            TextFilter::make('N° de documento', 'document')
                ->config([
                    'placeholder' => 'Buscar N°',
                    'maxlength' => '25',
                ])
                ->hiddenFromAll()
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('OC_receptions.document', 'like', '%'.$value.'%');
                }),
            TextFilter::make('RUT', 'rut')
                ->config([
                    'placeholder' => 'RUT',
                    'maxlength' => '25',
                ])
                ->hiddenFromAll()
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('SP_providers.rut', 'like', '%'.$value.'%');
                }),
            TextFilter::make('RUT', 'social')
                ->config([
                    'placeholder' => 'Razon Social',
                    'maxlength' => '25',
                ])
                ->hiddenFromAll()
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('SP_providers.name', 'like', '%'.$value.'%');
                }),
            SelectFilter::make('Gerencia', 'brands')
                ->options(
                    $this->managements()
                )
                ->filter(function(Builder $builder, string $value) {
                    $this->selectManagements($builder, $value);
                }),
            SelectFilter::make('Sucursal')
                ->options(
                    $this->branches
                )
                ->filter(function(Builder $builder, string $value) {
                    $this->selectBranches($builder, $value);
                }),
            DateFilter::make('Desde')
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('OC_receptions.created_at', '>=', $value.' 00:00:01');
                }),
            DateFilter::make('Hasta')
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('OC_receptions.created_at', '<=', $value.' 23:59:59');
                }),


        ];
    }

    public array $bulkActions = [
        'exportSelection' => 'Exportar',
    ];

    public function exportSelection() {
        if ($this->getSelectedCount() > 0) {
            $receptions = $this->getSelected();
            return Excel::download(new ReceptionExport($receptions), 'recepcion.xlsx');
        }
    }

    public function managements(): array
    {
        $gerencia = $this->workplace->brands();

        $managements = array();
        $managements[0] = "Todos";

        foreach ($gerencia as $management) {
            $managements[$management->ID] = $management->Gerencia;
        }

        return $managements;
    }

    public function branchOffices(): array
    {
        $branches = array();

        $location = User::location()->get();

        $branches[0] = "Todos";

        foreach ($location[0]['sucursales'] as $items)
        {
            $branches[$items->ID] = $items->Sucursal;
        }

        return $branches;

    }

    public function selectManagements( $builder, $value )
    {
        return $value !== '0' ? $builder->where( 'MA_Gerencias.ID', '=',  $value) : $builder->where( 'MA_Gerencias.ID', '>', 0);
    }

    public function selectBranches( $builder, $value )
    {
        return $value !== '0' ? $builder->where( 'MA_Sucursales.ID', '=',  $value) : $builder->where( 'MA_Sucursales.ID', '>', 0);
    }

    public function updatedTableFiltersBrands( $value ): void
    {
        $this->branches = branchOfficesFilter($value);
        $this->filters();
        $this->emit('refreshFilters');
    }
}
