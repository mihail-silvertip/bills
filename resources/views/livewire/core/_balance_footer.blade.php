<tr>
    <td class="border px-4 py-2" colspan="5">
        <div class="flex flex-row">
            {{-- @if($isModalOpen)
                @include($viewPath . '.' . $modal)
            @endif --}}
            <div class="w-1/2">
                <span class="text-gray-700">Balance:</span>
            </div>
            <div class="w-1/2 text-right">
                @if(isset($balance_date))
                    $ {{ number_format($balances[$balance_date], 2, ',', '.') }}
                    {{-- <a href=# wire:click.prevent="edit('{{$balance_date}}', '{{$balance}}')"<span class=" @if(!empty($changed_balance)) text-green-700 @else text-gray-700 @endif" title="@if(!empty($changed_balance))Calculated Balance {{$changed_balance}}@endif">$ {{ number_format($balance, 2, ',', '.') }}</span> --}}
                @endif
            </div>
        </div>
        {{-- @livewire('balances', ['balance_date' => $balance_date, 'balance_account_ids' => $filter_account_ids], key($item->id)) --}}
    </td>
</tr>
