<?php

namespace App\Exports;

use App\Models\Ti\Inventory;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TiInventoryExport implements WithHeadings, WithMapping, FromQuery
{

    public function query()
    {
        return Inventory::query()->with('branchOffice.typeOfBranches');
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'RUT',
            'Cargo',
            'Solicitud,Estado',
            'Sucursal',
            'Unidad de Negocios',
            'Procedencia',
            'Marca/Modelo',
            'N° de Serie',
            'Año del Equipo',
            'N° de Telefono',
            'Imei',
            'Observación'
        ];
    }

    public function map($row): array
    {
        return [
            $row->user->Nombre,
            $row->user->RUT,
            $row->user->position->Cargo,
            $row->status,
            $row->branchOffice->Sucursal,
            $row->branchOffice->typeOfBranches[0]->TipoSucursal,
            $row->origin,
            $row->model,
            $row->serial_number,
            $row->year,
            $row->phone_number,
            $row->imei,
            $row->observation
        ];
    }
}
