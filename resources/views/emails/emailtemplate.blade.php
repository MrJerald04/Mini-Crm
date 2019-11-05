@component('mail::message')
Hello **{{$emailMessage->to_name}}**,  {{-- use double space for line break --}}
  
{{$emailMessage->message}}


Sincerely,  
{{ config('app.name') }}
@endcomponent
