<x-layouts.porto title="All Users" 
header="All Users" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

    <p>
    <a href="{{ route('users.create') }}" class="btn btn-success">Add a User</a>
    </p>

    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>                
            </tr>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>                
                <td>
                <a href="route('users.show', [ $user->id ])" class="btn btn-info">View</a>
                <a href="{{ route('users.edit', [ $user->id ]) }}" class="btn btn-sm btn-primary">Edit</a>
                <form method="post" action="{{ route('users.destroy', [ $user->id ]) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete {{ $user->name }}')">Delete</button>
                </form>  
                </td>                
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layouts.porto>