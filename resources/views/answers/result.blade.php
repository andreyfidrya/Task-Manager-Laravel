<x-layouts.porto title="Answer Template" 
header="Answer Template" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
<h1>Generated Answer</h1>

<textarea class="form-control" rows="20">
{{ $answer }}
</textarea>
</x-layouts.porto>