@if( $state === 1 )
    Pendiente de aprobación

@elseif( $state === 2 )
    Aprobado

@elseif( $state === 3 )
    Rechazado

@elseif( $state === 4 )
    En asignación de precio

@elseif( $state === 5 )
    En orden de compra

@elseif( $state === 6 )
    Anulada

@endif
