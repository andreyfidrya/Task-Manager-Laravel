<x-layouts.porto title="Add a New User" header="Add a New User" username={{$username}}>
    <x-form method="post" action="{{ route('users.store') }}">
    @include('users.form-fields')   
      <button class="btn btn-primary">Add a User</button>
    </x-form>
<b><a href="{{ route('users.index') }}">Go back to Users Page</a></b>
</x-layouts.porto>