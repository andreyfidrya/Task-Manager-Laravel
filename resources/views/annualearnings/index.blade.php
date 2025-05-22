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
				<!-- Flot: Bars -->
										<div class="chart chart-md" id="flotBars"></div>
										<script type="text/javascript">
											var annualEarningsData = @json($annualearningsJSON);

											var flotBarsData = [
												["January", annualEarningsData["January"] ?? 0],
												["February", annualEarningsData["February"] ?? 0],
												["March", annualEarningsData["March"] ?? 0],
												["April", annualEarningsData["April"] ?? 0],
												["May", annualEarningsData["May"] ?? 0],
												["June", annualEarningsData["June"] ?? 0],
												["July", annualEarningsData["July"] ?? 0],
												["August", annualEarningsData["August"] ?? 0],
												["September", annualEarningsData["September"] ?? 0],
												["October", annualEarningsData["October"] ?? 0],
												["November", annualEarningsData["November"] ?? 0],
												["December", annualEarningsData["December"] ?? 0]
											];

											// See: js/examples/examples.charts.js for more settings.

										</script>
									
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

