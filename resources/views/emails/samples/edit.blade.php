<x-layouts.porto title="Edit a Sample" 
header="Edit a Sample" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
@bind($sample)
    <x-form method="post" action="{{ route('samples.update', [ $sample->id ]) }}">
        @method('PUT')
        @include('emails.samples.form-fields')
        <button class="btn btn-primary">Update a sample</button>
    </x-form>
@endbind
</x-layouts.porto>