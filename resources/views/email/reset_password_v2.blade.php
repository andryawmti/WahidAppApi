@component('mail::message')

<strong>Hello, {{ $user->first_name }} {{ $user->last_name }}</strong><br><br>

You are receiving this email because we received a password reset request for your account.

@component('mail::button', ['url' => $link])
Resset Password
@endcomponent

If you did not request a password reset, no further action is required.
<br><br>

Regards,<br>
{{ config('app.name') }}
@endcomponent
