<label for="{{ $id }}" class="form-label">{{ $label }}</label>
<input 
type="{{ $type }}" 
class="form-control 
@error($name) is-invalid @enderror" 
id="{{ $id }}" 
name="{{ $name }}" 
value="{{ $oldExists ? $old : ( $hasItem ? $item[$name] : '' ) }}"
>
@error($name)
<div class="invalid-feedback">{{ $message }}</div>
@enderror