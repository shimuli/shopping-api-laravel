@component('mail::message')
Hello {{ $user->name }}

Your email address was changed, please verify the email using the button below:

@component('mail::button', ['url' => route('api.v1.verify', $user->verification_token)])
Verify Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
