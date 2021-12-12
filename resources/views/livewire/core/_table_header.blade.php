<thead>
    <tr class="bg-gray-100">
        @foreach($fields as $field)
            @if(isset($field['table_visible']) && $field['table_visible'] == false)
                @continue
            @endif
            
            <th class="px-4 py-2">{{__($field['label'])}}</th>
        @endforeach

        <th class="px-4 py-2">Action</th>
    </tr>
</thead>