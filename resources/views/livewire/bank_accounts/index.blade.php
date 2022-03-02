@include('livewire.core._title')
<?php
$fields = [
    'name' => [ 'type' => 'text','label' => ' name'],
];
?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @include('livewire.core._message')

            <div class="flex flex-row justify-between">
                <div>
                    @include('livewire.form._button_create')
                </div>
            </div>

            @if($isModalOpen)
                @include($viewPath . '.' . $modal)
            @endif

            <table class="w-full">
                @include('livewire.core._table_header', ['fields' => ['Name']])
                @include('livewire.core._table_body')
            </table>
        </div>
    </div>
</div>