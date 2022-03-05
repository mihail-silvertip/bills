<?php

namespace App\Http\Livewire;

use App\Http\Livewire\BaseComponent;
use App\Models\Balance;
use Carbon\Carbon;
use App\Models\Bill;

class Balances extends BaseComponent
{
    public Balance $model;

    public $balance_date;
    public $balance;
    public $balance_account_ids = [];
    public $changed_balance;

    public $viewPath = 'livewire.balances';

    protected $listeners = [
        'balanceChanged' => 'balanceChanged',
    ];

    public $rules = [
        'model.amount' => 'required|date',
        'model.date' => 'required|date',
    ];

    public function render()
    {
        $this->base = Carbon::parse($this->balance_date)->format('Y-m');
        $this->loadData();
        return view('livewire.balances.amount');
    }

    // public function edit($date, $amount) {
    //     $this->model = Balance::mine()->where('date', $date)->first() ?? new Balance;
    //     $this->model->amount = $amount;
    //     $this->model->date = $date;
    //     $this->openModalPopover('edit');
    // }

    // public function save() {
    //     $this->model->save();
    //     $this->balance = $this->model->amount;
    //     session()->flash('message', 'Balance updated.');
    //     $this->emit('balanceChanged');
    //     $this->closeModalPopover();
    // }

    protected function loadData() {
        // $this->balances = Balance::mine()
        //     ->where('date', 'like', '%' . $this->base . '%')
        //     ->where('date', '<=', $this->balance_date)
        //     ->orderBy('date')
        //     ->get()
        //     ->pluck('amount', 'date');
        // if (!empty($this->balances[$this->balance_date])) {
        //     $this->balance = $this->balances[$this->balance_date];
        //     $this->changed_balance = true;
        //     return;
        // }

        $this->calculateBalance();
    }

    protected function calculateBalance() {
        $this->balance = 0;
        //dd(Bill::getSumAmountGroupByDueDate($this->base, $this->balance_account_ids));
        foreach (Bill::getSumAmountGroupByDueDate($this->base, $this->balance_account_ids) as $date => $amount) {
            if ($date > $this->balance_date) {
                return;
            }
            // if (!empty($this->balances[$date])) {
            //     $this->balance = $this->balances[$date];
            // } else {
                $this->balance += $amount;
            // }
        }
    }

    public function balanceChanged($balance_account_ids = []) {
        $this->balance_account_ids = $balance_account_ids;
        $this->render();
    }
}
