<div class="flex flex-row">
    @if($isModalOpen)
        @include($viewPath . '.' . $modal)
    @endif
    <div class="w-1/2">
        <span class="text-gray-700">Balance:</span>
    </div>
    <div class="w-1/2 text-right">
        <a href=# wire:click.prevent="edit('{{$balance_date}}', '{{$balance}}')"<span class=" @if(!empty($changed_balance)) text-green-700 @else text-gray-700 @endif" title="@if(!empty($changed_balance))Calculated Balance {{$changed_balance}}@endif">$ {{ number_format($balance, 2, ',', '.') }}</span>
    </div>
</div>