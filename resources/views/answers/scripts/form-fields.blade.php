@csrf

<div class="mb-3">    
    <x-form-input name="name" label="Name"/> 
</div>

<div class="mb-3">
    <label for="category_id" class="form-label">
        Category
    </label>

    <select name="category_id" id="category_id" class="form-control">
        <option value="">Select a Category</option>

        @foreach($categories as $category)
            <option 
                value="{{ $category->id }}"
                {{ old('category_id') == $category->id ? 'selected' : '' }}
            >
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>