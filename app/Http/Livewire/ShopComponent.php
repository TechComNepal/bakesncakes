<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use WithPagination;

    public $products_count = 0;
    public $min_price;
    public $max_price;
    public $category_id = null;

    protected $listeners = [
        'price_filter' => 'priceFilter',
    ];

    public function mount()
    {
        $this->min_price = 1;
        $this->max_price =  Product::max('selling_price');
    }

    public function selectedCategory($category_id)
    {
        $this->category_id = $category_id;
    }

    public function priceFilter($min_price, $max_price)
    {
        $this->min_price = $min_price;
        $this->max_price = $max_price;
    }

    public function render()
    {
        $products = $this->getProducts();
        $trending_products = Product::where('is_trending', 1)->orderBy('created_at', 'desc')->limit(4)->get();
        $featured_products = Product::orderBy('created_at', 'desc')->get();
        $new_products = Product::orderBy('created_at', 'desc')->limit(4)->get();
        $categories = Category::where('parent_id', null)->where('status', true)->with(['children'])->orderBY('created_at', 'DESC')->limit(8)->get();
        return view('livewire.new_shop-component', compact('products', 'categories', 'trending_products', 'featured_products', 'new_products'));
    }

    protected function getProducts()
    {
        $products = Product::with(['media']);
        if (isset($this->category_id)) {
            $products->where('category_id', $this->category_id);
        }
        if (isset($this->min_price) && isset($this->max_price)) {
            $products->whereBetween('selling_price', [$this->min_price, $this->max_price]);
        }

        $this->products_count = $products->count();
        return $products->paginate(10);
    }
}
