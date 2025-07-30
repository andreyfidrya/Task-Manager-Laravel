<x-layouts.porto title="Notifications" 
header="Notifications" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

<form method="post" action="{{ route('payments.store') }}">
    @include('payments.payments-fields-form')   
  <button class="btn btn-primary">Add a Payment</button>
</form>
<b><a href="{{ route('payments.index') }}">Go back to Payments Page</a></b>

</x-layouts.porto>