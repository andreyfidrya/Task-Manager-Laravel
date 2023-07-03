<x-layouts.base title="View a Client" header="View a Client">

<b>Client Name: </b>{{ $client->clientname }}
<hr>
<b>Client Info: </b>{{ $client->clientinfo }}<br>

<b><a href="{{ route('clients.index') }}">Go back to Clients Page</a></b>
</x-layouts.base>