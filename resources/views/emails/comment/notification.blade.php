@component('mail::message')
# Hola {{ $comment_for }}

Se ha ingresado un seguimiento al ticket N° {{ $ticket_id }} por {{ $comment_by }}.
Con el siguiente mensaje:

*{{ $comment_message }}*

Saludos,<br>
{{ config('app.name') }}
@endcomponent
