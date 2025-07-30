<x-layouts.porto title="Notifications" 
header="Notifications" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
  <p>
    <a href="{{ route('notifications.create') }}" class="btn btn-success">Add a Notification</a>
  </p>
  <table class="table">
  <thead>
    <tr>      
      <th scope="col">User</th>
      <th scope="col">Text</th>
      <th scope="col">Date</th>
      <th scope="col">Is Read</th>
      <th scope="col">Action</th>       
    </tr>
  </thead>
  <tbody>

    @foreach($notifications as $notification)  
    <tr>
        <td>{{ optional($notification->user)->name }}</td>
        <td>{{ $notification->text }}</td>
        <td>{{ $notification->date }}</td>
        @if($notification->is_read)
        <td>Yes</td>@else<td>No</td>
        @endif()
        <td>
        <a href="{{ route('notifications.edit', $notification->id) }}" class="btn btn-sm btn-primary">Edit</a>
          <form method="post" action="{{ route('notifications.destroy', [ $notification->id ]) }}">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete the notification?')">Delete</button>
          </form>
        </td>     
    </tr>
    @endforeach

</tbody>
</table>
</x-layouts.porto>
