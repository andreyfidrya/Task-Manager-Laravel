<x-layouts.porto title="View a Client" header="View a Client" username={{$username}}>

<b>Client Name: </b>{{ $client->name }}
<hr>
<b>Client Info: </b>{!! $client->info !!}<br>
<hr>
<a href="{{ route('clients.edit', [ $client->id ]) }}" class="btn btn-sm btn-primary">Edit</a>
  <form method="post" action="{{ route('clients.destroy', [ $client->id ]) }}">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete the task from {{ $client->name }}')">Delete</button>
  </form>
<b><a href="{{ route('clients.index') }}">Go back to Clients Page</a></b>
</x-layouts.porto>