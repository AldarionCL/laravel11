@php
    $data = \App\Models\OrderRequest\OrderRequest::with( 'ocPurchaseOrder.receptions.fileReception' )->where('request_id', $id )->get();

    if ( $data !== null ){
    foreach ($data as $item) {
        if ( $item->ocPurchaseOrder[0]->receptions ){
@endphp

<a href="{{ Storage::url( $item->ocPurchaseOrder[0]->receptions->fileReception->url ?? '' ) }}" target="_blank">
    {{ $item->ocPurchaseOrder[0]->receptions !== null ? $item->ocPurchaseOrder[0]->receptions->document : '' }}
</a>
@php
    }
    }
    }else{
        echo "No Aplica";
    }
@endphp
