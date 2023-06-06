@props([
    'name',
    'label', 
    'options',
    'item' => null,
    'multiple' => false,
    'id' => null,       
])

@php

if($id === null){
    $id = "field-$name";    
}

$hasItem = $item !== null;
$oldParams = old();
$oldExists = array_key_exists($name, $oldParams);
$old = $oldExists ? $oldParams[$name] : '';

$selectedValue = $oldExists ? $old : ( $hasItem ? $item[$name] : '');

@endphp

<label for="{{ $id }}" class="form-group">{{ $label }}</label>
<select 
    class="form-select 
    @error($name) is-invalid @enderror" 
    id="{{ $id }}" 
    name="{{ $name }}" 
>   
    @foreach($options as $value => $text)
        <option value="{{ $value }}" @selected($selectedValue == $value)>{{ $text }}</option>
    @endforeach
</select>
@error($name)
<div class="invalid-feedback">{{ $message }}</div>
@enderror


