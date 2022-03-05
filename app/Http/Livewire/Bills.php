<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use App\Http\Livewire\BaseComponent;
use App\Models\Balance;
use App\Models\PeriodicBill;
use Carbon\Carbon;
use App\Models\Account;

class Bills extends BaseComponent
{
    public $title = 'Bills';

    public $viewPath = 'livewire.bills';

    public Bill $model;
    
    public $balances = [];
    public $date = '';

    public $base = '';
    public $not_paid = 1;
    public $filter_account_ids = [];

    protected $queryString = ['base', 'not_paid', 'filter_account_ids'];

    public $rules = [
        'model.account_id' => 'required|numeric',
        'model.due_date' => 'required|date',
        'model.description' => 'required',
        'model.amount' => 'required|numeric',
        'model.payment_method' => 'required',
        'model.category' => 'string|nullable',
        'model.observation' => 'string|nullable',
    ];

    public function mount()
    {
        $this->model = new Bill;
        $this->accounts = Account::mine()->orderby('name')->get()->pluck('name', 'id');
    }

    public function render()
    {
        if (empty($this->base)) {
            $this->base = Carbon::now()->format('Y-m');
        }

        $this->loadData();

        return view('livewire.bills.index');
    }

    public function store()
    {
        $this->validate();
        $this->model->save();

        session()->flash('message', $this->modelId ? 'Record updated.' : 'Record created.');
        $this->emit('balanceChanged', $this->filter_account_ids);
        $this->closeModalPopover();
    }

    public function edit($id)
    {
        $this->model = Bill::mine()->findOrFail($id);
        $this->modelId = $this->model->id;
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        Bill::mine()->find($id)->delete();
        session()->flash('message', 'Record deleted.');
    }

    protected function importPeriodicBills() {
        $collection = Bill::mine()
            ->where('due_date', 'like', '%' . $this->base . '%')->get();
        if ($collection->count() > 0) {
            return;
        }
        $endDate = $this->base . '-01';
        $periodicBills = PeriodicBill::mine()->where('end_date', '>', $endDate)->orWhereNull('end_date')->get();
        foreach ($periodicBills as $bill) {
            $bill->due_date = $this->base . '-'. $bill->day;
            $bill->confirmed_date = $bill->amount_variable ? null : Carbon::now();
            $bill->periodic_bill_id = $bill->id;
            Bill::create($bill->toArray());
        }
        $this->loadData();
    }

    public function filterAccountIdsUpdated() {
        $this->emit('balanceChanged', $this->filter_account_ids);
    }

    protected function loadData() {
        $this->importPeriodicBills();

        $this->collection = Bill::mine()
            ->where('due_date', 'like', '%' . $this->base . '%')
            ->when($this->filter_account_ids, function ($query) {
                return $query->whereIn('account_id', $this->filter_account_ids);
            });
        if ($this->not_paid) {
            $this->collection = $this->collection->where('paid_date', null);
        }
        $this->collection = $this->collection->orderBy('due_date')
            ->get();

        $this->availableBases = Bill::mine()
            ->selectRaw('DATE_FORMAT(due_date, "%Y-%m") as base')
            ->groupBy('base')
            ->orderBy('base')
            ->get()
            ->pluck('base', 'base');
        
        $balance = 0;
        foreach (Bill::getSumAmountGroupByDueDate($this->base, $this->filter_account_ids) as $date => $amount) {
            $balance += $amount;
            $this->balances[$date] = $balance;
        }
    }

    public function confirm($id) {
        Bill::mine()->findOrFail($id)->update(['confirmed_date' => \Carbon\Carbon::now()]);
        session()->flash('message', 'Marked as Confirmed');
    }

    public function pay($id) {
        Bill::mine()->findOrFail($id)->update(['paid_date' => \Carbon\Carbon::now()]);
        session()->flash('message', 'Marked as Paided');
    }

}
