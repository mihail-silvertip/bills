<x-modal>
    <form wire:submit.prevent="save">
    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="">
            <x-form.group type="currency" label="New Balance" field="model.amount"/>
                
        </div>
    </div>
    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <x-form.submit/>
        @include('livewire.form._button_clear')
    </div>
    </form>
</x-modal>
