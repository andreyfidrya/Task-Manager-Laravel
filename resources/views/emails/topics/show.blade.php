<x-layouts.porto title="View a Task" header="View a Task">

<hr>
<b>Name: </b>{{ $topic->name }}<br>
<b>Slug: </b>{{ $topic->slug }}<br>
<b>Samples: </b>
<hr>
<a href="{{ route('topics.edit', [ $topic->id ]) }}" class="btn btn-sm btn-primary">Edit</a>
  <form method="post" action="{{ route('topics.destroy', [ $topic->id ]) }}">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete the task from {{ $topic->name }}')">Delete</button>
  </form>
<b><a href="{{ route('topics.index') }}">Go back to Tasks Page</a></b>
</x-layouts.porto>