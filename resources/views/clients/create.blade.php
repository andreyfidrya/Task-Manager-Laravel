<x-layouts.porto title="Add a New Client" header="Add a New Client" username={{$username}} profile_image={{$profile_image}}>
    <x-form method="post" action="{{ route('clients.store') }}" enctype="multipart/form-data">
    @include('clients.form-fields')   
      <button class="btn btn-primary">Add a Client</button>
    </x-form>
<b><a href="{{ route('clients.index') }}">Go back to Clients Page</a></b>
</x-layouts.porto>

