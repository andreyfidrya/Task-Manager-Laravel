<x-layouts.porto title="Workload per user per week" header="Workload per user per week" username={{$username}}>
@foreach($users as $user)
<h3>{{$user->name}} has written <strong> {{ $user->tasks()->onlyTrashed()->whereBetween('deleted_at', [$weekStartDate, $weekEndDate])->sum('wordcount'); }} words per week</h3></strong>
@endforeach
</x-layouts.porto>