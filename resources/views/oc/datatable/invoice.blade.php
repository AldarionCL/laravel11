@php
    $data = \App\Models\PurchaseOrder\OcPurchaseOrder::with( 'receptions.fileReception' )->where('id', $id )->get();

    if ( $data !== null ){
    foreach ($data as $item)
        {
@endphp
<a href="{{ Storage::url( $item->receptions->fileReception->url ?? '' ) }}" target="_blank">
    {{ $item->receptions !== null ? $item->receptions->document : '' }}
</a>
@php

    }
}else{
    echo "No Aplica";
}
@endphp
