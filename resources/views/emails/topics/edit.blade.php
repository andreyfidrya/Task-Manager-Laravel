<x-layouts.porto title="Edit a topic" header="Edit a Topic">
@bind($topic)
<x-form method="post" action="{{ route('topics.update', [ $topic->id ]) }}">
        @method('PUT')
        @include('emails.topics.form-fields')   
      <button class="btn btn-primary">Update a Task</button>
</x-form>
@endbind
<b><a href="{{ route('topics.index') }}">Go back to Topics Page</a></b>

</x-layouts.porto>