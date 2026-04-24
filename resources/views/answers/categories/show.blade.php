<x-layouts.porto title="View a category" 
header="View a category" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

<b>Category Name: </b>{{ $category->name }}
<hr>
@if($category->scripts->isEmpty())
    <p>No scripts in this category.</p>
@else
    <ul>
        @foreach($category->scripts as $script)
            <li>
                <b>{{ $script->name }}</b>
                <br>                
            </li>
        @endforeach
    </ul>
@endif
<hr>
<a href="" class="btn btn-sm btn-primary">Edit</a>
  <form method="post" action="">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete the category?')">Delete</button>
  </form>
<b><a href="{{ route('categories.index') }}">Go back to Categories Page</a></b>
</x-layouts.porto>
