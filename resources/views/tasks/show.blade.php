<x-layouts.porto title="Notifications" 
header="Notifications" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

<b>Client Name: </b> <a href="{{ route('clients.show', [ $task->client->slug ]) }}">{{ $task->client->name }}</a>
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