<x-layouts.porto title="Show a Response" 
header="Show a Response" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

<h1>{{ $answer->template }}:</h1>
<hr>

@if(!empty($answer->waiting))
    {{ $answer->waiting }}<p>
@endif

@if(!empty($answer->apologize))
    {{ $answer->apologize }}<p>
@endif

{!! $response->description !!}<p>

@if(!empty($answer->maintext))
    {!! $answer->maintext !!}<p>
@endif

@if(!empty($answer->addquestion))
    {{ $answer->addquestion }}<p>
@endif

</x-layouts.porto>
