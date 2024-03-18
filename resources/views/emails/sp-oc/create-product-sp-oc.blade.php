@component('mail::message')
# Hola {{ $name }}

{{ $name_recorder }}, solicita la creación de un articulo, favor de comunicar con él, para mas detalles.

Saludos,
{{ config('app.name') }}
@endcomponent
