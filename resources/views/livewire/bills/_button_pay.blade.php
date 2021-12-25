<div class="flex justify-center">
@if(empty($item->confirmed_date))
    <button wire:click="confirm({{ $item->id }})"
        class="flex px-4 py-2 bg-gray-100 text-gray-900 cursor-pointer" title="{{trans('Confirm')}}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
    </button>
@elseif(empty($item->paid_date))
    <button wire:click="pay({{ $item->id }})"
        class="flex px-4 py-2 bg-gray-100 text-gray-900 cursor-pointer" title="{{trans('Pay')}}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
    </button>
@else
    <span class="text-sm">{{$item->paid_date->format('d')}}</span>
@endif
</div>