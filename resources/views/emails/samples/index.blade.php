<x-layouts.porto title="Samples" header="Samples">

  <p>
    <a href="{{ route('samples.create') }}" class="btn btn-success">Add a Sample</a>
  </p> 
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Url</th>
      <th scope="col">Title</th>             
    </tr>
  </thead>
  <tbody>

@foreach($samples as $sample)  
<tr>
      <td><a class="nav-link" href="{{ $sample->url }}">{{ $sample->url }}</a></td>
      <td>{{ $sample->title }}</td>      
      <td>
      <a href="{{ route('samples.edit', [ $sample->id ]) }}" class="btn btn-sm btn-primary">Edit</a>
      <form method="post" action="{{ route('samples.destroy', [ $sample->id ]) }}">
          @csrf
          @method('DELETE')
          <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete the {{ $sample->title }} sample')">Delete</button>
      </form>
      </td>     
</tr>
@endforeach
  
</tbody>
</table>  

</x-layouts.porto>