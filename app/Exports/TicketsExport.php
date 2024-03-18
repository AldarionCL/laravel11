<?php

namespace App\Exports;

use App\Models\AccessoryTicket\AccessoryTicket;
use App\Models\CallCenterTicket\CallCenterTicket;
use App\Models\OperationTicket\OperationTicket;
use App\Models\Ticket\Ticket;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class TicketsExport implements FromQuery, WithHeadings, WithMapping
{
    public $tickets;
    private $type;

    public function __construct( $tickets, $type )
    {
        $this->tickets = $tickets;
        $this->type = $type;
    }

    public function headings(): array
    {
        return [
            '#',
            'Asunto',
            'Prioridad',
            'Categoria',
            'SubCategoria',
            'Gerencia',
            'Area de Negocio',
            'Sucursal',
            'Ingresado por',
            'Asignado',
            'Detalle',
            'Estado',
            'Ingresado'
        ];
    }

    public function map($tickets): array
    {
        return [
            $tickets->id,
            $tickets->title,
            $tickets->priority,
            $tickets->categories->name,
            $tickets->subCategories->name,
            $tickets->gerencia->Gerencia,
            $tickets->typeOfBranch->TipoSucursal,
            $tickets->office->Sucursal,
            $tickets->recorder->Nombre,
            $tickets->responsible->Nombre ?? 'Sin responsable',
            $tickets->detail,
            $tickets->state,
            Date::dateTimeToExcel($tickets->created_at),
        ];
    }

    public function query()
    {
        if ($this->type === "ticket" )
        {
            return Ticket::with('subCategories:id,name', 'categories:id,name')->whereIn('id', $this->tickets);
        }elseif ( $this->type === "call")
        {
            return CallCenterTicket::with('subCategories:id,name', 'categories:id,name')->whereIn('id', $this->tickets);
        }elseif ( $this->type === "accessory")
        {
            return AccessoryTicket::with('subCategories:id,name', 'categories:id,name')->whereIn('id', $this->tickets);
        }elseif ( $this->type === "operation"){
            return OperationTicket::with('subCategories:id,name', 'categories:id,name')->whereIn('id', $this->tickets);
        }

    }
}
