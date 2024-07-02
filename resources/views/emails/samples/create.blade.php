<x-layouts.porto title="Add a sample" header="Add a New Sample" username={{$username}}>
    <x-form method="post" action="{{ route('samples.store') }}">
        @include('emails.samples.form-fields')
        <button class="btn btn-primary">Add a sample</button>
    </x-form>
</x-layouts.porto>