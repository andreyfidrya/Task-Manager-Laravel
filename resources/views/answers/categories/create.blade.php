<x-layouts.porto title="Create a Topic" 
header="Create a Category" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

<form method="post" action="{{ route('categories.store') }}">
    @include('answers.categories.form-fields')   
  <button class="btn btn-primary">Add a Category</button>
</form>
<b><a href="{{ route('categories.index') }}">Go back to Categories Page</a></b>

</x-layouts.porto>
