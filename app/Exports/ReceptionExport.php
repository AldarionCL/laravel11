<?php

namespace App\Exports;

use App\Models\PurchaseOrder\Reception;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ReceptionExport implements FromQuery, WithHeadings, WithMapping
{
    public $receptions;

    public function __construct($receptions)
    {
        $this->receptions = $receptions;
    }

    public function headings(): array
    {
        return [
            'N° Recepcion',
            'N° OC',
            'Solictante',
            'Sucursal',
            'Ingresado',
            'N° Factura',
            'RUT',
            'Razon Social'
        ];
    }

    public function map($receptions): array
    {
        return [
            $receptions->id,
            $receptions->ocPurchaseOrder->id,
            $receptions->ocPurchaseOrder->recorder->Nombre,
            $receptions->ocPurchaseOrder->branchOffice->Sucursal,
            Date::dateTimeToExcel($receptions->created_at),
            $receptions->document,
            $receptions->ocPurchaseOrder->seller->rut,
            $receptions->ocPurchaseOrder->seller->name,

        ];
    }

    public function query()
    {
        return Reception::with('ocPurchaseOrder' )->whereIn('id', $this->receptions );
    }
}
