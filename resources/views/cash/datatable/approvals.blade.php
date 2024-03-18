@php
    $data = \App\Models\Cash\CashierApprovals::with( 'user' )->where('cash_id', $id )->where('state', 1)->get();

    if ( $data !== null ){
    foreach ($data as $item)
        {
            echo $item !== null ? $item->user->Nombre : 'No aplica';
        }
    }else{
        echo "No Aplica";
    }
@endphp
