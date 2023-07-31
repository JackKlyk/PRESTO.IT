<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryEdit extends Component
{
    public $name_it, $name_en, $name_es, $macro;

    public Category $category;

    protected $rules = [
        'category.name_it' => 'required',
        'category.name_en' => 'required',
        'category.name_es' => 'required',
        'category.macro' => 'required',
    ];

    public function mount() {
        $this->name_it = $this->category->name_it;
        $this->name_en = $this->category->name_en;
        $this->name_es = $this->category->name_es;
        $this->macro = $this->category->macro;
    }

    public function update(){
        
        $this->validate();
        $this->category->update([
            'name_it' => $this->name_it,
            'name_en' => $this->name_en,
            'name_es' => $this->name_es,
            'macro' => $this->macro,
        ]);

        
        session()->flash('edit', 'Categoria modificata!');
        return redirect()->route('admin.dashboard');
    }

    public function render()
    {
        return view('livewire.category-edit');
    }
}
