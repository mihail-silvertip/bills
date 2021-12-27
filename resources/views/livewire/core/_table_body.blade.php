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
        @foreach($fields as $field => $fieldData)
            @if(isset($fieldData['table_visible']) && $fieldData['table_visible'] == false)
                @continue
            @endif
            @if(!empty($fieldData['type']) && $fieldData['type'] == 'date' && !empty($item->$field))
            <td class="border px-2 py-2 @if(isset($fieldData['class'])){{$fieldData['class']}}@endif">@if(!empty($item->$field)) {{ (new \Carbon\Carbon($item->$field))->format('d-m-Y')}} @endif</td>
            
            @elseif(!empty($fieldData['type']) && $fieldData['type'] == 'day' && !empty($item->$field))
            <td class="border px-2 py-2 text-center @if(isset($fieldData['class'])){{$fieldData['class']}}@endif">@if(!empty($item->$field)) {{ (new \Carbon\Carbon($item->$field))->format('d')}} @endif</td>
            
            @elseif(!empty($fieldData['type']) && $fieldData['type'] == 'currency' && !empty($item->$field))
            <td class="border px-2 py-2 text-right @if($item->$field > 0) text-blue-500 @else text-red-400 @endif @if(isset($fieldData['class'])){{$field['class']}}@endif">$ {{ number_format($item->$field, 2, ',', '.') }}</td>
            
            @elseif(!empty($fieldData['type']) && $fieldData['type'] == 'view')
            <td class="border px-2 py-2 text-center @if(isset($fieldData['class'])){{$fieldData['class']}}@endif">@include($fieldData['view'])</td>

            @else
                <td class="border px-4 py-2 @if(isset($fieldData['class'])){{$fieldData['class']}}@endif">{{$item->$field}}</td>
            @endif
            
        @endforeach

        <td class="border px-4 py-2">
            @include('livewire.core._table_buttons')
           
        </td>
    </tr>
    @endforeach

    @include('livewire.core._balance_footer')
</tbody>