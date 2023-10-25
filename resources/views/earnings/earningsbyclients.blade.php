<x-layouts.porto title="Earnings by Clients per Month" header="Earnings by Clients per Month">

    @foreach($clients as $client)            
        <strong><h2>{{$client->name}}</h2></strong><br>
        <table class="table">
<thead>
<tr>  
  <th scope="col">Task</th>
  <th scope="col">Budget, $USD</th>
  <th scope="col">Performance</th>
  <th scope="col">Due date</th>
  <th scope="col">Author</th>
  <th scope="col">Completion date</th>         
</tr>
</thead>
<tbody>
    @foreach($client->tasks()->onlyTrashed()->get() as $task)                
<tr>
  <td>{{ $task->task }}</td> 
  <td>{{ $task->budget }}</td>  
  <td>{!! $task->performance !!}</td> 
  <td>{{ $task->duedate }}</td> 
  <td>{{ $task->author }}</td>
  <td>{{ $task->deleted_at }}</td> 
</tr>
    @endforeach

</tbody>
</table>
    @endforeach
</x-layouts.porto>