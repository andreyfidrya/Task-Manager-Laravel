<x-layouts.porto title="Annual Earnings by Months" header="Annual Earnings by Months" username={{$username}}>
<p>
<a href="{{ route('annualearnings.create') }}" class="btn btn-success">Add Monthly Earnings</a>
<button class="btn btn-danger removeAll">Remove Selected Monthly Earnings</button>
</p>
<div class="chart-data-selector" id="salesSelectorWrapper">
			<h2>
				Anual Earnings:					
			</h2>
      <div id="salesSelectorItems" class="chart-data-selector-items mt-3">
				<!-- Flot: Sales Porto Admin -->
				<div class="chart chart-sm" data-sales-rel="Porto Admin" id="flotDashSales1" class="chart-active" style="height: 203px;"></div>
					<script>
						
						var flotDashSales1Data = [{
							data: [							
							["January", 600],
							["February", 740],
							["March", 570],
							["April", 800],
							["May", 880],
							["June", 620],
							["Jule", 770],
							["August", 860],
                          	["September", 900],
                          	["October", 1010],
                          	["November", 1100],
                          	["December", 1200]                          
								],
							color: "#0088cc"
						}];
						// See: js/examples/examples.dashboard.js for more settings.
					</script>		
				</div>						
			</div>
				
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
<tbody>
@foreach($annualearnings as $annualearning)
<tr>  
  <td><input type="checkbox" class="checkbox" data-id="{{$annualearning->id}}"></td>
  <td>{{ $annualearning->month }}</td> 
  <td>{{ $annualearning->amount }}</td>   
  <td>
    <a href="{{ route('annualearnings.edit', [ $annualearning->id ]) }}" class="btn btn-sm btn-primary">Edit</a>
    <form method="post" action="{{ route('annualearnings.destroy', [ $annualearning->id ]) }}">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete {{ $annualearning->month }} from anual earnings')">Delete</button>
    </form>
  </td>    
</tr>
@endforeach

</tbody>
</table>