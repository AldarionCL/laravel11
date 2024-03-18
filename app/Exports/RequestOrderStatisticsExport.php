<?php

namespace App\Exports;

use App\Models\OrderRequest\OcDetailOrderRequest;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RequestOrderStatisticsExport implements FromQuery, WithHeadings, WithMapping
{

    private $orders;

    public function __construct( $orders )
    {
        $this->orders = $orders;
    }

    public function query()
    {
        return OcDetailOrderRequest::with('ocOrderRequest', 'ocProduct.ocSubCategory.ocCategory' )->whereIn( 'ocOrderRequest_id', $this->orders );
    }

    public function map( $orderRequest ): array
    {
//        dd($orderRequest);
        return [
            $orderRequest->ocOrderRequest->id,
            $orderRequest->ocOrderRequest->state === 1 ? 'Pendiente de Aprobación' : ( $orderRequest->ocOrderRequest->state === 2 ? 'Aprobado' : ( $orderRequest->ocOrderRequest->state === 3 ? 'Rechazado' : ($orderRequest->ocOrderRequest->state === 4 ? 'En asignación de precio' : 'En orden de compra'))),
            $orderRequest->created_at->format('d-m-Y'),
            $orderRequest->ocOrderRequest->recorder->Nombre,
            $orderRequest->ocOrderRequest->recorder->Email,
            $orderRequest->ocOrderRequest->branchOffice->Sucursal,
            $orderRequest->ocOrderRequest->brand->Gerencia,
            $orderRequest->ocOrderRequest->branchOffice->Sucursal,
            $orderRequest->ocProduct->sku,
            $orderRequest->ocProduct->name,
            $orderRequest->ocProduct->ocSubCategory->ocCategory->name,
            $orderRequest->description,
            $orderRequest->amount,
            $this->oc( $orderRequest->ocOrderRequest->orderRequest ),
            $this->approver($orderRequest)
        ];
    }

    public function headings(): array
    {
        return [
            'Numero Solicitud',
            'Estado',
            'Fecha Creacion',
            'Solicitante',
            'Email',
            'Departamento Solicitante',
            'Gerencia',
            'Sucursal',
            'ID Articulo',
            'Articulo',
            'Categoria',
            'Descripcion',
            'Cantidad',
            'OC',
            'Aprobador'
        ];
    }

    protected function oc( $data )
    {
        foreach ( $data as $item ){
            return sizeof($data) > 1 ? $item->order_id."," : $item->order_id;
        }
        return "";
    }

    protected function approver(mixed $orderRequest)
    {
         $data = $orderRequest->ocOrderRequest->currentApprover->load('user:ID,Nombre');
         return $data[0]->user->Nombre ?? '';
    }
}
