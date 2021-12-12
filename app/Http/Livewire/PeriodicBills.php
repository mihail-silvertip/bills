<?php

namespace App\Http\Livewire;

use App\Models\PeriodicBill;
use App\Http\Livewire\BaseComponent;

class PeriodicBills extends BaseComponent {

    public $title = 'Periodic Bills';

    public $viewPath = 'livewire.periodic_bills';

    public $model = PeriodicBill::class;

    public $isModalOpen = 0;

    public $fields = [
        'day' => [
            'type' => 'text',
            'rules' => 'required|numeric|min:1|max:31',
            'label' => 'Day',
        ],
        'category' => [
            'type' => 'select',
            'label' => 'Category',
            'options' => [
                'home' => 'Home',
                'bank fees' => 'Bank Fees',
                'other' => 'Other',
                'mortgage' => 'Mortgage',
                'car' => 'Car',
                'salary' => 'Salary',
                'other income' => 'Other Income',
                'insurance' => 'Insurance',
                'investment' => 'Investment',
            ],
        ],
        'description' => [
            'type' => 'text',
            'rules' => 'required',
            'label' => 'Description',
        ],
        'amount' => [
            'type' => 'currency',
            'rules' => 'required|numeric',
            'label' => 'Amount',
        ],
        'payment_method' => [
            'type' => 'select',
            'options' => [
                'auto-payment' => 'auto-payment',
                'credit card' => 'credit card',
                'bill' => 'bill',
                'e-transfer' => 'e-transfer',
            ],
            'rules' => 'required',
            'label' => 'Payment Method',
        ],
        'amount_variable' => [
            'type' => 'checkbox',
            'value' => 1,
            'label' => 'Amount Variable',
        ],
        'end_date' => [
            'type' => 'date',
            'rules' => 'date',
            'label' => 'End Date',
        ],
        'observation' => [
            'type' => 'textarea',
            'label' => 'Observation',
        ],
    ];

    public function render()
    {
        $this->collection = $this->model::where('user_id', auth()->user()->id)->orderby('day')->get();
        return view('livewire.periodic_bills.index');
    }

}
