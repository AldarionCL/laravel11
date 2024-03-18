@component('mail::message')
# Hola {{ $name }}

La {{ $subject }} N° {{ $id }}.

{{ $message }}

@if($comment != null)
    {{ $comment }}
@endif

@if( !is_null( $details ) )
@component('mail::table')
| N° Documento | Tipo Documento | Proveedor | Total |
| :--------- | -------------: | -------------: | -------------: |
@foreach( $details as $key => $item )
    @php
        $total = 0;
        if(!isset($item->total)){
            $total += $item['amount'];
        }
    @endphp
| {{ $item->number_document ?? $item['document'] }} | {{  $item->document->name ?? ( $item['document'] === 1  ? 'Boleta' : $item['document'] === 2 ) ? 'Factura' : 'Boleta Honorarios'   }} | {{  $item->provider ?? $item['provider'] }} | {{ $item->total ?? $total  }}|
@endforeach

@endcomponent
@endif

Saludos,
{{ config('app.name') }}
@endcomponent
