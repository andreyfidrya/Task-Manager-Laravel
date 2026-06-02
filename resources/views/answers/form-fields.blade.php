<form method="POST" action="#">
        @csrf
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
        
    </form>