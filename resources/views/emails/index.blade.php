<x-layouts.porto title="Emails" header="Emails" username={{$username}}>

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