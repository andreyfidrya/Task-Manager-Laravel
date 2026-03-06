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
      <th scope="col">Name</th>
      <th scope="col">Action</th>             
    </tr>
  </thead>
  <tbody>

</tbody>
</table>

</x-layouts.porto>