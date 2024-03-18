@component('mail::message')
# Hola {{ $ticket_assigned }}

Se ha ingresado el ticket N° {{ $ticket_id }} por {{ $ticket_applicant }}.
Con el siguiente mensaje:

*{{ $ticket_message }}*

Saludos,<br>
{{ config('app.name') }}
@endcomponent
