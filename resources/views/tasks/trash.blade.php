<x-layouts.porto title="Total Earnings per Month" header="Total Earnings per Month" username={{$username}}>

<p>
<button class="btn btn-danger removeAll">Remove Selected Tasks</button>
</p>

<table class="table">
  <thead>
    <tr>
      <th scope="col"><input type="checkbox" id="checkboxesMain"></th>
      <th scope="col">Client Name</th>
      <th scope="col">Task</th>
      <th scope="col">Budget, $USD</th>
      <th scope="col">Performance</th>
      <th scope="col">Due date</th>
      <th scope="col">User</th>  
      <th scope="col">Action</th>       
    </tr>
  </thead>
<tbody>
@foreach($performedtasks as $task)
<tr>
  <td><input type="checkbox" class="checkbox" data-id="{{$task->id}}" value="{{$task->budget}}" onclick="UpdateCost(this);"></td>
  <td><a href="{{ route('clients.show', [ $task->client->slug ]) }}">{{ $task->client->name }}</a></td>
  <td>{{ $task->task }}</td>
  <td>{{ $task->budget }}</td>  
  <td>{!! $task->performance !!}</td> 
  <td>{{ $task->duedate }}</td> 
  <td>{{ $task->user->name }}</td>  
  <td>
      <form method="post" onClick="return confirm('Do you want to remove the task from {{ $task->client->name }} forever?')" action="{{ route('removetaskforever', [ $task->id ]) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Удалить</button>
      </form>
      <form method="post" action="{{ route('restoretask', [ $task->id ]) }}">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-success">Восстановить</button>
      </form>
  </td>    
</tr>
@endforeach

</tbody>
</table>
Earnings per month: <strong>{{$sum}} USD</strong><br>
Spendings per month: <strong>{{ $sumspent }} USD</strong><br>
Total amount of vat per month: <strong>{{ $sumvat }} USD</strong><br>
<h2>Profits per month: <strong>{{ $sum - $sumspent - $sumvat }} USD</strong><br></h2> 
</x-layouts.porto>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-bootstrap/0.5pre/js/jquery-1.8.3.min.js" integrity="sha512-J9QfbPuFlqGD2CYVCa6zn8/7PEgZnGpM5qtFOBZgwujjDnG5w5Fjx46YzqvIh/ORstcj7luStvvIHkisQi5SKw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  $(function(e){
      $("#checkboxesMain").click(function(){
        $('.checkboxesMain').prop('checked', $(this).prop('checked'));
      });      
  });
</script>

<script type = "text/javascript" >
    $(document).ready(function() {
        $('#checkboxesMain').on('click', function(e) {
            if ($(this).is(':checked', true)) {
                $(".checkbox").prop('checked', true);
            } else {
                $(".checkbox").prop('checked', false);
            }
        });
        $('.checkbox').on('click', function() {
            if ($('.checkbox:checked').length == $('.checkbox').length) {
                $('#checkboxesMain').prop('checked', true);
            } else {
                $('#checkboxesMain').prop('checked', false);
            }
        });
        $('.removeAll').on('click', function(e) {
            var taskIdArr = [];
            $(".checkbox:checked").each(function() {
                taskIdArr.push($(this).attr('data-id'));
            });
            if (taskIdArr.length <= 0) {
                alert("Choose min one item to remove.");
            } else {
                if (confirm("Are you sure?")) {
                    var taskId = taskIdArr.join(",");
                    $.ajax({
                        url: "{{url('/tm/delete-all-forever')}}",
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'ids=' + taskId,
                        success: function(data) {
                            if (data['status'] == true) {
                                $(".checkbox:checked").each(function() {
                                    $(this).parents("tr").remove();
                                });
                                alert(data['message']);
                            } else {
                                alert('Error occured.');
                            }
                        },
                        error: function(data) {
                            alert(data.responseText);
                        }
                    });
                }
            }
        });
    }); 
 </script>