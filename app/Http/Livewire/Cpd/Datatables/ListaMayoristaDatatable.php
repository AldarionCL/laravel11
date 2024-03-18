<?php

namespace App\Http\Livewire\Cpd\Datatables;

use App\Exports\cpd\exportMayorista;
use App\Models\Cpd\CpdDatosTarea;
use App\Models\Cpd\CpdFlujos;
use App\Models\Cpd\CpdPasos;
use App\Models\Cpd\CpdTareas;
use App\Models\Cpd\CpdTipos;
use App\Models\Gerencias;
use App\Models\Sucursales;
use Illuminate\Support\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VisitasExport;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;



class ListaMayoristaDatatable extends DataTableComponent
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
        $this->setPrimaryKey('ID')
            ->setDefaultSort('ID', 'desc')
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
        $datos = CpdFlujos::where('EstadoCpd', 'Mayorista');

        if(isset($this->searchSucursal) && ($this->searchSucursal) !='') {
            $datos = $datos->where('SucursalID', $this->searchSucursal);
        }

        if(isset($this->searchMarca) && ($this->searchMarca) !='') {
            $datos = $datos->where('Marca', $this->searchMarca);
        }

        if(isset($this->searchModelo) && ($this->searchModelo) !='') {
            $datos = $datos->where('Modelo', $this->searchModelo);
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
                    return view('livewire.cpd.datatables.lista-datatable', compact('row','value','column'));
                }),
            Column::make('Estado','EstadoCpd'),
            Column::make('Marca','Marca'),
            Column::make('Modelo','Modelo'),
            Column::make('Patente','Patente'),

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
        return Excel::download(new exportMayorista($this->searchMarca,$this->searchModelo,$this->inputFechaInicio,$this->inputFechaFin), 'reporteMayorista.xlsx');
    }

}
