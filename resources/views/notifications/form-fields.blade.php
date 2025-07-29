@csrf
<div class="mb-3">
    <x-form-select name="user_id" label="User" :options="$users" placeholder="Select the user"/> 
</div>
<div class="mb-3">
    <x-form-textarea name="text" label="Text"/>
</div>
<div class="mb-3">    
    <x-form-input type="date" name="date" label="Date"/> 
</div>
<div class="mb-3">
    <x-form-select 
        name="is_read" 
        label="Is Read" 
        :options="['1' => 'Yes', '0' => 'No']" 
        placeholder="Select the notification's status"
    /> 
</div>
