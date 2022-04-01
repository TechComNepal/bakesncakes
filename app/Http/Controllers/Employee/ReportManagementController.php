<?php

namespace App\Http\Controllers\employee;

use PDF;
use App\Models\Product;
use App\Models\CustomOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Products\ProductRepository;

class ReportManagementController extends Controller
{
    private $productRepository;
    private $imageUploadService;

    public function __construct(ProductRepository $productRepository, ImageUploadService $imageUploadService)
    {
        $this->productRepository = $productRepository;
        $this->setPageTitle('Stock product ', '');
        $this->imageUploadService = $imageUploadService;
    }

    public function viewStock(Request $request)
    {
        return (\request()->ajax())
        ? $this->datatable($request)
        : view('cms.employees.reportManagements.stockView');
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

        $products=$query->latest()->get();
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
}
