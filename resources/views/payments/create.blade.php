<x-layouts.porto title="Add a New Payment" header="Add a New Payment">

<form method="post" action="{{ route('payments.store') }}">
    @include('payments.payments-fields-form')   
  <button class="btn btn-primary">Add a Payment</button>
</form>
<b><a href="{{ route('payments.index') }}">Go back to Payments Page</a></b>

</x-layouts.porto>