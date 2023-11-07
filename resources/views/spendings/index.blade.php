<x-layouts.porto title="Total Spendings per Month" header="Total Spendings per Month">
<p>
<a href="#" class="btn btn-success">Add an Expense</a>
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
<tr>
  <td></td> 
  <td></td> 
  <td></td> 
  <td>
    <a href="#" class="btn btn-sm btn-primary">Edit</a>
    <form method="post" action="">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete from expenses')">Delete</button>
    </form>
  </td>    
</tr>
</tbody>
</table>
Spendings per month: <strong></strong><br>
</x-layouts.porto>