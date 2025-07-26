<x-layouts.porto title="View an Email" header="View an Email" username={{$username}} profile_image={{$profile_image}}>

{{ $email->spam }}<br>
{{ $email->client }}<br>
{!! $email->intro !!}<br>
I have experience in writing content related to <b>{{ $topic->name }}</b>. Here are some of my writing samples:<br>

@foreach($topic->samples()->orderByDesc('created_at')->get() as $sample)
<a href="{{ $sample->url }}">{{ $sample->url }}</a><br>
@endforeach

{{ $email->wordpress }}<br>
{{ $email->seo }}<br>
{{ $email->cost }}<br>
{!! $email->conclusion !!}
<hr>
<a href="{{ route('topics.edit', [ $topic->id ]) }}" class="btn btn-sm btn-primary">Edit a Topic</a>
  <form method="post" action="{{ route('topics.destroy', [ $topic->id ]) }}">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete the task from {{ $topic->name }}')">Delete a topic</button>
  </form>
<b><a href="{{ route('topics.index') }}">Go back to the Topics Page</a></b>
</x-layouts.porto>