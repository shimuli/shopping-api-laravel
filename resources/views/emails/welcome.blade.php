@component('mail::message')
Hello {{ $user->name }}

Thank you fro creating an account, please verify your email using the button below:

@component('mail::button', ['url' => route('api.v1.verify', $user->verification_token)])
Verify Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

