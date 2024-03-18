<?php

namespace App\Http\Livewire\Reception\Datatables;

use App\Exports\VisitasExport;
use App\Models\reception\Visitas;
use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use JetBrains\PhpStorm\NoReturn;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Provider;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class ReporteVisitasDatatable extends DataTableComponent
{

    protected $model = Visitas::class;
    public $params;
    public array $gerencias;
    public array $sucursales;

    public $searchGerencia;
    public $searchSucursal;
    public $inputFechaInicio;
    public $inputFechaFin;


    public $listeners = ['updateDatatable'];
    public function configure(): void
    {
        //dd($this->searchGerencia);

        $this->setPrimaryKey('MA_Visitas.ID')
            ->setDefaultSort('MA_Visitas.FechaCreacion', 'desc')
            ->setColumnSelectDisabled()
            ->setColumnSelectHiddenOnTablet();
        $this->setQueryStringEnabled();
        $this->setTableAttributes([
            'id' => 'list_dyp',
            'class' => 'text-xs table-responsive',
        ]);
        $this->setTbodyAttributes([
            'default' => true,
            'class' => 'text-xs',
        ]);
    }

    public function mount($searchGerencia, $searchSucursal, $inputFechaInicio, $inputFechaFin): void
    {
        $this->searchGerencia = $searchGerencia;
        $this->searchSucursal = $searchSucursal;
        $this->inputFechaInicio = $inputFechaInicio;
        $this->inputFechaFin = $inputFechaFin;

        if($this->inputFechaInicio == null) {
            $this->inputFechaInicio = date('Y-m-d');
        }

    }

    public function updateDatatable($searchGerencia,$searchSucursal,$inputFechaInicio,$inputFechaFin): void
    {
        $this->searchGerencia = $searchGerencia;
        $this->searchSucursal = $searchSucursal;
        $this->inputFechaInicio = $inputFechaInicio;
        $this->inputFechaFin = $inputFechaFin;

        $this->emit("refreshLivewireDatatable");
    }


    public function builder(): Builder
    {
        $datos = Visitas::with("Sucursales");

        if(isset($this->searchGerencia) && count($this->searchGerencia) > 0)
        {
            $datos = $datos->whereIn('GerenciaID',$this->searchGerencia);
        }

        if(isset($this->searchSucursal) && count($this->searchSucursal) > 0) {
            $datos = $datos->whereIn('SucursalID', $this->searchSucursal);
        }
        if(isset($this->inputFechaInicio) && $this->inputFechaInicio != null) {
            $datos = $datos->where('MA_Visitas.FechaCreacion', '>=', date('Y-m-d 00:00:01', strtotime($this->inputFechaInicio)));
        }
        if(isset($this->inputFechaFin) && $this->inputFechaFin != null) {
            $datos = $datos->where('MA_Visitas.FechaCreacion', '<=', date('Y-m-d 23:59:59', strtotime($this->inputFechaFin)));
        }
        return $datos;
    }

    public function columns(): array
    {

        return [
            Column::make("Fecha Visita", "FechaCreacion")
                ->sortable()
                ->format( fn ( $value ) =>
                Carbon::createFromFormat( "Y-m-d H:i:s", $value)->format( "Y-m-d H:i")
                ),
            Column::make("Fecha Salida", "Fecha_salida")
                ->sortable()
                ->format( fn ( $value ) =>
                ($value) ? Carbon::createFromFormat( "Y-m-d H:i:s", $value)->format( "Y-m-d H:i") : ''
                ),
            Column::make("Rut", "Rut")
                ->sortable()->searchable(),
            Column::make('Estado','Fecha_salida')
                ->format(function ($value, $column, $row) {
                    return view('livewire.reception.datatables.table-actions-reporte', compact('row','column','value'));
                })->sortable()->searchable(),
            Column::make('Nombre','Nombres')
                ->format(function ($value, $column, $row) {
                    return $column->Nombres. " ".$column->Apellidos; //. " | ".json_encode($this->searchGerencia).json_encode($this->searchSucursal).json_encode($this->inputFechaInicio.json_encode($this->inputFechaFin));
                })->sortable()->searchable(),
            Column::make("Nombres", "Nombres")
                ->sortable()->searchable()->hideIf(1==1),
            Column::make('Apellidos','Apellidos')
                ->searchable()->sortable()->hideIf(1==1),
            Column::make("Sucursal", "Sucursales.Sucursal")
                ->sortable()
                ->searchable(),
            Column::make('Tipo Ingreso','TipoCliente')
                ->searchable()->sortable(),
            Column::make('Retiro Factura','retiroPatente')
                ->searchable()->sortable(),
            Column::make('Minutos visita','MinutosVisita')
                ->format(function ($value, $column, $row) {
                    $ini = new DateTime($column->FechaCreacion);
                    $fin = new DateTime(date('Y-m-d H:i:s'));
                    $diff = $ini->diff($fin);
                    $min =  ($diff->d * 1440) + ($diff->h * 60) + ( $diff->i );
                    if($value != null) {
                        return $value;
                    }
                    else {
                        return $min;
                    }
                })->sortable()->searchable(),
        ];
    }


    public function filters(): array
    {
        return [
            /*SelectFilter::make('Sucursal')
                ->options(
                    Sucursales::query()
                        ->orderBy('Sucursal')
                        ->get()
                        ->keyBy('ID')
                        ->map(fn($tag) => $tag->Sucursal)
                        ->toArray()
                ),
            SelectFilter::make('En sucursal')
                ->options([
                    '' => 'All',
                    'yes' => 'Si',
                    'no' => 'No',
                ]),
            TextFilter::make('Rut', 'Rut')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar RUT',
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('MA_Visitas.Rut', 'like', '%'.$value.'%');
                }),
            TextFilter::make('Email', 'Email')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Email',
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('MA_Visitas.Email', 'like', '%'.$value.'%');
                }),*/
        ];
    }

    public function bulkActions(): array
    {
        return [
            'export' => 'Export',
        ];
    }

    public function export()
    {
        $visitas = $this->getSelected();

        $this->clearSelected();

        return Excel::download(new VisitasExport($visitas), 'visitas.xlsx');
    }
}
