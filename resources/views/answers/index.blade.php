<x-layouts.porto title="Answer Template" 
header="Answer Template" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

<h1>{{ $answer->template }}:</h1>
<hr>
{{ $answer->waiting }}<p>
{{ $answer->apologize }}<p>
{{ $answer->addquestion }}<p>
{{ $answer->goodbye }}<p>

<a href="{{ route('answers.edit', [ $answer->id ]) }}" class="btn btn-primary">Customize</a>
</x-layouts.porto>