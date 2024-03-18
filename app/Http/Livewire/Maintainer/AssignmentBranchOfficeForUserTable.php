<?php

namespace App\Http\Livewire\Maintainer;

use App\Models\Roma\UserBranch;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Roma\BranchOffice;

class AssignmentBranchOfficeForUserTable extends DataTableComponent
{
    public $user_id;

    public function mount( $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('ID');
    }

    public function builder(): Builder
    {
        return BranchOffice::select('MA_Sucursales.Sucursal as Sucursal', 'MA_Sucursales.ID as ID', DB::raw('IF( SIS_UsuariosSucursales.UsuarioID = '.$this->user_id.' , 1, 0) as Active'))
            ->leftJoin('SIS_UsuariosSucursales', function ($join) {
                $join->on('MA_Sucursales.ID', '=', 'SIS_UsuariosSucursales.SucursalID')
                    ->where('SIS_UsuariosSucursales.UsuarioID', '=', $this->user_id);
            })
            ->where('Activa', 1)
            ->orderBy('Sucursal', 'ASC');
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "ID")
                ->searchable()
                ->sortable(),
            Column::make("Sucursal", "Sucursal")
                ->searchable()
                ->sortable(),
            Column::make("Asignado", "Active")
                ->label( fn ($row) => $row->Active === 1 ? 'Asignada' : '' )
                ->searchable()
                ->sortable(),
        ];
    }

    public function bulkActions(): array
    {
        return  [
            'assignment' => 'Asignar',
            'assignment' => 'Asignar',
        ];
    }

    public function assignment(): void
    {
        foreach($this->getSelected() as $item)
        {
            UserBranch::updateOrCreate(
                [
                    'SucursalID' => $item,
                    'UsuarioID' => $this->user_id
                ],
                [
                    'FechaCreacion' => date('Y-m-d H:i:s'),
                    'EventoCreacionID' => 1,
                    'UsuarioCreacionID' => auth()->user()->ID,
                    'SucursalID' => $item,
                    'UsuarioID' => $this->user_id,
                    'DisponibleLead' => 0,
                    'CargoID' => 11
                ]
            );
        }

        $this->alertSuccess( 'success','Sucursales asignadas');
    }

public function alertSuccess( $type, $message ): void
{
    $this->dispatchBrowserEvent('swal:success', [
        'type' => $type,
        'message' => $message
    ]);
}
}
