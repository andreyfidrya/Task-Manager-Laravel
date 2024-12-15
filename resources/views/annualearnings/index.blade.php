<x-layouts.porto title="Annual Earnings by Months" header="Annual Earnings by Months" username={{$username}}>
<p>
<a href="{{ route('annualearnings.create') }}" class="btn btn-success">Add Monthly Earnings</a>
<button class="btn btn-danger removeAll">Remove Selected Monthly Earnings</button>
</p>
    <div class="chart-data-selector" id="salesSelectorWrapper">
			<h2>
			Earnings by Months:					
			</h2>
					<div style="width: 700px;">
  					<canvas id="myChart"></canvas>
					</div>
					<script>
					
					const labels = <?php echo json_encode($month) ?>;
					const data = {
						labels: labels,
						datasets: [{
						label: 'My First Dataset',
						data: <?php echo json_encode($amount) ?>,
						backgroundColor: [
							'rgba(255, 99, 132, 0.2)',
							'rgba(255, 159, 64, 0.2)',
							'rgba(255, 205, 86, 0.2)',
							'rgba(75, 192, 192, 0.2)',
							'rgba(54, 162, 235, 0.2)',
							'rgba(153, 102, 255, 0.2)',
							'rgba(201, 203, 207, 0.2)'
						],
						borderColor: [
							'rgb(255, 99, 132)',
							'rgb(255, 159, 64)',
							'rgb(255, 205, 86)',
							'rgb(75, 192, 192)',
							'rgb(54, 162, 235)',
							'rgb(153, 102, 255)',
							'rgb(201, 203, 207)'
						],
						borderWidth: 1
						}]
					};

					const config = {
						type: 'bar',
						data: data,
						options: {
						scales: {
							y: {
							beginAtZero: true
							}
						}
						},
					};

					var myChart = new Chart(
						document.getElementById('myChart'),
						config
					);	

						/*var flotDashSales1Data = [{
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
						}];*/
						// See: js/examples/examples.dashboard.js for more settings.
					</script>				
				
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