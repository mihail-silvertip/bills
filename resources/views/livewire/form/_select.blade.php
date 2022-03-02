<select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="{{$field}}" placeholder="{{$label}}"  wire:model="{{$field}}">
    <option value="">{{__('Select')}}</option>
    @foreach($options as $id => $option)
        <option value="{{$id}}">{{__($option)}}</option>
    @endforeach
</select>
@error($field) <span class="text-red-500">{{ $message }}</span>@enderror