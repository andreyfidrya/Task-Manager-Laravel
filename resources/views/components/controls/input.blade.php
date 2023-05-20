@props([
    'name',
    'label', 
    'type' => 'text'      
])

<label>{{ $label }}</label>
<input type="{{ $type }}" class="form-control" name="{{ $name }}">
@error($name)<div class="alert alert-danger">{{ $message }}</div>@enderror