<x-layouts.porto title="Annual Earnings by Months" header="Annual Earnings by Months" username={{$username}}>

<div class="chart-data-selector" id="salesSelectorWrapper">
			<h2>
				Total Anual Earnings by Months:					
			</h2>
        <div id="salesSelectorItems" class="chart-data-selector-items mt-3">
			<!-- Flot: Bars -->
			<div class="chart chart-md" id="flotBars"></div>
			<script type="text/javascript">
				var annualEarningsData = @json($annualearningsT);

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
			<h2>
				Anual Earnings by Users by Months:					
			</h2>
			<!-- Morris: Bar -->
			<div class="chart chart-md" id="morrisBar"></div>
			<script type="text/javascript">
				var annualEarningsAData = @json($annualearningsA);
				var annualEarningsEData = @json($annualearningsE);

				var morrisBarData = [{
						y: 'Jan',
						a: annualEarningsAData["January"] ?? 0,
						b: annualEarningsEData["January"] ?? 0
					}, {
						y: 'Feb',
						a: annualEarningsAData["February"] ?? 0,
						b: annualEarningsEData["February"] ?? 0
					}, {
						y: 'Mar',
						a: annualEarningsAData["March"] ?? 0,
						b: annualEarningsEData["March"] ?? 0
					}, {
						y: 'Apr',
						a: annualEarningsAData["April"] ?? 0,
						b: annualEarningsEData["April"] ?? 0
					}, {
						y: 'May',
						a: annualEarningsAData["May"] ?? 0,
						b: annualEarningsEData["May"] ?? 0
					}, {
						y: 'Jun',
						a: annualEarningsAData["June"] ?? 0,
						b: annualEarningsEData["June"] ?? 0
					}, {
						y: 'Jul',
						a: annualEarningsAData["July"] ?? 0,
						b: annualEarningsEData["July"] ?? 0
					}, {
						y: 'Aug',
						a: annualEarningsAData["August"] ?? 0,
						b: annualEarningsEData["August"] ?? 0
					}, {
						y: 'Sep',
						a: annualEarningsAData["September"] ?? 0,
						b: annualEarningsEData["September"] ?? 0
					}, {
						y: 'Oct',
						a: annualEarningsAData["October"] ?? 0,
						b: annualEarningsEData["October"] ?? 0
					}, {
						y: 'Nov',
						a: annualEarningsAData["November"] ?? 0,
						b: annualEarningsEData["November"] ?? 0
					},{
						y: 'Dec',
						a: annualEarningsAData["December"] ?? 0,
						b: annualEarningsEData["December"] ?? 0
					}];

					// See: js/examples/examples.charts.js for more settings.

				</script>									
		</div>
<p>
<a href="{{ route('annualearnings.create') }}" class="btn btn-success">Add Monthly Earnings</a>
<button class="btn btn-danger removeAll">Remove Selected Monthly Earnings</button>
</p>				
<table class="table">
<thead>
<tr>
  <th scope="col"><input type="checkbox" id="checkboxesMain"></th>
  <th scope="col">Month</th>
  <th scope="col">Andrey</th>
  <th scope="col">Elena</th>
  <th scope="col">Total Amount, $USD</th> 
  <th scope="col">Action</th>       
</tr>
</thead>
</x-layouts.porto>
<tbody>
@foreach($annualearnings as $annualearning)
<tr>  
  <td><input type="checkbox" class="checkbox" data-id="{{$annualearning->id}}"></td>
  <td>{{ $annualearning->month }}</td>
  <td>{{ $annualearning->andrey }}</td>
  <td>{{ $annualearning->elena }}</td> 
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

