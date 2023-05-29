<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Regular Payments</title>
</head>
<body>

<h1>Regular Payments</h1>
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
      <a href="" class="btn btn-sm btn-primary">Edit</a>
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
</body>
</html>