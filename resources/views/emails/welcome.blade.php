Hello {{ $user->name }}
Thank you fro creating an account, please verify your email using this link:
{{ route('api.v1.verify', $user->verification_token) }}
