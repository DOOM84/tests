@component('mail::message')
# Здравствуйте!

{!! $table !!}

С уважением,<br>
{{ config('app.name') }}
@endcomponent