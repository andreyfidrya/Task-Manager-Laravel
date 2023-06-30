<x-layouts.base title="Add a New Task" header="Add a New Task">
    <x-form method="post" action="{{ route('tasks.store') }}">
    @include('tasks.form-fields')   
      <button class="btn btn-primary">Add a Task</button>
    </x-form>
<b><a href="{{ route('tasks.index') }}">Go back to Tasks Page</a></b>
</x-layouts.base>

