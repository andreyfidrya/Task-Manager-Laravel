<x-layouts.porto title="Categories" 
header="Categories" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

  <p>
    <a href="{{ route('categories.create') }}" class="btn btn-success">Add a Category</a>
  </p> 
  <table class="table">
  <thead>
    <tr>
      <th scope="col" class="text-center">Name</th>
      <th scope="col" class="text-center">Slug</th>
      <th scope="col" class="text-center">Priority</th>
      <th scope="col" class="text-center">Before Main Text</th>
      <th scope="col" class="text-center">Action</th>             
    </tr>
  </thead>
  <tbody>
    @foreach($categories as $category)
        <tr>
            <td class="text-center">{{ $category->name }}</td>
            <td class="text-center">{{ $category->slug }}</td>
            <td class="text-center">{{ $category->priority }}</td>
            <td class="text-center">{{ $category->beforemaintext }}</td>
            <td class="text-center">
                <a href="#" class="btn btn-info">View</a>
                <a href="{{ route('categories.edit', [ $category->id ]) }}" class="btn btn-primary btn-sm">Edit</a>
                <a href="#" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
    @endforeach
  </tbody>
</table>

</x-layouts.porto>