<x-layouts.porto title="View a Task" header="View a Task">

<b>Client Name: </b> {{ $task->client->name }}
<hr>
<b>Task: </b>{{ $task->task }}<br>
<b>Budget: </b>{{ $task->budget }}<br>
<b>Performance: </b>{!! $task->performance !!}<br>
<b>Due Date: </b>{{ $task->duedate }}<br>
<b>Author: </b>{{ $task->author }}<br>
<hr>
<a href="{{ route('tasks.edit', [ $task->id ]) }}" class="btn btn-sm btn-primary">Edit</a>
  <form method="post" action="{{ route('tasks.destroy', [ $task->id ]) }}">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete the task from {{ $task->client->name }}')">Delete</button>
  </form>
<b><a href="{{ route('tasks.index') }}">Go back to Tasks Page</a></b>
</x-layouts.porto>