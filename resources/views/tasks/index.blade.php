<x-layouts.porto title="Tasks" header="Tasks">


<p>
<a href="{{ route('tasks.create') }}" class="btn btn-success">Add a Task</a>
</p>

<form method="get" action="">
<label>Statuses:</label>
<select name="task_statuses">
<option value="all_statuses">All statuses</option>
@foreach($statusesArr as $status)
  @if(isset($_GET['task_statuses'])) 
    <option value="{{ $status->value }}" {{ (  $_GET['task_statuses'] == $status->value ) ? 'selected' : ''}}>{{ $status->name }}</option>
  @else  
    <option value="{{ $status->value }}">{{ $status->name }}</option>  
  @endif
@endforeach
</select>
<input type="submit" class="btn btn-info" name="apply_filter" value="Apply Filter">
<input type="submit" class="btn btn-info" name="empty-filters" value="Empty Filter">
</form>

<table class="table">
<thead>
<tr>
  <th scope="col"></th>
  <th scope="col">Client Name</th>
  <th scope="col">Task</th>
  <th scope="col">Word Count</th>
  <th scope="col">Budget, $USD</th>
  <th scope="col">Performance</th>
  <th scope="col">Due date</th>
  <th scope="col">Status</th>
  <th scope="col">User</th>
  <th scope="col">Action</th>       
</tr>
</thead>
<tbody>

@foreach($tasks as $task)
  
  @if(isset($_GET['task_statuses']) && $_GET['task_statuses'] !== 'all_statuses' && $_GET['task_statuses'] == $task->status->value && isset($_GET['apply_filter']))  
    <tr>
      <td><input type="checkbox" name="select" value="{{$task->budget}}" onclick="UpdateCost(this);"></td>
      <td><a href="{{ route('clients.show', [ $task->client->slug ]) }}">{{ $task->client->name }}</a></td>
      <td>{{ $task->task }}</td>
      <td>{{ $task->wordcount }}</td> 
      <td>{{ $task->budget }}</td>  
      <td>{!! $task->performance !!}</td> 
      <td>{{ $task->duedate }}</td>
      <td>{{ $task->status->text() }}</td>
      <td>{{ $task->user->name }}</td>   
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
  @endif
  
  @if(isset($_GET['task_statuses']) && $_GET['task_statuses'] === 'all_statuses' || !isset($_GET['task_statuses']))
    <tr>
      <td><input type="checkbox" name="select" value="{{$task->budget}}" onclick="UpdateCost(this);"></td>
      <td><a href="{{ route('clients.show', [ $task->client->slug ]) }}">{{ $task->client->name }}</a></td>
      <td>{{ $task->task }}</td>
      <td>{{ $task->wordcount }}</td> 
      <td>{{ $task->budget }}</td>  
      <td>{!! $task->performance !!}</td> 
      <td>{{ $task->duedate }}</td>
      <td>{{ $task->status->text() }}</td>
      <td>{{ $task->user->name }}</td>   
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
  @endif  

@endforeach

</tbody>
</table>

Total cost: <input type="text" id="total" disabled="disabled"/> 

<script>
  var total=0;
  function UpdateCost(elem) {
 
    if (elem.checked == true) { 
		total += Number(elem.value); 
	  }else{
		total -=Number(elem.value);
	  }
 
	document.getElementById('total').value = total.toFixed(0);
}
</script>

</x-layouts.porto>