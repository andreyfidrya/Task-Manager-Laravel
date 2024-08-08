<x-layouts.porto title="Edit a sample" header="Edit a sample" username={{$username}}>
@bind($sample)
    <x-form method="post" action="{{ route('samples.update', [ $sample->id ]) }}">
        @method('PUT')
        @include('emails.samples.form-fields')
        <button class="btn btn-primary">Update a sample</button>
    </x-form>
@endbind
</x-layouts.porto>