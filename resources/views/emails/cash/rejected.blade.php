@component('mail::message')
# Hola {{ $name }}

La rendición de caja chica N° {{ $id }}. Fue aprobada con las siguientes observaciones:

{{ $message }}

@if( !is_null( $details ) )
@component('mail::table')
| N° Documento | Tipo Documento | Proveedor | Total |
| :--------- | -------------: | -------------: | -------------: |
@foreach( $details as $item )
| {{ $item->number_document }} | {{ $item->document->name }} | {{ $item->provider }} | {{ $item->total }}|
@endforeach

@endcomponent
@endif

Saludos,
{{ config('app.name') }}
@endcomponent
