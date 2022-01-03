<tbody>
    @foreach($collection as $item)
    <?php
        //show balance when date changes
        if(empty($balance_date) || $item->due_date->toDateString() != $balance_date){
            if (!empty($balance_date)) {
                $show_balance = true;
            }
        } else {
            $show_balance = false;
        }
    ?>
    @if(!empty($show_balance))
        @include('livewire.core._balance_footer')
    @endif
            
    <tr>
        <td class="border px-2 py-2 text-center">{{ (new \Carbon\Carbon($item->due_date))->format('d')}}</td>
        <td class="border px-4 py-2">{{$item->category}}<br>{{$item->description}}</td>
        <td class="border px-2 py-2 text-right @if($item->amount > 0) text-blue-500 @else text-red-400 @endif">$ {{ number_format($item->amount, 2, ',', '.') }} @include('livewire.bills._updown')</td>
        <td class="border px-2 py-2 text-center">@include('livewire.bills._button_pay')</td>

        <td class="border px-4 py-2">
            @include('livewire.core._table_buttons')
        </td>
    </tr>
    <?php
    $balance_date = $item->due_date->toDateString();
    ?>
    @endforeach

    @include('livewire.core._balance_footer')
</tbody>