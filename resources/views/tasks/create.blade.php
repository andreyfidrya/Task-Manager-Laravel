<x-layouts.base title="Tasks" header="Add a New Task">
<form method="post" action="{{ route('tasks.store') }}">
    @include('tasks.tasks-fields-form')   
  <button class="btn btn-primary">Add a Task</button>
</form>
<b><a href="{{ route('tasks.index') }}">Go back to Tasks Page</a></b>
</x-layouts.base>

