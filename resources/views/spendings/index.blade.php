<x-layouts.porto title="Total Spendings per Month" header="Total Spendings per Month" username={{$username}}>

<form action="{{url('/tm/ajaxupload')}}" method="POST" id="addpost">
  @csrf
  <input class="mb-3" type="text" name="spending" placeholder="Spendings">
  <input class="mb-3" type="float" name="amount" placeholder="Amount">
  <input class="mb-3" type="date" name="date" placeholder="Date">
  <input class="btn btn-success" type="submit" value="Add">  
</form>

<p>
<a href="{{ route('spendings.create') }}" class="btn btn-success">Add an Expense</a>
<button class="btn btn-danger removeAll">Remove Selected Expenses</button>
</p>
<table class="table">
<thead>
<tr>
  <th scope="col"><input type="checkbox" id="checkboxesMain"></th>
  <th scope="col">Spendings</th>
  <th scope="col">Amount, $USD</th> 
  <th scope="col">Date</th> 
  <th scope="col">Action</th>       
</tr>
</thead>
<tbody>
@foreach($spendings as $expense)
<tr>  
  <td><input type="checkbox" class="checkbox" data-id="{{$expense->id}}"></td>
  <td>{{ $expense->spending }}</td> 
  <td>{{ $expense->amount }}</td> 
  <td>{{ $expense->date }}</td> 
  <td>
    <a href="{{ route('spendings.edit', [ $expense->id ]) }}" class="btn btn-sm btn-primary">Edit</a>
    <form method="post" action="{{ route('spendings.destroy', [ $expense->id ]) }}">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger" onClick="return confirm('Do you really want to delete {{ $expense->spending }} from expenses')">Delete</button>
    </form>
  </td>    
</tr>
@endforeach

</tbody>
</table>
Spendings per month: <strong>{{ $sumspent }} USD</strong><br>
Total amount of vat per month: <strong>{{ $sumvat }} USD</strong><br>
<h2>Total spendings per month: <strong>{{ $totalspendings }} USD</strong><br></h2>
</x-layouts.porto>

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
                        url: "{{url('/tm/delete-all-spendings')}}",
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