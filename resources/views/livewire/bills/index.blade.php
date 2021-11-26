@include('livewire.core.index', [
    'buttons' => [
        ['view' => 'form._button_create']
    ],
    'fields' => [
        'due_date' => [
            'type' => 'date',
            'value' => '',
            'rules' => 'required|date',
            'label' => 'Due Date',
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
        'observation' => [
            'type' => 'textarea',
            'value' => '',
            'rules' => '',
            'label' => 'Observation',
        ],
    ],
    'table' => [
        'fields' => [
            'confirmed' => [
                'type' => 'checkbox',
                'checked' => !empty($model->confirmed_date) ? true : false,
                'action' => 'confirm()'
            ],
            'paid' => [
                'type' => 'checkbox',
                'checked' => !empty($model->paid_date) ? true : false,
                'action' => 'pay()'
            ]
        ]
    ]
])