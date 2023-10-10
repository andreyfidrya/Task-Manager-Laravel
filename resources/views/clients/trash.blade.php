<x-layouts.porto title="Inactive Clients" header="Inactive Clients">

<table class="table">
<thead>
<tr>
  <th scope="col">Client Name</th>
  <th scope="col">Client Slug</th>
  <th scope="col">Client Info</th>
  <th scope="col">Action</th> 
</tr>
</thead>
<tbody>
@foreach($inactiveclients as $client)
<tr>
  <td>{{ $client->name }}</td>
  <td>{{ $client->slug }}</td> 
  <td>{!! $client->info !!}</td>  
<td>
  <a href="{{ route('clients.show', [ $client->slug ]) }}" class="btn btn-info">View</a>
  <a href="{{ route('clients.edit', [ $client->id ]) }}" class="btn btn-sm btn-primary">Edit</a>    
  </td>    
</tr>
@endforeach

</tbody>
</table>
</x-layouts.porto>