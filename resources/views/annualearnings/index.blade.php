<x-layouts.porto title="Annual Earnings by Months" header="Annual Earnings by Months" username={{$username}}>
<p>
<a href="{{ route('annualearnings.create') }}" class="btn btn-success">Add Monthly Earnings</a>
<button class="btn btn-danger removeAll">Remove Selected Monthly Earnings</button>
</p>
<table class="table">
<thead>
<tr>
  <th scope="col"><input type="checkbox" id="checkboxesMain"></th>
  <th scope="col">Month</th>
  <th scope="col">Amount, $USD</th> 
  <th scope="col">Action</th>       
</tr>
</thead>
</x-layouts.porto>