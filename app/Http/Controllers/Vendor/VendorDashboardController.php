<?php

namespace App\Http\Controllers\Vendor;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewsLetter;

class VendorDashboardController extends Controller
{
    public function index()
    {
        $this->setPageTitle('Dashboard', '');

        return view('cms.vendors.dashboard', [
             'total_brand' => Brand::whereBetween('created_at', [Carbon::now()->subMonth(2), Carbon::now()])->count(),
            'total_category' => Category::whereBetween('created_at', [Carbon::now()->subMonth(2), Carbon::now()])->count(),
            'total_product' => Product::whereBetween('created_at', [Carbon::now()->subMonth(2), Carbon::now()])->count(),
              'total_cart' => Cart::whereBetween('created_at', [Carbon::now()->subMonth(2), Carbon::now()])->count(),
              'total_order' => Order::whereBetween('created_at', [Carbon::now()->subMonth(2), Carbon::now()])->count(),
               'total_subscription' => NewsLetter::whereBetween('created_at', [Carbon::now()->subMonth(2), Carbon::now()])->count(),
            'orders' => Order::with(['user'])->latest()->limit(5)->get()
        ]);
    }
}
