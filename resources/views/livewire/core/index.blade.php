@include('livewire.core._title')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @include('livewire.core._message')

            @foreach($buttons as $button)
                @include('livewire.' . $button['view'], $button['data'] ?? [])
            @endforeach

            @if($isModalOpen)
                @include($viewPath . '.create')
            @endif

            <table class="table-fixed w-full">
                @include('livewire.core._table_header')
                @include('livewire.core._table_body')
            </table>
        </div>
    </div>
</div>