<x-layouts.porto title="Search for responses" 
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
            <button
            type="button"
            class="btn btn-success copy-answer"
            data-answer="{{ strip_tags($response->description) }}"
            >
                Copy
            </button>
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

    <script>
        document.querySelectorAll('.copy-answer').forEach(button => {

            button.addEventListener('click', function () {

                const answer = this.dataset.answer;

                navigator.clipboard.writeText(answer).then(() => {

                    this.textContent = 'Copied!';

                    setTimeout(() => {
                        this.textContent = 'Copy';
                    }, 1500);

                });

            });

        });
    </script>

</x-layouts.porto>
