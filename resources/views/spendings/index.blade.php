<x-layouts.porto title="Total Spendings per Month" header="Total Spendings per Month" username={{$username}}>
<p>
<a href="{{ route('spendings.create') }}" class="btn btn-success">Add an Expense</a>
</p>
<table class="table">
<thead>
<tr>
  <th scope="col">Spendings</th>
  <th scope="col">Amount, $USD</th> 
  <th scope="col">Date</th> 
  <th scope="col">Action</th>       
</tr>
</thead>
<tbody>
@foreach($spendings as $expense)
<tr>
  <td>{{ $expense->spending }}</td> 
  <td>{{ $expense->amount }}</td> 
  <td>{{ $expense->date }}</td> 
  <td>
    <a href="{{ route('spendings.edit', [ $expense->id ]) }}" class="btn btn-sm btn-primary">Edit</a>
    <form method="post" action="{{ route('spendings.destroy', [ $expense->id ]) }}">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete {{ $expense->spending }} from expenses')">Delete</button>
    </form>
  </td>    
</tr>
@endforeach

</tbody>
</table>
Spendings per month: <strong>{{ $sumspent }} USD</strong><br>
</x-layouts.porto>