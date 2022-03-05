@include('livewire.core._title')
<?php
$fields = [
    //'account_name' => [ 'type' => 'select','label' => ' Account'],
    'day' => [ 'type' => 'text', 'label' => 'Day'],
    //'category' => ['type' => 'select', 'label' => 'Category'],
    'description_label' => [ 'type' => 'html','label' => 'Description'],
    'amount' => ['type' => 'currency', 'label' => 'Amount'],
    // 'payment_method' => ['type' => 'select','label' => 'Payment Method'],
    // 'amount_variable' => ['type' => 'checkbox','value' => 1,'label' => 'Amount Variable'],
    //'end_date' => ['type' => 'date','label' => 'End Date', 'class' => 'hidden md:table-cell'],
    //'observation' => ['type' => 'textarea','label' => 'Observation', 'class' => 'hidden md:table-cell'],
];
?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @include('livewire.core._message')

            <div class="flex flex-row justify-between">
                <div>
                    <x-form.group type="select" label="Account" field="filter_account_id" :options="$accounts"/>
                </div>
                <div>
                    @include('livewire.form._button_create')
                </div>
            </div>

            @if($isModalOpen)
                @include($viewPath . '.' . $modal)
            @endif

            <table class="w-full">
                @include('livewire.core._table_header', ['fields' => [ 'Day','Description', 'Amount']])
                @include('livewire.core._table_body')
            </table>
        </div>
    </div>
</div>