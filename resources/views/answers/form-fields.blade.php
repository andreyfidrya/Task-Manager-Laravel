@csrf
@foreach($categories_before_main_text as $category)
    <div class="mb-3">
        <label>{{ $category->name }}</label>

        <select name="{{ $category->slug }}" class="form-select">
            <option value="">No</option>
            @foreach($category->scripts as $script)
                <option
                    value="{{ $script->name }}"
                    @selected(old($category->slug, $answer->{$category->slug}) == $script->name)
                >
                    {{ $script->name }}
                </option>
            @endforeach
        </select>

    </div>
@endforeach

<textarea
    type="text"
    name="maintext"
    id="editor"
    class="form-control"    
>{{ old('maintext', $answer->maintext) }}</textarea>

@foreach($categories_after_main_text as $category)
    <div class="mb-3">
        <label>{{ $category->name }}</label>

        <select name="{{ $category->slug }}" class="form-select">
            <option value="">No</option>
            @foreach($category->scripts as $script)
                <option
                    value="{{ $script->name }}"
                    @selected(old($category->slug, $answer->{$category->slug}) == $script->name)
                >
                    {{ $script->name }}
                </option>
            @endforeach
        </select>
    </div>
@endforeach
        
