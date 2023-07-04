<div class="mb-3">    
    <x-form-input name="clientname" label="Client Name"/> 
</div> 
<div class="mb-3">    
    <x-form-input name="task" label="Task"/> 
</div>
<div class="mb-3">    
    <x-form-input name="budget" label="Budget"/> 
</div>
<div class="mb-3">
    <x-form-textarea name="performance" label="Performance"/>
</div>
<div class="mb-3">
    <x-form-input type="date" name="duedate" label="Due Date"/>
</div>
<div class="mb-3">
    <x-form-select name="author" label="Author" :options="['Andrey' => 'Andrey', 'Elena' => 'Elena']" placeholder="Select the author"/> 
</div>


