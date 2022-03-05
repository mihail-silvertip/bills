<?php

namespace App\Http\Livewire;

use App\Models\PeriodicBill;
use App\Http\Livewire\BaseComponent;
use App\Models\Account;

class PeriodicBills extends BaseComponent {

    public $title = 'Periodic Bills';

    public $viewPath = 'livewire.periodic_bills';

    public PeriodicBill $model;

    public $filter_account_id = null;

    public $isModalOpen = 0;

    public $rules = [
        'model.account_id' => 'required|numeric',
        'model.day' => 'required|numeric',
        'model.category' => 'string|nullable',
        'model.description' => 'required',
        'model.amount' => 'required|numeric',
        'model.payment_method' => 'required',
        'model.amount_variable' => 'boolean|nullable',
        'model.end_date' => 'date|nullable',
        'model.observation' => 'string|nullable',
        'filter_account_id' => 'numeric|nullable',
    ];

    public function mount() {
        $this->model = new PeriodicBill;
        $this->accounts = Account::mine()->orderby('name')->get()->pluck('name', 'id');
    }

    public function render()
    {
        $this->collection = PeriodicBill::mine()
        ->when($this->filter_account_id, function ($query) {
            return $query->where('account_id', $this->filter_account_id);
        })
        ->orderby('day')->get();
        return view('livewire.periodic_bills.index');
    }

    public function store()
    {
        $this->validate();
        $this->model->save();

        session()->flash('message', $this->modelId ? 'Record updated.' : 'Record created.');

        $this->closeModalPopover();
    }

    public function edit($id)
    {
        $this->model = PeriodicBill::mine()->findOrFail($id);
        $this->modelId = $this->model->id;
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        PeriodicBill::mine()->find($id)->delete();
        session()->flash('message', 'Record deleted.');
    }

}
