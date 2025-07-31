<x-layouts.porto title="Edit a Topic" 
header="Edit a Topic" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
@bind($topic)
<x-form method="post" action="{{ route('topics.update', [ $topic->id ]) }}">
        @method('PUT')
        @include('emails.topics.form-fields')   
      <button class="btn btn-primary">Update a Topic</button>
</x-form>
@endbind
<b><a href="{{ route('topics.index') }}">Go back to Topics Page</a></b>

</x-layouts.porto>