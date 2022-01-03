<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PeriodicBill;

class BaseComponent extends Component
{
    public $fields = [];

    public $data = [];

    public $modelId = 0;

    public $isModalOpen = 0;
    public $modal = 'create';

    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover($modal = 'create')
    {
        $this->modal = $modal;
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }
}
