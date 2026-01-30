@csrf

<div class="mb-3">
    <x-form-select name="Waiting" label="Waiting" :options="['No' => 'No', 'Please, wait a few minutes. I need to check the information on your request.' => 'Please, wait a few minutes. I need to check the information on your request.', 'Dear customer, I need to check the information on your request. Please, wait a few minutes.' => 'Dear customer, I need to check the information on your request. Please, wait a few minutes.', 'Thank you for the provided information! Please, wait a bit.' => 'Thank you for the provided information! Please, wait a bit.', 'Please, wait a few minutes in the chat.' => 'Please, wait a few minutes in the chat.', 'Пожалуйста, подождите немного. Мне необходимо уточнить информацию по Вашему вопросу.' => 'Пожалуйста, подождите немного. Мне необходимо уточнить информацию по Вашему вопросу.', 'Уважаемый клиент, мне необходимо уточнить информацию по Вашему вопросу. Пожалуйста, подождите несколько минут в чате.' => 'Уважаемый клиент, мне необходимо уточнить информацию по Вашему вопросу. Пожалуйста, подождите несколько минут в чате.', 'Спасибо за предоставленную информацию! Просьба немного подождать.' => 'Спасибо за предоставленную информацию! Просьба немного подождать.', 'Пожалуйста, подождите несколько минут в чате.' => 'Пожалуйста, подождите несколько минут в чате.']" placeholder="Does the answer require waiting?"/> 
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