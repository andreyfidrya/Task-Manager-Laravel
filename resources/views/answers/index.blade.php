<x-layouts.porto title="Answer Template" 
header="Answer Template" 
username={{$username}} 
profile_image={{$profile_image}} 
unread_notifications_number={{$unread_notifications_number}} 
:unread_notifications="$unread_notifications">

<h1>{{ $answer->template }}:</h1>
<hr>

@if(!empty($answer->waiting))
    {{ $answer->waiting }}<p>
@endif

@if(!empty($answer->apologize))
    <p>{{ $answer->apologize }}<p>
@endif

@if(!empty($answer->maintext))
    {!! $answer->maintext !!}<p>
@endif

@if(!empty($answer->addquestion))
    {{ $answer->addquestion }}<p>
@endif

<div class="d-flex gap-2">
    <a href="{{ route('answers.edit', [ $answer->id ]) }}" class="btn btn-primary">
        Customize
    </a>
    <form action="{{ route('answers.empty', $answer) }}" method="POST" class="d-inline">
        @csrf
        @method('PATCH')

        <button
            type="submit"
            class="btn btn-info"
            onclick="return confirm('Очистить шаблон?')"
        >
            Empty
        </button>
    </form>
</div>    
</x-layouts.porto>