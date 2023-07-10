<x-layouts.porto title="Payments" header="Regular Payments">

  <p>
    <a href="{{ route('payments.create') }}" class="btn btn-success">Add a Payment</a>
  </p> 
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Payment</th>
      <th scope="col">Amount, UAH</th>
      <th scope="col">Due Date</th>
      <th scope="col">Days Left</th>
      <th scope="col">Action</th>       
    </tr>
  </thead>
  <tbody>

@foreach($payments as $payment)  
<tr>
      <td>{{ $payment->payment }}</td>
      <td>{{ $payment->amount }}</td>
      <td>{{ $payment->duedate }}</td>
      <td>{{ $payment->daysleft }}</td>
      <td>
      <a href="{{ route('payments.edit', [ $payment->id ]) }}" class="btn btn-sm btn-primary">Edit</a>
      <form method="post" action="{{ route('payments.destroy', [ $payment->id ]) }}">
          @csrf
          @method('DELETE')
          <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete the payment from {{ $payment->payment }}')">Delete</button>
      </form>
      </td>     
</tr>
@endforeach
  
</tbody>
</table>  

</x-layouts.porto>