Hello {{ $user->name }}
Your email address was changed, please verify the email using this link:
{{ route('api.v1.verify', $user->verification_token) }}
