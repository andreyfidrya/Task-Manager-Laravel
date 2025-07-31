<x-layouts.porto title="Total Work Load Per Week" 
header="Total Work Load Per Week" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
<h3>Total word count per week:<strong> {{$totalwordcount}}</h3></strong>
</x-layouts.porto>