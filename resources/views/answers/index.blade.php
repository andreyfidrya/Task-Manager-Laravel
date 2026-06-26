<x-layouts.porto title="Answer Template" 
header="Answer Template" 
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

@if(!empty($answer->maintext))
    {!! $answer->maintext !!}<p>
@endif

@if(!empty($answer->addquestion))
    {{ $answer->addquestion }}<p>
@endif
    
<a href="{{ route('answers.edit', [ $answer->id ]) }}" class="btn btn-primary">Customize</a>    
</x-layouts.porto>