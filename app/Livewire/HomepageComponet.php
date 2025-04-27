<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class HomepageComponet extends Component
{
    public function render()
    {
        return view('livewire.homepage-componet', ['products' => Product::all()]);
    }
}
