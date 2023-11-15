<x-mail::message>
مرحباً {{$user->name}}<br/>
<p>قم بإدخال هذاء الرمز للتحقق و تفعيل الحساب</p>
<div style="font-size:100px text-cenetr">
  <p>{{$user->code_verified_at}}</p>
</div>
<x-mail::button :url="route('login')">
تسجيل دخول
</x-mail::button>
{{ config('app.name') }}
</x-mail::message>
