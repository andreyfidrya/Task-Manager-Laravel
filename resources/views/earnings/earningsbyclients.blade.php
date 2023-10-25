<x-layouts.porto title="Earnings by Clients per Month" header="Earnings by Clients per Month">
@foreach($clients as $client)

    <strong>{{$client->name}}</strong><br>

        @foreach($client->tasks()->onlyTrashed()->get() as $task)
            {{ $task->task }}<br>
        @endforeach

@endforeach
</x-layouts.porto>