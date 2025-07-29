<x-layouts.porto title="Add a New Notification" header="Add a New Notification" username={{$username}} profile_image={{$profile_image}}>

<form method="post" action="{{ route('notifications.store') }}">
    @include('notifications.form-fields')   
  <button class="btn btn-primary">Add a Notification</button>
</form>
<b><a href="{{ route('notifications.index') }}">Go back to the Notifications Page</a></b>

</x-layouts.porto>

