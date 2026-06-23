<x-layouts.porto title="Create a Response" 
header="Create a Response" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

<form method="post" action="{{ route('responses.store') }}">
    @include('answers.responses.form-fields')   
  <button class="btn btn-primary">Add a Response</button>
</form>
<b><a href="{{ route('responses.index') }}">Go back to Responses Page</a></b>

</x-layouts.porto>