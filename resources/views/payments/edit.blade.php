<x-layouts.porto title="Edit a Payment" 
header="Edit a Payment" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

<form method="post" action="{{ route('payments.update', [ $payment->id ]) }}">
@method('PUT')    
@include('payments.payments-fields-form')   
  <button class="btn btn-primary">Update a Payment</button>
</form>
<b><a href="{{ route('payments.index') }}">Go back to Payments Page</a></b>

</x-layouts.porto>