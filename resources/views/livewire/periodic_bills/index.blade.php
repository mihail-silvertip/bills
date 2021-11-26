@include('livewire.core.index', [
    'buttons' => [
        ['view' => 'form._button_create']
    ],
    'fields' => [
        'day' => [
            'type' => 'text',
            'value' => '',
            'rules' => 'required|numeric|min:1|max:31',
            'label' => 'Day',
        ],
        'category' => [
            'type' => 'text',
            'value' => '',
            'options' => [],
            'rules' => '',
            'label' => 'Category',
        ],
        'description' => [
            'type' => 'text',
            'value' => '',
            'rules' => 'required',
            'label' => 'Description',
        ],
        'amount' => [
            'type' => 'text',
            'value' => '',
            'rules' => 'required|numeric|min:0',
            'label' => 'Amount',
        ],
        'payment_method' => [
            'type' => 'text',
            'value' => '',
            'options' => [],
            'rules' => 'required',
            'label' => 'Payment Method',
        ],
        'end_date' => [
            'type' => 'text',
            'value' => '',
            'rules' => 'date',
            'label' => 'End Date',
        ],
        'observation' => [
            'type' => 'textarea',
            'value' => '',
            'rules' => '',
            'label' => 'Observation',
        ],
    ]
])