<x-layouts.porto title="Answer Template" 
header="Answer Template" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

<h1>Create Your Answer:</h1>
<hr>

@foreach($categories_before_main_text as $category)
    <div class="mb-3">
        <label>{{ $category->name }}</label>

        <select name="categories[{{ $category->id }}]" class="form-select">
            <option value="">No</option>

            @foreach($category->scripts as $script)
                <option value="{{ $script->id }}">
                    {{ $script->name }}
                </option>
            @endforeach
        </select>
    </div>
@endforeach

<div class="mb-3">
    <x-form-input 
        name="MainText" 
        label="Main Text" 
        placeholder="Enter the main answer text here" 
    />
</div>

@foreach($categories_after_main_text as $category)
    <div class="mb-3">
        <label>{{ $category->name }}</label>

        <select name="categories[{{ $category->id }}]" class="form-select">
            <option value="">No</option>

            @foreach($category->scripts as $script)
                <option value="{{ $script->id }}">
                    {{ $script->name }}
                </option>
            @endforeach
        </select>
    </div>
@endforeach

<a class="btn btn-primary">Generate</a>
</x-layouts.porto>