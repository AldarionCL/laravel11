@php
    $data = \App\Models\OrderRequest\OcDetailOrderRequest::whereHas( 'ocProduct', function ( $query ) {
                $query->where('costCenter_id', auth()->user()->purchaseOrderGenerator->branchOffice_id );
            }

     )
     ->where( 'ocOrderRequest_id', $id )
     ->where( 'state', 0)
     ->where('unitPrice', '>', 0)
     ->get();


    if ( $data !== null ){
    foreach ($data as $item)
        {
            echo 'Articulo :' . $item->ocProduct->name . '| Descripción :' . $item->description . '| Cantidad :' . $item->amount. '| Total :' . $item->totalPrice . '<br>';
        }
    }else{
        echo "No Aplica";
    }
@endphp
