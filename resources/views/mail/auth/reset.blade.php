<x-mail::message>
Hi, {{$client->name}}

We received a request to access your account<br>
Your reset code is: <b>{{$code}}</b>


    {{--<x-mail::button :url="'http://BloodBank.com'">--}}
{{--Reset--}}
{{--</x-mail::button>--}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
