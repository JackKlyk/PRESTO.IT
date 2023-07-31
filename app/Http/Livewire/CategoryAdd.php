<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategoryAdd extends Component
{
    public $name_it, $name_en, $name_es, $macro;

    protected $rules = [
        'name_it' => 'required',
        'name_en' => 'required',
        'name_es' => 'required',
        'macro' => 'required',
    ];

    protected $messages = [
        'required' => 'Il campo :attribute è obbligatorio'
    ];

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function add(){
        
        $this->validate();
        Category::create([
            'name_it' => $this->name_it,
            'name_en' => $this->name_en,
            'name_es' => $this->name_es,
            'macro' => $this->macro,
        ]);

        
        session()->flash('success', 'Categoria creata!');
        return redirect()->route('admin.dashboard');
    }
    public function render()
    {
        return view('livewire.category-add');
    }
}
