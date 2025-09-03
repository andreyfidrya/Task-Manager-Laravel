<x-layouts.porto title="Notifications" 
header="Notifications" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
  <p>
    <a href="{{ route('notifications.create') }}" class="btn btn-success">Add a Notification</a>
    <button class="btn btn-danger removeAll">Remove Selected Notifications</button>
  </p>
  <table class="table">
  <thead>
    <tr>
      <th scope="col"><input type="checkbox" id="checkboxesMain"></th>        
      <th scope="col">User</th>
      <th scope="col">Text</th>
      <th scope="col">Date</th>
      <th scope="col">Is Read</th>
      <th scope="col">Action</th>       
    </tr>
  </thead>
  <tbody>

    @foreach($notifications as $notification)  
    <tr id="sid{{$notification->id}}">
        <td><input type="checkbox" class="checkbox" data-id="{{$notification->id}}"></td>        
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

<script type = "text/javascript" >
    $(document).ready(function() {
        $('#checkboxesMain').on('click', function(e) {
            if ($(this).is(':checked', true)) {
                $(".checkbox").prop('checked', true);
            } else {
                $(".checkbox").prop('checked', false);
            }
        });
        $('.checkbox').on('click', function() {
            if ($('.checkbox:checked').length == $('.checkbox').length) {
                $('#checkboxesMain').prop('checked', true);
            } else {
                $('#checkboxesMain').prop('checked', false);
            }
        });
        $('.removeAll').on('click', function(e) {
            var notificationIdArr = [];
            $(".checkbox:checked").each(function() {
                notificationIdArr.push($(this).attr('data-id'));
            });
            if (notificationIdArr.length <= 0) {
                alert("Choose min one task to remove.");
            } else {
                if (confirm("Do you want to remove selected notifications?")) {
                    var notificationId = notificationIdArr.join(",");
                    $.ajax({
                        url: "{{url('/delete-all-notifications')}}",
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'ids=' + notificationId,
                        success: function(data) {
                            if (data['status'] == true) {
                                $(".checkbox:checked").each(function() {
                                    $(this).parents("tr").remove();
                                });
                                alert(data['message']);
                            } else {
                                alert('Error occured.');
                            }
                        },
                        error: function(data) {
                            alert(data.responseText);
                        }
                    });
                }
            }
        });
    }); 
</script>
