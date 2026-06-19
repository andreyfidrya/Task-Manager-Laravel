
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

        <input
            type="text"
            name="maintext"
            class="form-control"
            value="{{ old('maintext', $answer->maintext) }}"
        >

        @foreach($categories_after_main_text as $category)
            <div class="mb-3">
                <label>{{ $category->name }}</label>

                <select name="{{ $category->slug }}" class="form-select">
                    <option value="">No</option>

                    @foreach($category->scripts as $script)
                        <option
                            value="{{ $script->name }}"
                            @selected(old('addquestion', $answer->addquestion) == $script->name)
                        >
                            {{ $script->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endforeach
        
