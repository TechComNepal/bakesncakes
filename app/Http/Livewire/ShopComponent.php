<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use WithPagination;

    public $slug = '';
    public $category;

    public function mount($slug): void
    {
        $this->slug = $slug;
//        $this->sorting = "default";
        $this->category = Category::whereSlug($slug)->first();
//        $this->min_price = 0;
//        $this->max_price = $this->category->products()->max('price');
    }

    public function render()
    {
        if ($this->slug = '')
        {
            $products = Product::with(['media'])->orderBy('id', 'desc')->paginate(8);
        }else {
            $products = $this->category->products()
                ->with(['media'])
                ->paginate(8);
        }

        $categories = Category::where('id', '!=', $this->category->id)->where('parent_id', NULL)->where('status', TRUE)->with(['children'])->orderBY('created_at', 'DESC')->limit(8)->get();

        return view('livewire.shop-component', compact('products', 'categories'));
    }
}
