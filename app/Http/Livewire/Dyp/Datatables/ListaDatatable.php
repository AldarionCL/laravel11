<?php

namespace App\Http\Livewire\Dyp\Datatables;

use App\Models\dyp\DypFlujos;
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
    public $inputFechaInicio;
    public $inputFechaFin;

    public $listeners = ['updateDatatable'];

    public function configure(): void
    {
        $this->setPrimaryKey('DYP_Flujos.ID')
            ->setDefaultSort('DYP_Flujos.created_at', 'desc')
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
        $datos = DypFlujos::with('Sucursal');

        if(isset($this->searchSucursal) && ($this->searchSucursal) !='') {
            $datos = $datos->where('SucursalID', $this->searchSucursal);
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
                    return view('livewire.dyp.datatables.lista-datatable', compact('row','value'));
                }),
            Column::make('Estado','EstadoDyp')
                ->searchable()->sortable(),
            Column::make('Cliente','ClienteID')
                ->format(function ($value, $column, $row) {
                    return $column->ClienteNombre. " ".$column->ClienteApellido;
                })->sortable()->searchable(),
            Column::make("Marca", "Marca")
                ->sortable()->searchable(),
            Column::make("Modelo", "Modelo")
                ->sortable()->searchable(),
            Column::make("Compañía Seguro", "CompaniaSeguro")
                ->sortable()->searchable(),
            Column::make("Magnitud", "Magnitud")
                ->sortable()->searchable(),
            Column::make("Patente", "Patente")
                ->sortable()->searchable(),
            Column::make('OT','Ot_principal')
                ->searchable()->sortable(),
            Column::make('N° Siniestro','NumeroSiniestro')
                ->searchable()->sortable(),
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

    public function export()
    {
        $visitas = $this->getSelected();

        return Excel::download(new VisitasExport($visitas), 'flujosDyp.xlsx');
    }
}
