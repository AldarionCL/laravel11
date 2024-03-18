<?php

namespace App\Imports;

use App\Models\PurchaseOrder\OcDetailPurchaseOrder;
use App\Models\PurchaseOrder\OcPurchaseOrder;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportExcel implements ToCollection, WithChunkReading, WithHeadingRow
{
    public function chunkSize(): int
    {
        return 1000;
    }

    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            OcPurchaseOrder::updateOrCreate(
                ['id' => $row['numero_oc']],
                [
                'id' => $row['numero_oc'],
                'business_id' => $row['id_empresa'],
                'brand_id' => $row['id_gerencias'],
                'branch_id' => $row['id_sucursales'],
                'typeOfBranch_id' => 3,
                'buyers_id' => $row['id_solicitante'],
                'state' => $row['estado'],
                'provider' => $row['id_proveedores'],
                'condition' => 3,
                'direction' => '',
                'commune' => 2,
                'contact_id' => 3
            ]);

            OcDetailPurchaseOrder::create([
                'ocCategory_id' => $row['id_categorias'],
                'ocSubCategory_id' => $row['id_subcategorias'],
                'ocProduct_id' => $row['id_articulo'],
                'amount' => $row['cantidad'],
                'unitPrice' => $row['unitario'],
                'totalPrice' => $row['total'],
                'branch_id' => $row['id_centro_costo'],
                'ocPurchaseOrder_id' => $row['numero_oc'],
                'description' => $row['descripcion'],
                'taxAmount' => $row['impuesto_valor'],
                'taxe' => $row['id_impuesto'],
            ]);
        }
    }
}
