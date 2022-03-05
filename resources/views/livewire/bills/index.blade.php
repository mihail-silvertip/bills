@include('livewire.core._title')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @include('livewire.core._message')

            <div class="sm:flex flex-row justify-between">
                    <x-form.group type="select" label="Month" field="base" :options="$availableBases" class="sm:w-1/3 mx-1"/>
                    <x-form.group type="select" label="Account" field="filter_account_ids" :options="$accounts" multiple=true class="sm:w-1/3 mx-1"/>
                <div class="sm:w-1/3 mx-1">
                    @include('livewire.form._checkbox',[
                        'label'=>__('Show only not paid bills'),
                        'field'=>'not_paid',
                    ])
                    <label>{{__('Not paid')}}</label>
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