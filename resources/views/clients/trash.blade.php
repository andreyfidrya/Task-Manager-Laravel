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
      <form method="post" onClick="return confirm('Вы действительно хотите удалить товар: {{$client->name}} навсегда?')" action="{{ route('removeclientforever', [ $client->id ]) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Удалить</button>
      </form>
      <form method="post" action="{{ route('restoreclient', [ $client->id ]) }}">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-success">Восстановить</button>
      </form>
  </td>    
</tr>
@endforeach

</tbody>
</table>
</x-layouts.porto>