<x-layouts.porto title="Edit an Answer" 
header="Edit an Answer" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
    @bind($answer)
    <form method="post" action="{{ route('answers.update', [ $answer->id ]) }}">
    @method('PUT')    
    @include('answers.form-fields')   
    <button class="btn btn-primary">Generate</button>
    </form>
    @endbind
</x-layouts.porto>