<x-layouts.porto title="Notifications" 
header="Notifications" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

<form method="post" action="{{ route('topics.store') }}">
    @include('emails.topics.form-fields')   
  <button class="btn btn-primary">Add a Topic</button>
</form>
<b><a href="{{ route('topics.index') }}">Go back to Topics Page</a></b>

</x-layouts.porto>