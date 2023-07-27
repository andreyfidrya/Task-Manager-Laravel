<x-layouts.porto title="Search" header="Search">

  @if($topics->isNotEmpty())
  <table class="table">  
  <thead>
    <tr>
      <th scope="col">Slug</th>
      <th scope="col">Name</th>
      <th scope="col">Action</th>             
    </tr>
  </thead>
  <tbody>
  
  @foreach($topics as $topic) 
<tr>
      <td>{{ $topic->slug }}</td>
      <td>{{ $topic->name }}</td>      
      <td>
      <a href="{{ route('topics.show', [ $topic->slug ]) }}" class="btn btn-info">View</a>
      <a href="{{ route('topics.edit', [ $topic->id ]) }}" class="btn btn-sm btn-primary">Edit</a>
      <form method="post" action="{{ route('topics.destroy', [ $topic->id ]) }}">
          @csrf
          @method('DELETE')
          <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete the {{ $topic->name }} topic')">Delete</button>
      </form>
      </td>     
</tr>
@endforeach
@else 
    <div>
        <h2>No topics have been found</h2>
    </div>
@endif
<hr>

@if($samples->isNotEmpty())
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
@else 
    <div>
        <h2>No samples have been found</h2>
    </div>
@endif
</x-layouts.porto>