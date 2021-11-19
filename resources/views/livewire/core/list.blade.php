<x-slot name="header">
    <h2 class="text-center">{{__($title)}}</h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            @endif
            @include('livewire.form._button_create')
            @if($isModalOpen)
                @include($viewPath . '.create')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        @foreach($fields as $field)
                            <th class="px-4 py-2">{{__($field['label'])}}</th>
                        @endforeach
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($collection as $item)
                    <tr>
                        @foreach($fields as $field => $fieldData)
                            <td class="border px-4 py-2">{{$item->$field}}</td>
                            
                        @endforeach
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $item->id }})"
                                class="flex px-4 py-2 bg-gray-500 text-gray-900 cursor-pointer">Edit</button>
                            <button wire:click="delete({{ $item->id }})"
                                class="flex px-4 py-2 bg-red-100 text-gray-900 cursor-pointer">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>