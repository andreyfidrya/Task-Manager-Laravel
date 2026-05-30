<x-layouts.porto title="Edit a script" 
header="Edit a script" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
  @bind($script)
    <x-form method="post" action="{{ route('scripts.update', [ $script->id ]) }}">
        @method('PUT')
        @include('answers.scripts.form-fields')   
      <button class="btn btn-primary">Update a Script</button>
    </x-form>
  @endbind
<b><a href="{{ route('scripts.index') }}">Go back to Scripts Page</a></b>

</x-layouts.porto>
