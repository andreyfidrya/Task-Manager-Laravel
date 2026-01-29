@csrf

<div class="mb-3">
    <x-form-select name="Waiting" label="Waiting" :options="['No' => 'No', 'Yes' => 'Yes']" placeholder="Does the answer require waiting?"/> 
</div>
<div class="mb-3">
    <x-form-select name="Apologize" label="Apologize" :options="['No' => 'No', 'We apologize for inconvenience' => 'We apologize for inconvenience']" placeholder="Does the answer require apologizes"/> 
</div>
<div class="mb-3">
    <x-form-select name="Add Question" label="Add Question" :options="['No' => 'No', 'Is anything else I can help you with?' => 'Is anything else I can help you with?']" placeholder="Does the answer require an additional question"/> 
</div>
<div class="mb-3">
    <x-form-select name="Goodbye" label="Goodbye" :options="['No' => 'No', 'If you have any other questions, please contact us' => 'If you have any other questions, please contact us']" placeholder="Does the answer require goodnye question?"/> 
</div>