@component('mail::message')
# Здравствуйте, {{Auth::user()->name}}!

{!! $table !!}

С уважением,<br>
{{ config('app.name') }}
@endcomponent