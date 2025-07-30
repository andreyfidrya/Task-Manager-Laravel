<x-layouts.porto title="Notifications" 
header="Notifications" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
@bind($expense)
    <x-form method="post" action="{{ route('spendings.update', [ $expense->id ]) }}">
        @method('PUT')
        @include('spendings.form-fields')   
      <button class="btn btn-primary">Update an Expense</button>
    </x-form>
@endbind
<b><a href="{{ route('spendings.index') }}">Go back to Spendings Page</a></b>
</x-layouts.porto>