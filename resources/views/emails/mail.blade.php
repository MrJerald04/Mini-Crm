@component('mail::message')
Hello **{{$name}}**,  {{-- use double space for line break --}}
New Company Added.  
Company name: **{{$company}}**

{{-- Click below to start working right now --}}
{{-- @component('mail::button', ['url' => $link])
Go to your inbox
@endcomponent --}}
Sincerely,  
Admin.
@endcomponent