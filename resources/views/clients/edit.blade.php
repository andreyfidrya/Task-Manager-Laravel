<x-layouts.porto title="Edit a client" header="Edit a Clinet" username={{$username}}>
  @bind($client)
    <x-form method="post" action="{{ route('clients.update', [ $client->id ]) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('clients.form-fields')   
      <button class="btn btn-primary">Update a Client</button>
    </x-form>
  @endbind
<b><a href="{{ route('clients.index') }}">Go back to Clients Page</a></b>
</x-layouts.porto>