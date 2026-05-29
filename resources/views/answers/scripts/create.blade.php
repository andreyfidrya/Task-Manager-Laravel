<x-layouts.porto title="Create a Category" 
header="Add a Script" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

<form method="post" action="{{ route('scripts.store') }}">
    @include('answers.scripts.form-fields')   
  <button class="btn btn-primary">Add a Script</button>
</form>

<b><a href="{{ route('scripts.index') }}">Go back to Scripts Page</a></b>

</x-layouts.porto>