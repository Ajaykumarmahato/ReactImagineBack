@component('mail::message')

Dear **{{$user->name}},**

Please Verify your email Address for {{ config('app.name') }}.

@component('mail::button', ['url' => $url])
Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent