<?php

namespace App\Http\Livewire\Cpd\Datatables;

use App\Exports\cpd\exportListaCPD;
use App\Models\Cpd\CpdFlujos;
use App\Models\Cpd\CpdPasos;
use App\Models\Cpd\CpdTipos;
use App\Models\Gerencias;
use App\Models\Sucursales;
use Illuminate\Support\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VisitasExport;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;



class ListaDatatable extends DataTableComponent
{

    public $searchGerencia;
    public $searchSucursal;
    public $searchMarca;
    public $searchModelo;
    public $inputFechaInicio;
    public $inputFechaFin;

    public $listeners = ['updateDatatable'];

    public function configure(): void
    {
        $this->setPrimaryKey('CPD_Flujos.ID')
            ->setDefaultSort('CPD_Flujos.created_at', 'desc')
            ->setColumnSelectDisabled()
            ->setColumnSelectHiddenOnTablet();
        $this->setQueryStringEnabled();
        $this->setTableAttributes([
            'id' => 'list_cpd',
            'class' => 'text-xs table-responsive',
        ]);
        $this->setTbodyAttributes([
            'default' => true,
            'class' => 'text-xs',
        ]);
        $this->setTrAttributes(function($row, $index) {
            if ($index % 2 === 0) {
                return [
                    'class' => 'bg-gray-200 text-xs'
                ];
            }
            return ['class' => 'text-xs'];
        });
        $this->setFilterPillsEnabled();
        $this->setFilterLayout('slide-down');
    }


    public function updateDatatable($searchMarca,$searchModelo,$inputFechaInicio,$inputFechaFin): void
    {
        $this->searchMarca = $searchMarca;
        $this->searchModelo = $searchModelo;
        $this->inputFechaInicio = $inputFechaInicio;
        $this->inputFechaFin = $inputFechaFin;

        $this->emit("refreshLivewireDatatable");
    }

    public function builder(): Builder
    {
        $datos = CpdFlujos::with('Sucursal');

        if(isset($this->searchSucursal) && ($this->searchSucursal) !='') {
            $datos = $datos->where('SucursalID', $this->searchSucursal);
        }
        if(isset($this->searchMarca) && ($this->searchMarca) !='') {
            $datos = $datos->where('Marca', $this->searchMarca);
        }
        if(isset($this->searchModelo) && ($this->searchModelo) !='') {
            $datos = $datos->where('Marca', $this->searchModelo);
        }
        if(isset($this->inputFechaInicio) && $this->inputFechaInicio != null) {
            $datos = $datos->where('created_at', '>=', date('Y-m-d 00:00:01', strtotime($this->inputFechaInicio)));
        }
        if(isset($this->inputFechaFin) && $this->inputFechaFin != null) {
            $datos = $datos->where('created_at', '<=', date('Y-m-d 23:59:59', strtotime($this->inputFechaFin)));
        }
        return $datos;
    }

    public function columns(): array
    {

        return [
            Column::make('Acción','ID')
                ->format(function($value, $column, $row) {
                    return view('livewire.cpd.datatables.lista-datatable', compact('row','value'));
                }),
            Column::make('Etapa','PasoActual')
                ->format(function($value) {
                    $nombrePaso = CpdTipos::find($value);
                    if($nombrePaso) {
                        return $nombrePaso->NombreTarea;
                    }
                    else {
                        return $value;
                    }
                })->searchable()->sortable(),
            Column::make('Origen','Origen')
                ->searchable()->sortable(),
            Column::make("Marca", "Marca")
                ->sortable()->searchable(),
            Column::make("Modelo", "Modelo")
                ->sortable()->searchable(),
            Column::make("Patente", "Patente")
                ->sortable()->searchable(),
            Column::make('ID Venta','VentaID')
                ->searchable()->sortable(),
            Column::make('Posición Patio','Cono')
                ->searchable()->sortable()
        ];
    }

       public function filters(): array
    {
        return [
            /*MultiSelectDropdownFilter::make('Gerencia')
                ->options(
                    Gerencias::query()
                        ->orderBy('Gerencia')
                        ->get()
                        ->keyBy('ID')
                        ->map(fn($tag) => $tag->Gerencia)
                        ->toArray()
                ),
            MultiSelectDropdownFilter::make('Sucursal')
                ->options(
                    Sucursales::query()
                        ->orderBy('Sucursal')
                        ->get()
                        ->keyBy('ID')
                        ->map(fn($tag) => $tag->Sucursal)
                        ->toArray()
                ),*/

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

        return Excel::download(new exportListaCPD($this->searchMarca,$this->searchModelo,$this->inputFechaInicio,$this->inputFechaFin), 'listaCPD.xlsx');
    }
}
