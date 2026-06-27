<x-layouts.porto title="Search" 
header="Search" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

    @if($responses->isNotEmpty())
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>             
            </tr>
        </thead>
        <tbody>

        @foreach($responses as $response)  
        <tr>
            <td>{{ $response->title }}</td>
            <td>{!! $response->description !!}</td>      
            <td>
            <a href="{{ route('responses.show', [ $response->id ]) }}" class="btn btn-info">View</a>
            <a href="{{ route('responses.edit', [ $response->id ]) }}" class="btn btn-sm btn-primary">Edit</a>
            <form method="post" action="{{ route('responses.destroy', [ $response->id ]) }}">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete the {{ $response->title }} response')">Delete</button>
            </form>
            </td>     
        </tr>
        @endforeach
        
        </tbody>
    </table>
    @else 
    <div>
        <h3>No responses have been found</h3>
    </div>
    @endif

</x-layouts.porto>
