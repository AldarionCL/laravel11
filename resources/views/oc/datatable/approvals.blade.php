@php
    $data = \App\Models\PurchaseOrder\Approval::with( 'user' )->where('ocOrderRequest_id', $id )->where('state', 1)->where('type', 2)->get();

    if ( $data !== null ){
    foreach ($data as $item)
        {
            echo $item !== null ? $item->user->Nombre : 'No aplica';
        }
    }else{
        echo "No Aplica";
    }
@endphp

