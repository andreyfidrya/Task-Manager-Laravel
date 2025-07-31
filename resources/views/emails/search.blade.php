<x-layouts.porto title="Search" 
header="Search" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <style>
			
			.ui-front { z-index: 9999; }			
			
		</style>

  @if($topics->isNotEmpty())
  <b><h1>Topics:</h1></b>  
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
</tbody>
</table>
@else 
    <div>
        <h3>No topics have been found</h3>
    </div>
@endif
<hr>
@if($samples->isNotEmpty())
<b><h1>Samples:</h1></b>
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
        <h3>No samples have been found</h3>
    </div>
@endif
</x-layouts.porto>