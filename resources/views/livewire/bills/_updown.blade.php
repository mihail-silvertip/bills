<span class="inline-flex">
@if (empty($item->periodicBill))

@elseif ($item->amount > $item->periodicBill->amount)
    @include('svgs.up')
@elseif ($item->amount < $item->periodicBill->amount)
    @include('svgs.down')
@elseif ($item->amount == $item->periodicBill->amount)
    @include('svgs.repeat')
@endif
</span>