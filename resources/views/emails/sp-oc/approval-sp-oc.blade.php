@component('mail::message')
# Hola {{ $name }}

La {{ $subject }} N° {{ $id }}.

{{ $message }}

@if($comment != null)
    {{ $comment }}
@endif

@if( !is_null( $order ) )
@component('mail::table')
| Articulo | Unidades | Precio Unitario Neto | Total |
| :--------- | -------------: | -------------: | -------------: |

@if($approved)
    @foreach( $order->ocDetailPurchaseOrder as $item )
        |{{ $item->ocProduct->name }} | {{ $item->amount }} | {{ $item->unitPrice }} | {{ $item->totalPrice }}|
    @endforeach
@else
@foreach( $order as $item )
    |{{ $item->ocProduct->name }} | {{ $item->amount }} | {{ $item->unitPrice }} | {{ $item->totalPrice }}|
@endforeach
@endif
@endcomponent
@endif


Saludos,
{{ config('app.name') }}
@endcomponent
