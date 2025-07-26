<x-layouts.porto title="Emails" header="Customize an Email" username={{$username}} profile_image={{$profile_image}}>
  @bind($email)
<form method="post" action="{{ route('emails.update', [ $email->id ]) }}">
@method('PUT')    
@include('emails.form-fields')   
  <button class="btn btn-primary">Generate</button>
</form>
  @endbind
</x-layouts.porto>