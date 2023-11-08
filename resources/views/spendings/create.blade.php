<x-layouts.porto title="Add an Expense" header="Add an Expense">

    <form method="post" action="{{ route('spendings.store') }}">
        @include('spendings.form-fields')   
    <button class="btn btn-primary">Add an Expense</button>
    </form>
    <b><a href="#">Go back to Expenses Page</a></b>

</x-layouts.porto>