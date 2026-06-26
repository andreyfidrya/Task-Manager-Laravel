<x-layouts.porto title="Edit a Topic" 
header="Edit a Response" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
@bind($response)
<x-form method="post" action="{{ route('responses.update', [ $response->id ]) }}">
        @method('PUT')
        @include('answers.responses.form-fields')   
      <button class="btn btn-primary">Update a Response</button>
</x-form>
@endbind
<b><a href="{{ route('responses.index') }}">Go back to Response Page</a></b>

</x-layouts.porto>