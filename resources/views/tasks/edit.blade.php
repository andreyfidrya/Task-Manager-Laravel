<x-layouts.porto title="Notifications" 
header="Notifications" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
  @bind($task)
    <x-form method="post" action="{{ route('tasks.update', [ $task->id ]) }}">
        @method('PUT')
        @include('tasks.form-fields')   
      <button class="btn btn-primary">Update a Task</button>
    </x-form>
  @endbind
<b><a href="{{ route('tasks.index') }}">Go back to Tasks Page</a></b>
</x-layouts.porto>