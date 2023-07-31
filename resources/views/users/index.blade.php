<x-layouts.porto title="Users" header="Users">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Actions</th>
            </tr>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->password }}</td>
                <td>
                    <a href=""></a>        
                </td>                
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layouts.porto>