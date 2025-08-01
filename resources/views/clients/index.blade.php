<x-layouts.porto title="Active Clients" 
header="Active Clients" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

<p>
<a href="{{ route('clients.create') }}" class="btn btn-success">Add a Client</a>
</p>

<table class="table">
<thead>
<tr>
  <th scope="col">Client Name</th>
  <th scope="col">Client Slug</th>
  <th scope="col">Client Info</th>
  <th scope="col">Client Price</th>
  <th scope="col">Image</th>
  <th scope="col">Action</th> 
</tr>
</thead>
<tbody>
@foreach($clients as $client)
<tr>
  <td>{{ $client->name }}</td>
  <td>{{ $client->slug }}</td> 
  <td>{!! $client->info !!}</td>
  <td>{{ $client->price }}</td>
  <td><img src="{{asset('images')}}/{{$client->image}}"style="max-width:150px"></td>  
<td>
  <a href="{{ route('clients.show', [ $client->slug ]) }}" class="btn btn-info">View</a>
  <a href="{{ route('clients.edit', [ $client->id ]) }}" class="btn btn-sm btn-primary">Edit</a>
  <form method="post" action="{{ route('clients.destroy', [ $client->id ]) }}">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete the client {{ $client->name }} from the database?')">Delete</button>
  </form>  
  </td>    
</tr>
@endforeach

</tbody>
</table>
</x-layouts.porto>