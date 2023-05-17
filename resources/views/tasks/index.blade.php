<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Task Manager</title>
</head>
<body>
<h1>Task Manager</h1>

<p>
<a href="{{ route('tasks.create') }}" class="btn btn-success">Add a Task</a>
</p>

<table class="table">
<thead>
<tr>
  <th scope="col">Client Name</th>
  <th scope="col">Task</th>
  <th scope="col">Budget</th>
  <th scope="col">Performance</th>
  <th scope="col">Due date</th>
  <th scope="col">Author</th>
  <th scope="col">Action</th>       
</tr>
</thead>
<tbody>

@foreach($tasks as $task)
<tr>
  <td>{{ $task->clientname }}</td>
  <td>{{ $task->task }}</td> 
  <td>{{ $task->budget }}</td>  
  <td>{{ $task->performance }}</td> 
  <td>{{ $task->duedate }}</td> 
  <td>{{ $task->author }}</td> 
  <td>
  <a href="{{ route('tasks.edit', [ $task->id ]) }}" class="btn btn-sm btn-primary">Edit</a>
  <form method="post" action="{{ route('tasks.destroy', [ $task->id ]) }}">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete the task from {{ $task->clientname }}')">Delete</button>
  </form>  
  </td>    
</tr>
@endforeach


</tbody>
</table>


</body>
</html>