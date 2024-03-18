@component('mail::message')
# Hola {{ $name }}

La {{ $subject }} N° {{ $order_request_id }}, fue modificada, en los siguientes articulos:

@foreach($products as $product )
{{ $product['name'] }}<br>
@endforeach

Saludos,
{{ config('app.name') }}
@endcomponent
