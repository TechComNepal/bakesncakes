<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\Vendor;

class VendorDetails extends Component
{
    use WithPagination;

    public $vendor;
    public function mount($id)
    {
        $this->vendor=User::with('products')->role('vendor')->find($id);
    }
   
    public function render()
    {
        $products=Product::where('user_id', $this->vendor->id)->paginate(10);
        $trending_products=Product::where('is_trending', 1)->orderBy('created_at', 'desc')->limit(3)->get();
        return view('livewire.vendor-details', compact('products', 'trending_products'));
    }
}
