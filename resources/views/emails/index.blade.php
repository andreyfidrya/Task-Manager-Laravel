<x-layouts.porto title="Email Template" 
header="Email Template" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

<h1>{{ $email->template }}:</h1>
<hr>
{{ $email->spam }}<p>
{{ $email->client }}<p>

{!! $email->intro !!}<p> 

{{ $email->wordpress }}<p> 

{{ $email->seo }}<p>
    
{{ $email->cost }}<p>

{!! $email->conclusion !!}<p>

<a href="{{ route('emails.edit', [ $email->id ]) }}" class="btn btn-primary">Customize</a>
</x-layouts.porto>