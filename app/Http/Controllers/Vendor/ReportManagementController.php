<?php

namespace App\Http\Controllers\vendor;

use PDF;
use App\Models\Product;
use App\Models\CustomOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Products\ProductRepository;

class ReportManagementController extends Controller
{
    private $productRepository;
    

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
        $this->setPageTitle('Stock product ', '');
    }

    public function viewStock(Request $request)
    {
        return (\request()->ajax())
        ? $this->datatable($request)
        : view('cms.vendors.reportManagements.stockView');
    }

    public function viewSoldProduct(Request $request)
    {
        $this->setPageTitle('Sold Product', '');
        return (\request()->ajax())
        ? $this->soldDatatable($request)
        : view('cms.vendors.reportManagements.soldProductView');
    }



    // dataTable for Stock view

    public function datatable($request)
    {
        $query = Product::query();

        $query->when($request['name'], function ($q) {
            return $q->where('name', 'like', '%' . request('name') . '%');
        });

        $query->when($request['sku'], function ($q) {
            return $q->where('sku', 'like', '%' . request('sku') . '%');
        });

        $products=$query->where('user_id', auth()->user()->id)->latest()->get();
        return DataTables::of($products)
         
        ->editColumn('name', function ($data) {
            return '<div class="col-auto" style="display: inline-block">
                    <img src="'.$data->getFirstOrDefaultMediaUrl('image', 'square-sm-thumb').'" alt="Product Image" height="50" width="50"/>
                </div>
                <div class="col-auto" style="display: inline-block">
                    <span class="text-muted text-truncate">'.$data->name.' </span>
                </div>';
        })

        
        ->addColumn('selling_price', function ($data) {
            return '<div class="col-auto" style="display: inline-block">
            <span class="text-muted text-truncate">'. $data->selling_price.'</span>' .'<br />'.'<br />
            </div>';
        })
      
        ->editColumn('discount', function ($data) {
            $type = ($data->discount_type==='flat') ? 'Rs.' : '%';
           
            return '<div class="col-auto" style="display: inline-block">
           
            </div>
            <div class="col-auto" style="display: inline-block">
                <span class="text-muted text-truncate">'. $data->discount .' ' .'<strong>'. $type.'</strong>' .' </span>
            </div>';
        })
        

          
            ->addIndexColumn()
            ->rawColumns(['name', 'selling_price', 'discount'])
            ->make(true);
    }

    public function soldDatatable($request)
    {
        $query = DB::table('orders')
            ->join('order_product', 'orders.id', '=', 'order_product.order_id')
            ->join('products', 'order_product.product_id', '=', 'products.id')
            ->join('users', 'orders.seller_id', '=', 'users.id')
            ->select('orders.order_code', 'products.name', 'order_product.quantity')
            ->where('orders.seller_id', Auth::user()->id);
        
        $query->when($request['name'], function ($q) {
            return $q->where('products.name', 'like', '%' . request('name') . '%');
        });

        $query->when($request['order_code'], function ($q) {
            return $q->where('orders.order_code', 'like', '%' . request('order_code') . '%');
        });


        $order=$query->get();


        return DataTables::of($order)
            ->addIndexColumn()
            ->make(true);
    }
}
