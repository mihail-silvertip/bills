<thead>
    <tr class="bg-gray-100">
        @foreach($fields as $field)
            <th class="px-4 py-2">{{__($field)}}</th>
        @endforeach

        <th class="px-4 py-2">Action</th>
    </tr>
</thead>