<x-layouts.porto title="Notifications" 
header="Notifications" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
  @bind($email)
<form method="post" action="{{ route('emails.update', [ $email->id ]) }}">
@method('PUT')    
@include('emails.form-fields')   
  <button class="btn btn-primary">Generate</button>
</form>
  @endbind
</x-layouts.porto>