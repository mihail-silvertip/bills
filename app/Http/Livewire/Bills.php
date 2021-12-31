<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use App\Http\Livewire\BaseComponent;
use App\Models\Balance;
use App\Models\PeriodicBill;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Bills extends BaseComponent
{
    public $title = 'Bills';

    public $viewPath = 'livewire.bills';

    public $model = Bill::class;

    public $isModalOpen = 0;

    public $balance = 0;
    public $date = '';

    public $fields = [];

    public $base = '';

    protected $queryString = ['base'];

    public function render()
    {
        $this->fields = [
            'due_date' => ['type' => 'day', 'rules' => 'required|date', 'label' => 'Due Date'],
            'category' => [
                'type' => 'select',
                'label' => 'Category',
                'table_visible' => false,
                'options' => config('bills.categories'),
            ],
            'description' => ['type' => 'text', 'rules' => 'required', 'label' => 'Description'],
            'amount' => [ 'type' => 'currency', 'rules' => 'required|numeric', 'label' => 'Amount'],
            'payment_method' => [
                'type' => 'select',
                'options' => config('bills.payment_methods'),
                'rules' => 'required',
                'label' => 'Payment Method',
                'class' => 'hidden md:block',
            ],
            'observation' => [ 'type' => 'textarea', 'label' => 'Observation', 'class' => 'hidden md:block'],
            'paid_date' => ['label' => 'Paid', 'type' => 'view', 'edit' => false, 'view' => 'livewire.bills._button_pay'],
        ];

        if (empty($this->base)) {
            $this->base = Carbon::now()->format('Y-m');
        }

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
            $bill->confirmed_date = $bill->amount_variable ? null : Carbon::now();
            $bill->periodic_bill_id = $bill->id;
            Bill::create($bill->toArray());
        }
        $this->loadData();
    }

    protected function loadData() {
        $this->collection = $this->model::where('user_id', auth()->user()->id)
        ->where('due_date', 'like', '%' . $this->base . '%')
        ->orderBy('due_date')
        ->get();

        $this->balances = Balance::where('user_id', auth()->user()->id)
        ->where('date', 'like', '%' . $this->base . '%')
        ->orderBy('date')
        ->get()
        ->pluck('amount', 'date');
    }

    public function confirm($id) {
        $this->model::findOrFail($id)->update(['confirmed_date' => \Carbon\Carbon::now()]);
        session()->flash('message', 'Marked as Confirmed');
    }

    public function pay($id) {
        $this->model::findOrFail($id)->update(['paid_date' => \Carbon\Carbon::now()]);
        session()->flash('message', 'Marked as Paided');
    }


}
