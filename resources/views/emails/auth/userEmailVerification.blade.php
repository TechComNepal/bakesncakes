@component('mail::message')
    # Welcome {{ $notifiable->name }}

    You are almost ready to get started. Please click on the button below to verify your email address and enjoy shopping
    with us!

    @component('mail::button', ['url' => $url])
        Verify Email Address
    @endcomponent

    If you did not create an account, no further action is required.
    Thanks,

    {{ config('app.name') }} Team

    @component('mail::subcopy')
        If you’re having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser:
        {{ $url }}
    @endcomponent

@endcomponent
