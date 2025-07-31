<x-layouts.porto title="Edit a Notification" 
header="Edit a Notification" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
 @bind($notification)
    <form method="post" action="{{ route('notifications.update', [ $notification->id ]) }}">
        @method('PUT')     
        @include('notifications.form-fields')   
    <button class="btn btn-primary">Update a Notification</button>
    </form>
    <b><a href="{{ route('notifications.index') }}">Go back to the Notifications Page</a></b>
 @endbind
</x-layouts.porto>