<x-layouts.porto title="Create a Spending" 
header="Create a Spending" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

    <form method="post" action="{{ route('spendings.store') }}">
        @include('spendings.form-fields')   
    <button class="btn btn-primary">Add an Expense</button>
    </form>
    <b><a href="#">Go back to Expenses Page</a></b>

</x-layouts.porto>