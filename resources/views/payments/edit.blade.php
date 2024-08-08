<x-layouts.porto title="Payments" header="Edit a Payment" username={{$username}}>

<form method="post" action="{{ route('payments.update', [ $payment->id ]) }}">
@method('PUT')    
@include('payments.payments-fields-form')   
  <button class="btn btn-primary">Update a Payment</button>
</form>
<b><a href="{{ route('payments.index') }}">Go back to Payments Page</a></b>

</x-layouts.porto>