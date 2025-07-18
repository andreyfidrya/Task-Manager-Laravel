<x-layouts.porto title="Users" header="Users" username={{$username}}>

    <p>
    <a href="{{ route('users.create') }}" class="btn btn-success">Add a User</a>
    </p>

    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>About</th>
                <th>Address</th>
                <th>Address 2</th>
                <th>City</th>
                <th>State</th>
                <th>Zip</th>
                <th>Actions</th>
            </tr>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->about }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->address2 }}</td>
                <td>{{ $user->city }}</td>
                <td>{{ $user->state }}</td>
                <td>{{ $user->zip }}</td>
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