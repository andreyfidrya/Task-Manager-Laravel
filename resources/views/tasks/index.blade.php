<x-layouts.porto title="Tasks" header="Tasks">


<p>
<a href="{{ route('tasks.create') }}" class="btn btn-success">Add a Task</a>
</p>

<table class="table">
<thead>
<tr>
  <th scope="col">Client Name</th>
  <th scope="col">Task</th>
  <th scope="col">Budget, $USD</th>
  <th scope="col">Performance</th>
  <th scope="col">Due date</th>
  <th scope="col">Author</th>
  <th scope="col">Action</th>       
</tr>
</thead>
<tbody>
@foreach($tasks as $task)
<tr>
  <td><a href="{{ route('clients.show', [ $task->client->slug ]) }}">{{ $task->client->name }}</a></td>
  <td>{{ $task->task }}</td> 
  <td>{{ $task->budget }}</td>  
  <td>{!! $task->performance !!}</td> 
  <td>{{ $task->duedate }}</td> 
  <td>{{ $task->author }}</td> 
  <td>
  <a href="{{ route('tasks.show', [ $task->id ]) }}" class="btn btn-info">View</a>
  <a href="{{ route('tasks.edit', [ $task->id ]) }}" class="btn btn-sm btn-primary">Edit</a>
  <form method="post" action="{{ route('tasks.destroy', [ $task->id ]) }}">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete the task from {{ $task->client->name }}')">Delete</button>
  </form>  
  </td>    
</tr>
@endforeach

</tbody>
</table>
</x-layouts.porto>