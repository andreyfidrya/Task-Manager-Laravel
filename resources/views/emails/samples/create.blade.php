<x-layouts.porto title="Notifications" 
header="Notifications" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
    <x-form method="post" action="{{ route('samples.store') }}">
        @include('emails.samples.form-fields')
        <button class="btn btn-primary">Add a sample</button>
    </x-form>
</x-layouts.porto>