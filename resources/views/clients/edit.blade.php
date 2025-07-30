<x-layouts.porto title="Notifications" 
header="Notifications" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
  @bind($client)
    <x-form method="post" action="{{ route('clients.update', [ $client->id ]) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('clients.form-fields')   
      <button class="btn btn-primary">Update a Client</button>
    </x-form>
  @endbind
<b><a href="{{ route('clients.index') }}">Go back to Clients Page</a></b>
</x-layouts.porto>