<x-layouts.porto title="Add a Notification" 
header="Add a Notification" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

<form method="post" action="{{ route('notifications.store') }}">
    @include('notifications.form-fields')   
  <button class="btn btn-primary">Add a Notification</button>
</form>
<b><a href="{{ route('notifications.index') }}">Go back to the Notifications Page</a></b>

</x-layouts.porto>

