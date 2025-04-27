<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;

class CategorySubcategory extends Component
{
    public $categories = [];
    public $selectedCategory = null;
    public $subcategories = [];
    public $selectedSubcategory = null;

    public function mount($selectedCategory = null, $selectedSubcategory = null) 
    {
        $this->categories = Category::all();
        $this->selectedCategory = $selectedCategory;
        $this->selectedSubcategory = $selectedSubcategory;
        
        if ($this->selectedCategory) {
            $this->loadSubcategories($this->selectedCategory);
        }
    }

    public function updatedSelectedCategory($categoryId) 
    {
        $this->loadSubcategories($categoryId);
    }

    private function loadSubcategories($categoryId) 
    {
        if ($categoryId) {
            $this->subcategories = Subcategory::where('category_id', $categoryId)->get();
            $this->selectedSubcategory = null;
        } else {
            $this->subcategories = collect();
            $this->selectedSubcategory = null;
        }
        $this->dispatch('subcategories-updated');
    }

    public function render()
    {
        return view('livewire.category-subcategory');
    }
}
