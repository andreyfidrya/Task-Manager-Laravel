<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="my2.css">
    <script src="https://kit.fontawesome.com/a561d3a912.js" crossorigin="anonymous"></script>
    <title>Task Manager</title>
       
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>


<h1>Edit a Task</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

<form method="post" action="{{ route('tasks.update', [ $task->id ]) }}">
@csrf
@method('PUT')
  <div class="mb-3">
    <label>Client Name</label>
    <input type="text" class="form-control" name="clientname" value="{{ old('clientname') ?? $task->clientname }}">
    @error('clientname')<div class="alert alert-danger">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3">
    <label>Task</label>
    <input type="text" class="form-control" name="task" value="{{ old('task') ?? $task->task }}">
    @error('task')<div class="alert alert-danger">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3">
    <label>Budget</label>
    <input type="text" class="form-control" name="budget" value="{{ old('budget') ?? $task->budget }}">
  </div>
  <div class="mb-3">
    <label for="editor">Performance</label>
    <textarea class="form-control" id="editor" name="performance">{{ old('performance') ?? $task->performance }}</textarea>
  </div>
  <div class="mb-3">
    <label>Due date</label>
    <input type="date" class="form-control" name="duedate" value="{{ old('duedate') ?? $task->duedate }}">
  </div>
  
  <select name="author" class="form-select mb-2" aria-label="Default select example">
  <option selected>{{ old('author') ?? $task->author }}</option>
  <option>Andrey</option>
  <option>Elena</option>
  </select>  
  
  <button class="btn btn-primary">Edit a Task</button>

</form>
<b><a href="{{ route('tasks.index') }}">Go back to HomePage</a></b>
<script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>

</body>
</html>

