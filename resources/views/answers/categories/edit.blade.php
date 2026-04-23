<x-layouts.porto title="Edit a category" 
header="Edit a category" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
  @bind($category)
    <x-form method="post" action="{{ route('categories.update', [ $category->id ]) }}">
        @method('PUT')
        @include('answers.categories.form-fields')   
      <button class="btn btn-primary">Update a Category</button>
    </x-form>
  @endbind
<b><a href="{{ route('categories.index') }}">Go back to Categories Page</a></b>
</x-layouts.porto>