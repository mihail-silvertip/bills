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
        // foreach ($this->fields as $field => $value) {
        //     $this->$field = '';
        // }
        // $this->data = [];
        $this->modelId = 0;
    }
    
    // public function store()
    // {
    //     //$this->getParameters();
    //     $this->validate();
    //     $this->model::updateOrCreate(['id' => $this->modelId], $this->data);

    //     session()->flash('message', $this->modelId ? 'Record updated.' : 'Record created.');

    //     $this->closeModalPopover();
    //     $this->resetCreateForm();
    // }

    // public function getParameters() {
    //     // get rules from this->fields
    //     $rules = [];
    //     foreach ($this->fields as $field => $value) {
    //         $rules[$field] = $value['rules'] ?? '';
    //         $this->data[$field] = $this->$field;
    //     }

    //     $this->validate($rules);
    // }

//     public function edit($id)
//     {
//         $this->model = $this->model::findOrFail($id);
//         $this->modelId = $this->model->id;
//         // // add all the values from model to fields
//         // foreach ($model as $field => $value) {
//         //     if (isset($this->fields[$field])) {
//         //         $this->$field = $value;
//         //     }
//         // }
//         $this->openModalPopover();
//     }
    
//     public function delete($id)
//     {
//         $this->model::find($id)->delete();
//         session()->flash('message', 'Record deleted.');
//     }
}
