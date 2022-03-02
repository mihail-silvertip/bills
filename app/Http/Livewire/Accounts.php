<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Http\Livewire\BaseComponent;
use App\Models\BankAccount;

class Accounts extends BaseComponent {

    public $title = 'Accounts';

    public $viewPath = 'livewire.accounts';

    public Account $model;

    public $isModalOpen = 0;

    public $rules = [
        'model.bank_account_id' => 'integer|required',
        'model.name' => 'string|required',
    ];

    public function mount() {
        $this->model = new Account;
        $this->bankAccounts = BankAccount::mine()->orderby('name')->get()->pluck('name', 'id');
    }

    public function render()
    {
        $this->collection = Account::mine()->with('bankAccount')->orderby('name')->get();
        
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
        $this->model = Account::mine()->findOrFail($id);
        $this->modelId = $this->model->id;
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        $this->model = Account::mine()->find($id)->delete();
        session()->flash('message', 'Record deleted.');
    }

}
