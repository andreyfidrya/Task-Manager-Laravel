<x-layouts.porto title="Create an Earning" 
header="Create an Earning" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
    <x-form method="post" action="{{ route('annualearnings.store') }}" enctype="multipart/form-data">
    @include('annualearnings.form-fields')   
      <button class="btn btn-primary">Add a New Monthly Earning</button>
    </x-form>
<b><a href="{{ route('annualearnings.index') }}">Go back to Annual Earnings by Months Page</a></b>
</x-layouts.porto>