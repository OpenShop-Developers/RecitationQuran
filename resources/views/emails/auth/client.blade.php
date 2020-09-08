@component('mail::message')
مرحبا !
استعادة كلمة المرور لتطبيق تسميع

{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}

<p>كلمة استعادة المرور الخاصه بك هي <strong>{{$code}}</strong></p>

شكرا لك <br>
{{ config('app.name') }}
@endcomponent
