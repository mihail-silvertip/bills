@if(isset($balance))
<tr>
    <td class="border px-4 py-2" colspan="5">
        <div class="flex flex-row">
            <div class="w-1/2">
                <span class="text-gray-700">Balance:</span>
            </div>
            <div class="w-1/2 text-right">
                <span class=" @if(!empty($changed_balance)) text-green-700 @else text-gray-700 @endif" title="@if(!empty($changed_balance))Calculated Balance {{$changed_balance}}@endif">$ {{ number_format($balance, 2, ',', '.') }}</span>
            </div>
        </div>
    </td>
</tr>
@endif