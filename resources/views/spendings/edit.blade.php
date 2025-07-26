<x-layouts.porto title="Expenses" header="Edit an Expense" username={{$username}} profile_image={{$profile_image}}>
@bind($expense)
    <x-form method="post" action="{{ route('spendings.update', [ $expense->id ]) }}">
        @method('PUT')
        @include('spendings.form-fields')   
      <button class="btn btn-primary">Update an Expense</button>
    </x-form>
@endbind
<b><a href="{{ route('spendings.index') }}">Go back to Spendings Page</a></b>
</x-layouts.porto>