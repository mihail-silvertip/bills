<input type="checkbox" wire:model="{{$field}}" value="" id="{{$field}}">
@error($field) <span class="text-red-500">{{ $message }}</span>@enderror