<x-layouts.porto title="Total Spendings per Month" header="Total Spendings per Month">
<h3>All expenses per month:</h3>
<p>
<a href="#" class="btn btn-success">Add an expense</a>
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
      <form method="post" onClick="return confirm('Do you want to remove the task from forever?')" action="">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Удалить</button>
      </form>
      <form method="post" action="">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-success">Восстановить</button>
      </form>
  </td>    
</tr>
</tbody>
</table>
</x-layouts.porto>