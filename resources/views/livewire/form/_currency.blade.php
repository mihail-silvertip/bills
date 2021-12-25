<input type="text"
    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
    id="exampleFormControl{{$field}}" placeholder="{{__($fieldData['label'])}}" wire:model="{{$field}}">
@error( $field) <span class="text-red-500">{{ $message }}</span>@enderror