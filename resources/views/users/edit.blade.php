<x-layouts.porto title="Edit a User" header="Edit an User" username={{$username}} profile_image={{$profile_image}}>
@bind($user)
    <x-form method="post" action="{{ route('users.update', [ $user->id ]) }}">
    @method('PUT')
    @include('users.form-fields2')   
      <button class="btn btn-primary">Update a User</button>
    </x-form>
<b><a href="{{ route('users.index') }}">Go back to Users Page</a></b>
</x-layouts.porto>