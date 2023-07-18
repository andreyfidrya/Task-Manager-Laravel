<x-layouts.porto title="Topics" header="Topics">

  <p>
    <a href="{{ route('topics.create') }}" class="btn btn-success">Add a Topic</a>
  </p> 
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Slug</th>
      <th scope="col">Name</th>             
    </tr>
  </thead>
  <tbody>

@foreach($topics as $topic)  
<tr>
      <td>{{ $topic->slug }}</td>
      <td>{{ $topic->name }}</td>      
      <td>
      <a href="{{ route('topics.edit', [ $topic->id ]) }}" class="btn btn-sm btn-primary">Edit</a>
      <form method="post" action="{{ route('topics.destroy', [ $topic->id ]) }}">
          @csrf
          @method('DELETE')
          <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete the {{ $payment->payment }} payment')">Delete</button>
      </form>
      </td>     
</tr>
@endforeach
  
</tbody>
</table>  

</x-layouts.porto>