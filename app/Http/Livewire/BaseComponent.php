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

    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm(){
        // clear value of all fields
        foreach ($this->fields as $field => $value) {
            $this->fields[$field]['value'] = '';
        }
        $this->data = [];
        $this->modelId = 0;
    }
    
    public function store()
    {
        $this->getParameters();
        $this->model::updateOrCreate(['id' => $this->modelId], $this->data);

        session()->flash('message', $this->modelId ? 'Record updated.' : 'Record created.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function getParameters() {
        // get rules from this->fields
        $rules = [];
        foreach ($this->fields as $field => $value) {
            $rules['fields.' . $field . '.value'] = $value['rules'];
            $this->data[$field] = $value['value'];
        }

        $this->validate($rules);
    }

    public function edit($id)
    {
        $model = $this->model::findOrFail($id)->toArray();
        $this->modelId = $model['id'];
        // add all the values from periodicBills to fields
        foreach ($model as $field => $value) {
            if (isset($this->fields[$field])) {
                $this->fields[$field]['value'] = $value;
            }
        }
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        $this->model::find($id)->delete();
        session()->flash('message', 'Record deleted.');
    }
}
