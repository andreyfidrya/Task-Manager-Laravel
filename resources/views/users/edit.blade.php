<x-layouts.porto title="Edit a User" 
header="Edit a User" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
@bind($user)
    <x-form method="post" action="{{ route('users.update', [ $user->id ]) }}">
    @method('PUT')
    @include('users.form-fields2')   
      <button class="btn btn-primary">Update a User</button>
    </x-form>
<b><a href="{{ route('users.index') }}">Go back to Users Page</a></b>
</x-layouts.porto>