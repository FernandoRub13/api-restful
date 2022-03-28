
@component('mail::message')
Hola {{$user->name}}
Gracias por registrarte en nuestra aplicación. Por favor, haz click en el siguiente enlace para activar tu cuenta:

@component('mail::button', ['url' => route('verify', $user->verification_token)])
Confirmar mi cuenta
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
