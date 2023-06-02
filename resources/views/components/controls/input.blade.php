@props([
    'name',
    'label', 
    'item',
    'type' => 'text'      
])

@php
// не совсем круто, можно добавить помимо шаблона класс компонента


$oldParams = old();
$oldExists = array_key_exists($name, $oldParams);
$old = $oldExists ? $oldParams[$name] : '';
@endphp

<label>{{ $label }}</label>
<input 
type="{{ $type }}" 
class="form-control" 
name="{{ $name }}"
value="{{ $oldExists ? $old : ( isset($item) ? $item[$name] : '' ) }}"
>
@error($name)<div class="alert alert-danger">{{ $message }}</div>@enderror