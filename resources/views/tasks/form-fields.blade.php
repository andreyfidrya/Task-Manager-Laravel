@csrf
<div class="mb-3">
    <x-form-select name="client_id" label="Client" :options="$clients" placeholder="Select the client" />
</div>
<div class="mb-3">    
    <x-form-input name="task" label="Task"/> 
</div>
<div class="mb-3">    
    <x-form-input name="wordcount" label="Word Count"/> 
</div>  
<div class="mb-3">    
    <x-form-input name="budget" label="Budget"/> 
</div>
<div class="mb-3">    
    <x-form-input name="feepercentage" label="Fee (%)"/> 
</div>
<div class="mb-3">    
    <x-form-input name="vatpercentage" label="Vat (%)"/> 
</div>
<div class="mb-3">
    <x-form-textarea name="performance" id="editor" label="Performance"/>
</div>
<div class="mb-3">
    <x-form-input type="date" name="duedate" label="Due Date"/>
</div>
<div class="mb-3">
    <x-form-select name="user_id" label="User" :options="$users" placeholder="Select the user"/> 
</div>

<div class="mb-3">
    <x-form-select name="taskstatus" label="Task Status" :options="$taskstatuses" placeholder="Select the status"/> 
</div> 


