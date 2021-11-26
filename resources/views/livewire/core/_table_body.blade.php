<tbody>
    @foreach($collection as $item)
    <tr>
        @foreach($fields as $field => $fieldData)
            <td class="border px-4 py-2">{{$item->$field}}</td>
            
        @endforeach
        @foreach($table['fields'] as $field => $fieldData)
            @if($fieldData['type'] == 'checkbox')
                <td class="border px-4 py-2"> @include('livewire.form._checkbox')</td>
            @endif
        
    @endforeach
        <td class="border px-4 py-2">
            <button wire:click="edit({{ $item->id }})"
                class="flex px-4 py-2 bg-gray-500 text-gray-900 cursor-pointer w-1/2">Edit</button>
            <button wire:click="delete({{ $item->id }})"
                class="flex px-4 py-2 bg-red-100 text-gray-900 cursor-pointer w-1/2">Delete</button>
        </td>
    </tr>
    @endforeach
</tbody>