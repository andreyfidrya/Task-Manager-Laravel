<x-layouts.porto title="Notifications" 
header="Notifications" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
@foreach($users as $user)
<h3>{{$user->name}} has written <strong> {{ $user->tasks()->onlyTrashed()->whereBetween('deleted_at', [$weekStartDate, $weekEndDate])->sum('wordcount'); }} words per week</h3></strong>
@endforeach
</x-layouts.porto>