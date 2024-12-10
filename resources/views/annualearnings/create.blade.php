<x-layouts.porto title="Add a New Monthly Earning" header="Add a New Monthly Earning" username={{$username}}>
    <x-form method="post" action="{{ route('annualearnings.store') }}">
    @include('annualearnings.form-fields')   
      <button class="btn btn-primary">Add a New Monthly Earning</button>
    </x-form>
<b><a href="{{ route('annualearnings.index') }}">Go back to Annual Earnings by Months Page</a></b>
</x-layouts.porto>