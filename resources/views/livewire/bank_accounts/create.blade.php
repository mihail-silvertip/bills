<x-modal>
    <form>
    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="">
            <x-form.group type="text" label="Description" field="model.name"/>
                
        </div>
    </div>
    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        @include('livewire.form._button_save')
        @include('livewire.form._button_clear')
    </div>
</form>
</x-modal>