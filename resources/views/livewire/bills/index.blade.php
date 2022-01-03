@include('livewire.core._title')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @include('livewire.core._message')

            <div class="flex flex-row justify-between">
                <div class="w-48">
                    @include('livewire.form._select',[
                        'label'=>__('Select a date'),
                        'field'=>'base',
                        'options'=>$availableBases,
                    ])
                </div>
                <div>
                    @include('livewire.form._button_create')
                </div>
            </div>

            @if($isModalOpen)
                @include($viewPath . '.' . $modal)
            @endif

            <table class="w-full">
                @include('livewire.core._table_header', ['fields' => ['Due Date', 'Description', 'Amount', 'Paid']])
                @include('livewire.bills._table_body')
            </table>
        </div>
    </div>
</div>