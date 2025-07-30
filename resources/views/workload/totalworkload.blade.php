<x-layouts.porto title="Notifications" 
header="Notifications" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
<h3>Total word count per week:<strong> {{$totalwordcount}}</h3></strong>
</x-layouts.porto>