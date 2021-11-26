<?php

namespace App\Http\Livewire;

use App\Models\PeriodicBill;
use App\Http\Livewire\BaseComponent;

class PeriodicBills extends BaseComponent {

    public $title = 'Periodic Bills';

    public $viewPath = 'livewire.periodic_bills';

    public $model = PeriodicBill::class;

    public $isModalOpen = 0;

    public function render()
    {
        $this->collection = $this->model::where('user_id', auth()->user()->id)->get();
        return view('livewire.periodic_bills.index');
    }

}
