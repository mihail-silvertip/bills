<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use App\Http\Livewire\BaseComponent;
use App\Models\PeriodicBill;

class Bills extends BaseComponent
{
    public $title = 'Bills';

    public $viewPath = 'livewire.bills';

    public $model = Bill::class;

    public $isModalOpen = 0;

    public function render()
    {
        $this->base = request('base');
        $this->loadData();
        if (count($this->collection) == 0) {
            $this->importPeriodicBills();
        }
        return view('livewire.bills.index');
    }

    protected function importPeriodicBills() {
        $endDate = $this->base . '-01';
        $periodicBills = PeriodicBill::where('end_date', '>', $endDate)->orWhereNull('end_date')->get();
        foreach ($periodicBills as $bill) {
            $bill->due_date = $this->base . '-'. $bill->day;
            $bill->periodic_bill_id = $bill->id;
            Bill::create($bill->toArray());
        }
        $this->loadData();
    }

    protected function loadData() {
        $this->collection = $this->model::where('user_id', auth()->user()->id)
        ->where('due_date', 'like', '%' . $this->base . '%')
        ->get();
    }


}
