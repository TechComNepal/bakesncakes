<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use WithPagination;



    public $min_price;
    public $max_price;

    public function mount()
    {
    
//        $this->sorting = "default";
    
        $this->min_price = 1;
        $this->max_price =  Product::max('selling_price');
    }

    public function render()
    {
        $products = Product::with(['media'])->whereBetween('selling_price', [$this->min_price, $this->max_price])->paginate(10);
        $products_count = Product::whereBetween('selling_price', [$this->min_price, $this->max_price])->count();
        $trending_products = Product::where('is_trending', 1)->orderBy('created_at', 'desc')->limit(4)->get();
        $featured_products = Product::orderBy('created_at', 'desc')->get();
        $new_products = Product::orderBy('created_at', 'desc')->limit(4)->get();
        $categories = Category::where('parent_id', null)->where('status', true)->with(['children'])->orderBY('created_at', 'DESC')->limit(8)->get();

        return view('livewire.new_shop-component', compact('products', 'products_count', 'categories', 'trending_products', 'featured_products', 'new_products'));
    }
}
