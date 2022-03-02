<?php

namespace App\Http\Livewire;

use App\Models\BankAccount;
use App\Http\Livewire\BaseComponent;

class BankAccounts extends BaseComponent {

    public $title = 'Bank Accounts';

    public $viewPath = 'livewire.bank_accounts';

    public BankAccount $model;

    public $isModalOpen = 0;

    public $rules = [
        'model.name' => 'string|required',
    ];

    public function mount() {
        $this->model = new BankAccount;
    }

    public function render()
    {
        $this->collection = BankAccount::mine()->orderby('name')->get();
        return view($this->viewPath . '.index');
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
        $this->model = BankAccount::mine()->findOrFail($id);
        $this->modelId = $this->model->id;
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        $this->model = BankAccount::mine()->find($id)->delete();
        session()->flash('message', 'Record deleted.');
    }

}
