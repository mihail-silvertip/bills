<tbody>
    @foreach($collection as $item)
    <?php
    if (isset($balance)) {
        //add subtotal when date changes
        if(empty($date) || $item->due_date->toDateString() != $date){
            if (!empty($date)) {
                $show_balance = true;
            }
            
            $changed_balance = 0;
            if (!empty($balances[$date])) {
                $changed_balance = $balance;
                $balance = $balances[$date];
            }

            $date = $item->due_date->toDateString();
            $subtotal = 0;
    
        } else {
            $show_balance = false;
        }
        
        ?>
    @if(!empty($show_balance))
        @include('livewire.core._balance_footer')
    @endif
    <?php
        $subtotal += $item->amount;
        $balance += $item->amount;
    }
    ?>
            
    <tr>
        <td class="border px-2 py-2 text-center">{{ (new \Carbon\Carbon($item->due_date))->format('d')}}</td>
        <td class="border px-4 py-2">{{$item->category}}<br>{{$item->description}}</td>
        <td class="border px-2 py-2 text-right @if($item->amount > 0) text-blue-500 @else text-red-400 @endif">$ {{ number_format($item->amount, 2, ',', '.') }} @include('livewire.bills._updown')</td>
        <td class="border px-2 py-2 text-center">@include('livewire.bills._button_pay')</td>

        <td class="border px-4 py-2">
            @include('livewire.core._table_buttons')
        </td>
    </tr>
    @endforeach

    @include('livewire.core._balance_footer')
</tbody>