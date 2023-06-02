@csrf
  <div class="mb-3">
    <x-controls.input name="clientname" label="Client Name" :item="$task ?? null"/>
  </div>
  <div class="mb-3">
    <x-controls.input name="task" label="Task" :item="$task ?? null"/>
  </div>
  <div class="mb-3">
    <x-controls.input name="budget" label="Budget" :item="$task ?? null"/>
  </div>
  <div class="mb-3">
    <label for="editor">Performance</label>
    <textarea class="form-control" id="myEditor" name="performance"></textarea>
  </div>
  <div class="mb-3">
    <x-controls.input type="date" name="duedate" label="Due date" :item="$task ?? null"/>
  </div>
  <div class="mb-3">
    <x-controls.select 
          name="author" 
          label="Author" 
          :options="['1' => 'Andrey', '2' => 'Elena']" 
      /> 
  </div>
  <!--
  <select name="author" label="Author" class="form-select mb-2" aria-label="Default select example">
  <option selected>Select an author:</option>
  <option>Andrey</option>
  <option>Elena</option>
  </select>
  
  <x-controls.select 
        name="some" 
        label="Some" 
        :options="['1' => 'a', '2' => 'b', '3' => 'c']"    
    />
  -->