<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use App\Http\Livewire\BaseComponent;
use App\Models\Balance;
use App\Models\PeriodicBill;
use Carbon\Carbon;

class Bills extends BaseComponent
{
    public $title = 'Bills';

    public $viewPath = 'livewire.bills';

    public Bill $model;

    public $isModalOpen = 0;
    
    public $balance = 0;
    public $date = '';

    public $base = '';

    protected $queryString = ['base'];

    public $rules = [
        'model.due_date' => 'required|date',
        'model.description' => 'required',
        'model.amount' => 'required|numeric',
        'model.payment_method' => 'required',
        'model.category' => 'string|nullable',
        'model.observation' => 'string|nullable',
    ];

    public function render()
    {
        if (empty($this->base)) {
            $this->base = Carbon::now()->format('Y-m');
        }

        $this->loadData();
        if (count($this->collection) == 0) {
            $this->importPeriodicBills();
        }
        return view('livewire.bills.index');
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
        $this->model = Bill::mine()->findOrFail($id);
        $this->model->category2 = $this->model->category;
        $this->modelId = $this->model->id;
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        $this->model = Bill::mine()->find($id)->delete();
        session()->flash('message', 'Record deleted.');
    }

    protected function importPeriodicBills() {
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

    protected function loadData() {
        $this->collection = Bill::mine()
            ->where('due_date', 'like', '%' . $this->base . '%')
            ->orderBy('due_date')
            ->get();

        $this->balances = Balance::mine()
            ->where('date', 'like', '%' . $this->base . '%')
            ->orderBy('date')
            ->get()
            ->pluck('amount', 'date');
    }

    public function confirm($id) {
        $this->model = Bill::mine()->findOrFail($id)->update(['confirmed_date' => \Carbon\Carbon::now()]);
        session()->flash('message', 'Marked as Confirmed');
    }

    public function pay($id) {
        $this->model = Bill::mine()->findOrFail($id)->update(['paid_date' => \Carbon\Carbon::now()]);
        session()->flash('message', 'Marked as Paided');
    }


}
