<x-layouts.porto title="View a Topic" header="View a Topic">

<hr>
<b>Name: </b>{{ $topic->name }}<br>
<b>Slug: </b>{{ $topic->slug }}<br>
<b>Samples: </b><br>

@foreach($topic->samples()->orderByDesc('created_at')->get() as $sample)
<a href="{{ $sample->url }}">{{ $sample->url }}<br>
@endforeach

<hr>
<a href="{{ route('topics.edit', [ $topic->id ]) }}" class="btn btn-sm btn-primary">Edit</a>
  <form method="post" action="{{ route('topics.destroy', [ $topic->id ]) }}">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete the task from {{ $topic->name }}')">Delete</button>
  </form>
<b><a href="{{ route('topics.index') }}">Go back to Tasks Page</a></b>
</x-layouts.porto>