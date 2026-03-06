@csrf

<div class="mb-3">
    <x-form-select 
        name="Waiting" 
        label="Waiting" 
        :options="[]" 
        placeholder="No"
    /> 
</div>

<div class="mb-3">
    <x-form-select 
        name="Apologize" 
        label="Apologize" 
        :options="[]" 
        placeholder="No"
    /> 
</div>

<div class="mb-3">
    <x-form-input 
        name="MainText" 
        label="Main Text" 
        placeholder="Enter the main answer text here" 
    />
</div>

<div class="mb-3">
    <x-form-select 
        name="Add Question" 
        label="Add Question" 
        :options="[]" 
        placeholder="No"
    /> 
</div>

<div class="mb-3">
    <x-form-select 
        name="Goodbye" 
        label="Goodbye" 
        :options="[]" 
        placeholder="No"
    /> 
</div>