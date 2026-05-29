<x-layouts.porto title="Scripts" 
header="Scripts" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

  <p>
    <a href="" class="btn btn-success">Add a Script</a>
  </p>
  <h1>Scripts by Categories</h1>
  
  @foreach($categories as $category)

    <h2>{{ $category->name }}</h2>

    @if($category->scripts->count())

        <ul class="list-group mb-4">
            @foreach($category->scripts as $script)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $script->name }}</span>
                    <div class="d-flex gap-2">

                        {{-- Edit --}}
                        <a 
                            href="{{ route('scripts.edit', $script->id) }}" 
                            class="btn btn-primary btn-sm"
                        >
                            Edit
                        </a>

                        {{-- Delete --}}
                        <form 
                            action="{{ route('scripts.destroy', $script->id) }}" 
                            method="POST"
                        >
                            @csrf
                            @method('DELETE')

                            <button 
                                type="submit" 
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete this script?')"
                            >
                                Delete
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else

        <p>No scripts in this category.</p>

    @endif

  @endforeach
  
</x-layouts.porto>