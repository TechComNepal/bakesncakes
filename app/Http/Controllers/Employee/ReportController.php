<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    public function productStockIndex(Request $request)
    {
        $this->setPageTitle('Product Stock', '');
        return (request()->ajax())
            ? $this->productStockDatatable($request)
            : view('cms.employees.reports.productStock');
    }

    public function productStockDatatable(Request $request)
    {
        if (Auth::user()->hasRole('admin')) {
            $query = Product::latest();
        } else {
            $query = Product::where('user_id', Auth::user()->id)->latest();
        }

        $query->when($request['name'], function ($q) {
            return $q->where('name', 'like', '%' . request('name') . '%');
        });

        $query->when($request['brand'], function ($q) use ($request) {
            $q->whereHas('brand', function ($query) use ($request) {
                return $query->where('name', 'LIKE', '%' . $request['brand'] . '%');
            });
        });

        $products = $query->get();

        return DataTables::of($products)
            ->addColumn('image', function ($data) {
                return "<img src='".$data->getFirstOrDefaultMediaUrl('image', 'thumb')."' src='".$data->name."' width='80' height='80' />";
            })
            ->editColumn('brand_id', function ($data) {
                return $data->brand->name;
            })
            ->addIndexColumn()
            ->rawColumns(['image'])
            ->make(true);
    }
}
