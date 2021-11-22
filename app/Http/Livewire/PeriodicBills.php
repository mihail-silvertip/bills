<?php

namespace App\Http\Livewire;

use App\Models\PeriodicBill;
use App\Http\Livewire\BaseComponent;

class PeriodicBills extends BaseComponent {

    public $title = 'Periodic Bills';

    public $viewPath = 'livewire.periodic_bills';

    public $model = PeriodicBill::class;

    public $fields = [
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
            'rules' => 'required',
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
    ];

    public $isModalOpen = 0;

    public function render()
    {
        $this->collection = $this->model::all();
        return view('livewire.periodic_bills.list');
    }

}
