<x-layouts.porto title="Total Earnings per Month" header="Total Earnings per Month">


<table class="table">
<thead>
<tr>
  <th scope="col">Client Name</th>
  <th scope="col">Task</th>
  <th scope="col">Budget, $USD</th>
  <th scope="col">Performance</th>
  <th scope="col">Due date</th>
  <th scope="col">Author</th>
  <th scope="col">Completion date</th>
  <th scope="col">Action</th>       
</tr>
</thead>
<tbody>
@foreach($performedtasks as $task)
<tr>
  <td><a href="{{ route('clients.show', [ $task->client->slug ]) }}">{{ $task->client->name }}</a></td>
  <td>{{ $task->task }}</td> 
  <td>{{ $task->budget }}</td>  
  <td>{!! $task->performance !!}</td> 
  <td>{{ $task->duedate }}</td> 
  <td>{{ $task->author }}</td>
  <td>{{ $task->deleted_at }}</td> 
  <td>
      <form method="post" onClick="return confirm('Do you want to remove the task from {{ $task->client->name }} forever?')" action="{{ route('removetaskforever', [ $task->id ]) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Удалить</button>
      </form>
      <form method="post" action="{{ route('restoretask', [ $task->id ]) }}">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-success">Восстановить</button>
      </form>
  </td>    
</tr>
@endforeach

</tbody>
</table>
Total earnings per month: <strong>{{$sum}} USD</strong><br>
</x-layouts.porto>