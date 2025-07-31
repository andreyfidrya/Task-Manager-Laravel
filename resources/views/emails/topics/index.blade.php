<x-layouts.porto title="Topics" 
header="Topics" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

  <p>
    <a href="{{ route('topics.create') }}" class="btn btn-success">Add a Topic</a>
  </p> 
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

<div class="mt-3">
  {{ $topics->links() }}
</div>

</x-layouts.porto>