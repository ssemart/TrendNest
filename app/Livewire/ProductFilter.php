<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class ProductFilter extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = null;
    public $minPrice = null;
    public $maxPrice = null;
    public $sortBy = 'newest';
    public $perPage = 12;

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategory' => ['except' => null],
        'minPrice' => ['except' => null],
        'maxPrice' => ['except' => null],
        'sortBy' => ['except' => 'newest'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::query()
            ->where('stock_quantity', '>', 0)
            ->where('visibility', true)
            ->with(['productImages', 'store', 'category']);

        // Apply search filter
        if ($this->search) {
            $query->where(function($q) {
                $q->where('product_name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Apply category filter
        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        // Apply price range filter
        if ($this->minPrice !== null) {
            $query->where('regular_price', '>=', $this->minPrice);
        }
        if ($this->maxPrice !== null) {
            $query->where('regular_price', '<=', $this->maxPrice);
        }

        // Apply sorting
        switch ($this->sortBy) {
            case 'price_low':
                $query->orderBy('regular_price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('regular_price', 'desc');
                break;
            case 'popularity':
                $query->withCount('carts')
                      ->orderBy('carts_count', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate($this->perPage);
        $categories = Category::withCount('products')->get();

        return view('livewire.product-filter', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function resetFilters()
    {
        $this->reset(['search', 'selectedCategory', 'minPrice', 'maxPrice', 'sortBy']);
        $this->resetPage();
    }
}