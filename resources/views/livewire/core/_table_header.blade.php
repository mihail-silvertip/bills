<thead>
    <tr class="bg-gray-100">
        @foreach($fields as $field)
            <th class="px-4 py-2">{{__($field['label'])}}</th>
        @endforeach
        @foreach($table['fields'] as $field => $fieldData)
        @if($fieldData['type'] == 'checkbox')
            <th class="px-4 py-2">{{__($fieldData['label'] ?? '')}}</th>
        @endif      
    @endforeach
        <th class="px-4 py-2">Action</th>
    </tr>
</thead>