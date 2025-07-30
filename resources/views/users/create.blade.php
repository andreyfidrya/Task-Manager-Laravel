<x-layouts.porto title="Notifications" 
header="Notifications" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
    <x-form method="post" action="{{ route('users.store') }}">
    @include('users.form-fields')   
      <button class="btn btn-primary">Add a User</button>
    </x-form>
<b><a href="{{ route('users.index') }}">Go back to Users Page</a></b>
</x-layouts.porto>