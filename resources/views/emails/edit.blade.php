<x-layouts.porto title="Emails" header="Customize an Email">

<form method="post">
@method('PUT')    
@include('emails.form-fields')   
  <button class="btn btn-primary">Generate</button>
</form>

</x-layouts.porto>