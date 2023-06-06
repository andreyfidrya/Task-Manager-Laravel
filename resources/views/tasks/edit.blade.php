<x-layouts.base title="Tasks" header="Edit a Task">
  @bind($task)
    <x-form method="post" action="{{ route('tasks.update', [ $task->id ]) }}">
        @method('PUT')
        @include('tasks.form-fields')   
      <button class="btn btn-primary">Update a Task</button>
    </x-form>
<b><a href="{{ route('tasks.index') }}">Go back to Tasks Page</a></b>
</x-layouts.base>