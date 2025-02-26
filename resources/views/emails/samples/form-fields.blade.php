@csrf
<div class="mb-3">    
    <x-form-input name="url" label="URL"/> 
</div>
<div class="mb-3">    
    <x-form-input name="title" label="Title"/> 
</div>
<div class="mb-3">
    <x-form-select name="topics[]" size="{{$size}}" label="Topics" :options="$topics" multiple many-relation /> 
</div>