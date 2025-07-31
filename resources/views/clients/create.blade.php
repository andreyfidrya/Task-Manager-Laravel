<x-layouts.porto title="Add a client" 
header="Add a client" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
    <x-form method="post" action="{{ route('clients.store') }}" enctype="multipart/form-data">
    @include('clients.form-fields')   
      <button class="btn btn-primary">Add a Client</button>
    </x-form>
<b><a href="{{ route('clients.index') }}">Go back to Clients Page</a></b>
</x-layouts.porto>

