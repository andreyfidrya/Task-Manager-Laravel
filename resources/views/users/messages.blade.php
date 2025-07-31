<x-layouts.porto title="Messages" 
header="Messages" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>User</th>
                <th>Message</th>
                <th>Action</th>                
            </tr>
            @foreach($chats as $chat)
            <tr>
                <td>{{ optional($chat->user)->name }}</td>
                <td>{{ $chat->message }}</td>                
                <td>                
                <form method="post" action="{{ route('messages.delete', [ $chat->id ]) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete this message?')">Delete</button>
                </form>  
                </td>                
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layouts.porto>