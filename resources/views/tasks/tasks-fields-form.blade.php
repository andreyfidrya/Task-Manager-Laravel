@csrf
  <div class="mb-3">
    <x-controls.input name="clientname" label="Client Name"/>
  </div>
  <div class="mb-3">
    <x-controls.input name="task" label="Task"/>
  </div>
  <div class="mb-3">
    <x-controls.input name="budget" label="Budget"/>
  </div>
  <div class="mb-3">
    <label for="editor">Performance</label>
    <textarea class="form-control" id="myEditor" name="performance"></textarea>
  </div>
  <div class="mb-3">
    <x-controls.input type="date" name="duedate" label="Due date"/>
  </div>
  
  <select name="author" class="form-select mb-2" aria-label="Default select example">
  <option selected>Select an author:</option>
  <option>Andrey</option>
  <option>Elena</option>
  </select> 