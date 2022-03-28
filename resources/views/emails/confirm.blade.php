
@component('mail::message')
Hola {{$user->name}}
Has cambiado tu correo electrónico. Por favor, haz click en el siguiente enlace para confirmar tu nuevo correo electrónico:

@component('mail::button', ['url' => route('verify', $user->verification_token)])
Confirmar mi cuenta
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
