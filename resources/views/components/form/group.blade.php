@props(['label', 'field', 'type','options', 'multiple', 'class'])

<div class="mb-4 {{$class ?? ''}}">
    <label for="{{$field}}"
        class="block text-gray-700 text-sm font-bold mb-2">{{$label}}:</label>
            @include('livewire.form._' . $type)
</div>