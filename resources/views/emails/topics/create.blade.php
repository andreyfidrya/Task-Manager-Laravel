<x-layouts.porto title="Add a topic" header="Add a New Topic" username={{$username}}>

<form method="post" action="{{ route('topics.store') }}">
    @include('emails.topics.form-fields')   
  <button class="btn btn-primary">Add a Topic</button>
</form>
<b><a href="{{ route('topics.index') }}">Go back to Topics Page</a></b>

</x-layouts.porto>