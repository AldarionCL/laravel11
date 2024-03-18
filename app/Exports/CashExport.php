<?php

namespace App\Exports;

use App\Models\Cash\CashDetail;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CashExport implements WithCustomStartCell, WithHeadings, WithMapping, FromQuery
{
    protected int $cash;

    public function __construct( $cash )
    {
        $this->cash = $cash;
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function headings(): array
    {
        return [
            'N° Documento',
            'Fecha',
            'Tipo de documento',
            'Proveedor',
            'Descripción',
            'Cuenta contable',
            'N° cuenta contable',
            'Total',
        ];
    }

    public function map($row): array
    {
        return [
            $row->number_document,
            $row->date,
            $row->document->name,
            $row->provider,
            $row->description,
            $row->cashAccount->name,
            $row->cashAccount->number_account,
            $row->total,
        ];
    }

    public function query()
    {
        return CashDetail::query()->where('cash_id', $this->cash)->where('state', 1);
    }
}
