<x-modal>
    <form>
    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="">
            <x-form.group type="day" label="Due Day" field="model.day"/>

            <x-form.group type="select" label="Category" field="model.category" :options="config('bills.categories')"/>

            <x-form.group type="text" label="Description" field="model.description"/>

            <x-form.group type="currency" label="Amount" field="model.amount"/>

            <x-form.group type="select" label="Payment Method" field="model.payment_method" :options="config('bills.payment_methods')"/>
            
            <x-form.group type="checkbox" label="Amount Variable" field="model.amount_variable" :options="config('bills.payment_methods')"/>

            <x-form.group type="textarea" label="Observation" field="model.observation"/>
                
        </div>
    </div>
    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        @include('livewire.form._button_save')
        @include('livewire.form._button_clear')
    </div>
</form>
</x-modal>