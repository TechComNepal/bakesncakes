<?php

namespace App\Http\Controllers\Employee;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeDashboardController extends Controller
{
    public function index()
    {
        $this->setPageTitle('Dashboard', '');

        return view('cms.employees.dashboard', [
             'total_brand' => Brand::whereBetween('created_at', [Carbon::now()->subMonth(2), Carbon::now()])->count(),
            'total_category' => Category::whereBetween('created_at', [Carbon::now()->subMonth(2), Carbon::now()])->count(),
            'total_product' => Product::whereBetween('created_at', [Carbon::now()->subMonth(2), Carbon::now()])->count(),
              'total_cart' => Cart::whereBetween('created_at', [Carbon::now()->subMonth(2), Carbon::now()])->count(),
              'total_order' => Order::whereBetween('created_at', [Carbon::now()->subMonth(2), Carbon::now()])->count(),
            'orders' => Order::with(['user'])->latest()->limit(5)->get()
        ]);
    }
}
