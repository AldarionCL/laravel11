@php
    $data = \App\Models\OrderRequest\OcOrderRequest::with( 'orderRequest' )->where( 'id', $id )->get();

        foreach ($data[0]->orderRequest as $item)
        {
            if ( $item !== null ){
                echo $item->order_id;

            }
        }

@endphp
