<x-layouts.porto title="Notifications" 
header="Notifications" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
@bind($annualearning)
    <x-form method="post" action="{{ route('annualearnings.update', [ $annualearning->id ]) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('annualearnings.form-fields')   
      <button class="btn btn-primary">Update an Expense</button>
    </x-form>
@endbind
<b><a href="{{ route('annualearnings.index') }}">Go back to Spendings Page</a></b>
</x-layouts.porto>