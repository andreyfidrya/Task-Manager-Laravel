<x-layouts.porto title="Tasks" header="Tasks" username={{$username}}>
  <form action="{{url('/tm/ajaxupload')}}" method="POST" id="addpost">
    @csrf
    <input class="mb-3" type="text" name="spending" placeholder="Spendings">
    <input class="mb-3" type="float" name="amount" placeholder="Amount">
    <input class="mb-3" type="date" name="date" placeholder="Date">
    <input class="btn btn-success" type="submit" value="Add an Expense">  
  </form>
  
  <p>
  <a href="{{ route('tasks.create') }}" class="btn btn-success">Add a Task</a>
  <button class="btn btn-danger removeAll">Remove Selected Tasks</button>
  </p>

  <form method="get" action="">
    <label>Filter Statuses:</label>
    <select name="task_statuses">
    <option value="all_statuses">All statuses</option>
    @foreach($taskstatuses as $taskstatus)
      @if(isset($_GET['task_statuses'])) 
        <option value="{{ $taskstatus }}" {{ (  $_GET['task_statuses'] == $taskstatus ) ? 'selected' : ''}}>{{ $taskstatus }}</option>
      @else  
        <option value="{{ $taskstatus }}">{{ $taskstatus }}</option>  
      @endif
    @endforeach
    </select>
    <input type="submit" class="btn btn-info" name="apply_filter" value="Apply Filter">
    <input type="submit" class="btn btn-info" name="empty-filters" value="Empty Filter">
    <button class="btn btn-info updateStatus">Paid Status for Selected Tasks</button>            
  </form>

<table class="table">
<thead>
  <tr>
    <th scope="col"><input type="checkbox" id="checkboxesMain"></th>
    <th scope="col">Client Name</th>
    <th scope="col">Task</th>
    <th scope="col">Word Count</th>
    <th scope="col">Budget, $USD</th>
    <th scope="col">Vat, $USD</th>
    <th scope="col">Performance</th>
    <th scope="col">Due date</th>
    <th scope="col">Task Status</th>
    <th scope="col">User</th>
    <th scope="col">Action</th>       
  </tr>
</thead>
<tbody>

@foreach($tasks as $task)  
    
  @if(isset($_GET['task_statuses']) && $_GET['task_statuses'] !== 'all_statuses' && $_GET['task_statuses'] == $taskstatuses[$task->taskstatus] && isset($_GET['apply_filter']))  
  
    <tr id="sid{{$task->id}}">  
      <td><input type="checkbox" class="checkbox" data-id="{{$task->id}}" value="{{$task->budget}}" onclick="UpdateCost(this);"></td>
      <td><a href="{{ route('clients.show', [ $task->client->slug ]) }}">{{ $task->client->name }}</a></td>
      <td>{{ $task->task }}</td>
      <td>{{ $task->wordcount }}</td> 
      <td>{{ $task->budget }}</td>
      <td>{{ $task->vat }}</td>
      <td>{!! $task->performance !!}</td> 
      <td>{{ $task->duedate }}</td>       
      <td>{{ $taskstatuses[$task->taskstatus] }}</td>
      <td>{{ $task->user->name }}</td>   
      <td>
      <a href="{{ route('tasks.show', [ $task->id ]) }}" class="btn btn-info">View</a>
      <a href="{{ route('tasks.edit', [ $task->id ]) }}" class="btn btn-sm btn-primary">Edit</a>
      <form method="post" action="{{ route('tasks.destroy', [ $task->id ]) }}">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete the task from {{ $task->client->name }}')">Delete</button>
      </form>  
      </td>    
    </tr>  
    
  @endif
  
  @if(isset($_GET['task_statuses']) && $_GET['task_statuses'] === 'all_statuses' || !isset($_GET['task_statuses']))
    <tr id="tr_{{$task->id}}">
      <td><input type="checkbox" class="checkbox" value="{{$task->budget}}" data-id="{{$task->id}}" onclick="UpdateCost(this);"></td>
      <td><a href="{{ route('clients.show', [ $task->client->slug ]) }}">{{ $task->client->name }}</a></td>
      <td>{{ $task->task }}</td>
      <td>{{ $task->wordcount }}</td> 
      <td>{{ $task->budget }}</td>
      <td>{{ $task->vat }}</td>  
      <td>{!! $task->performance !!}</td> 
      <td>{{ $task->duedate }}</td>       
      <td>{{ $taskstatuses[$task->taskstatus] }}</td>
      <td>{{ $task->user->name }}</td>   
      <td>
      <a href="{{ route('tasks.show', [ $task->id ]) }}" class="btn btn-info">View</a>
      <a href="{{ route('tasks.edit', [ $task->id ]) }}" class="btn btn-sm btn-primary">Edit</a>
      <form method="post" action="{{ route('tasks.destroy', [ $task->id ]) }}">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete the task from {{ $task->client->name }}')">Delete</button>
      </form>  
      </td>    
    </tr>    
  @endif  

@endforeach

</tbody>
</table>

Total earnings: <input type="text" id="total" disabled="disabled"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-bootstrap/0.5pre/js/jquery-1.8.3.min.js" integrity="sha512-J9QfbPuFlqGD2CYVCa6zn8/7PEgZnGpM5qtFOBZgwujjDnG5w5Fjx46YzqvIh/ORstcj7luStvvIHkisQi5SKw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>  
  
  var total=0;  
  
  function UpdateCost(elem) {
 
    if (elem.checked == true) { 
		total += Number(elem.value); 
	  }else{
		total -=Number(elem.value);
	  }
 
	document.getElementById('total').value = total.toFixed(0);
  }

</script>

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
                alert("Choose min one task to remove.");
            } else {
                if (confirm("Do you want to remove selected tasks?")) {
                    var taskId = taskIdArr.join(",");
                    $.ajax({
                        url: "{{url('/tm/delete-all')}}",
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
        $('.updateStatus').on('click', function(e) {
            var taskIdArr = [];                                 
            $(".checkbox:checked").each(function() {
                taskIdArr.push($(this).attr('data-id'));                                 
            });
            if (taskIdArr.length <= 0) {
                alert("Choose min one task to update status.");
            } else {
                if (confirm("Do you want to update status for selected tasks?")) {
                    var taskId = taskIdArr.join(",");
                    $.ajax({
                        url: "{{url('/tm/update-status')}}",
                        type: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'ids=' + taskId, 
                        success: function(response) {
                          if (data['status'] == true) {                                
                                alert(data['message']);
                            } else {
                                alert('Error occured.');
                            }
                        },
                        error: function(response) {
                            alert('Not Updated, Try again.');
                        }
                    });
                }
            }
        });

    }); 
 </script>

<script type="text/javascript">

    $(document).ready(function()
        {
            
           $('#addpost').on('submit', function(event)        
            {

                event.preventDefault();

                jQuery.ajax({

                    url:"{{url('/tm/ajaxupload')}}",
                    data:jQuery('#addpost').serialize(),
                    type:'post',
                    
                    success:function(result)
                    {
                        jQuery('#addpost')[0].reset();
                    }

                })

            });

        }); 

</script>

</x-layouts.porto>