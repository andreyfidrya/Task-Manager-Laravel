<x-layouts.base title="Tasks" header="Edit a Task">
    <form method="post" action="{{ route('tasks.update', [ $task->id ]) }}">
        @method('PUT')
        @include('tasks.tasks-fields-form')   
      <button class="btn btn-primary">Update a Task</button>
    </form>
<b><a href="{{ route('tasks.index') }}">Go back to Tasks Page</a></b>
</x-layouts.base>