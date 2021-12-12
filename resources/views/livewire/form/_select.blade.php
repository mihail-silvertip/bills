<select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="{{$field}}" placeholder="{{__($fieldData['label'])}}"  wire:model="{{$field}}">
    <option value="">{{__('Select')}}</option>
    @foreach($fieldData['options'] as $option)
    <option value="{{$option}}">{{__($option)}}</option>
    @endforeach
</select>
@error('fields.' . $field) <span class="text-red-500">{{ $message }}</span>@enderror