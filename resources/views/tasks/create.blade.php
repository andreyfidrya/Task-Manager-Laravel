<x-layouts.porto title="Add a task" 
header="Add a task" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
    <x-form method="post" action="{{ route('tasks.store') }}">
    @include('tasks.form-fields')   
      <button class="btn btn-primary">Add a Task</button>
    </x-form>
<b><a href="{{ route('tasks.index') }}">Go back to Tasks Page</a></b>
</x-layouts.porto>

