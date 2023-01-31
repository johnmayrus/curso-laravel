@component('mail::message')
# Introdução

Corpo da mensagem.

@component('mail::button', ['url' => ''])
Texto do butão
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
