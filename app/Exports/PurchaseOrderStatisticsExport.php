<?php

namespace App\Exports;

use App\Models\PurchaseOrder\OcDetailPurchaseOrder;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PurchaseOrderStatisticsExport implements FromQuery, WithHeadings, WithMapping
{
    private $orders;

    public function __construct($orders )
    {
        $this->orders = $orders;
    }

    public function query()
    {
        return OcDetailPurchaseOrder::with('ocPurchaseOrder.receptions', 'ocProduct.ocSubCategory.ocCategory' )->whereIn( 'OC_detail_purchase_orders.id' , $this->orders )
            ->leftJoin('MA_Sucursales as Branch', 'OC_detail_purchase_orders.branch_id', '=', 'Branch.ID')
            ->leftJoin('MA_Gerencias as Brand', 'Branch.GerenciaID', '=', 'Brand.ID')
            ->select('OC_detail_purchase_orders.*', 'Branch.Sucursal as centerCost', 'Brand.Gerencia as brandCostCenter');
    }

    public function map( $orderRequest ): array
    {
//        Log::info("ID : {$orderRequest}");
        return [
            $orderRequest->ocPurchaseOrder->id,
            $orderRequest->ocPurchaseOrder->business->Empresa,
            $orderRequest->ocPurchaseOrder->state === 1 ? 'Pendiente de Aprobación' : ( $orderRequest->ocPurchaseOrder->state === 2 ? 'Aprobado' : ( $orderRequest->ocPurchaseOrder->state === 3 ? 'Rechazado' : ($orderRequest->ocPurchaseOrder->state === 4 ? 'En asignación de precio' : 'En orden de compra'))) ,
            $orderRequest->created_at->format('d-m-Y'),
            $orderRequest->ocPurchaseOrder->recorder->Nombre,
            $orderRequest->ocPurchaseOrder->recorder->Email,
            $orderRequest->ocPurchaseOrder->branchOffice->Sucursal,
            $orderRequest->ocPurchaseOrder->brand->Gerencia,
            $orderRequest->ocPurchaseOrder->branchOffice->Sucursal,
            $orderRequest->brandCostCenter,
            $orderRequest->centerCost,
            $orderRequest->ocProduct->sku,
            $orderRequest->ocProduct->name,
            $orderRequest->ocProduct->ocSubCategory->ocCategory->name,
            $orderRequest->ocProduct->ocSubCategory->name,
            $orderRequest->description,
            $orderRequest->amount,
            $orderRequest->unitPrice,
            $orderRequest->totalPrice,
            "IVA",
            round( $orderRequest->totalPrice * 0.19 ),
            round( $orderRequest->totalPrice + ( $orderRequest->totalPrice * 0.19 ) ),
            $orderRequest->ocPurchaseOrder->seller->name,
            $orderRequest->ocPurchaseOrder->seller->rut,
            $orderRequest->ocPurchaseOrder->receptions->document ?? '',
            $orderRequest->ocPurchaseOrder->receptions ? $orderRequest->ocPurchaseOrder->receptions->created_at : '' ,
            $this->dataReceived( $orderRequest->detailReception ),
            $orderRequest->ocProduct->account->Account,
            $this->approver($orderRequest),
        ];
    }

    public function headings(): array
    {
        return [
            'Numero Oc',
            'Empresa',
            'Estado',
            'Fecha Creacion',
            'Solicitante',
            'Email',
            'Departamento Solicitante',
            'Gerencia',
            'Sucursal',
            'Gerencia C. Costo',
            'C. Costo',
            'ID Articulo',
            'Articulo',
            'Categoria',
            'Sub Categoria',
            'Descripcion',
            'Cantidad',
            'Unitario',
            'Total Neto',
            'Impuesto',
            'Impuesto',
            'Total',
            'Proveedor',
            'RUT Proveedor',
            'N° Factura',
            'Fecha Factura',
            'Recepción',
            'Cuenta Contable',
            'Aprobador'
        ];
    }

    public function dataReceived($reception)
    {
        foreach ($reception as $detail){
            return $detail->received ? "SI" : "NO";
        }
        return "NO";
    }

    protected function approver(mixed $orderRequest)
    {
        $data = $orderRequest->ocPurchaseOrder->currentApprover->load('user:ID,Nombre');
        return $data[0]->user->Nombre ?? '';
    }

}
