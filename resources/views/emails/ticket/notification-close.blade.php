@component('mail::message')
# Hola {{ $ticket_applicant }}

El ticket N° {{ $ticket_id }}.

{{ $comment_message }}

Saludos,<br>
{{ config('app.name') }}
@endcomponent
