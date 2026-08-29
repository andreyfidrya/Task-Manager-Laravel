<x-layouts.porto title="Show a Response" 
header="Show a Response" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">
    
        <h1>{{ $answer->template }}:</h1>
        <hr>
    <div id="answer-text">
        @if(!empty($answer->waiting))
            {{ $answer->waiting }}<p>
        @endif

        @if(!empty($answer->apologize))
            <p>{{ $answer->apologize }}<p>
        @endif

        {!! $response->description !!}<p>

        @if(!empty($answer->maintext))
            {!! $answer->maintext !!}<p>
        @endif

        @if(!empty($answer->addquestion))
            {{ $answer->addquestion }}<p>
        @endif
    </div>

    <div class="d-flex gap-2">
        <button type="button" id="copy-answer" class="btn btn-success">
            Copy
        </button>
    </div>

    <script>
        document.getElementById('copy-answer').addEventListener('click', function () {
            const answer = document.getElementById('answer-text').innerText;

            navigator.clipboard.writeText(answer).then(() => {
                this.textContent = 'Copied!';

                setTimeout(() => {
                    this.textContent = 'Copy';
                }, 1500);
            });
        });
    </script>

</x-layouts.porto>
