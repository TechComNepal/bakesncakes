<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\Products\ProductRepository;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    private $productRepository;
    private $imageUploadService;

    public function __construct(ProductRepository $productRepository, ImageUploadService $imageUploadService) {
        $this->productRepository = $productRepository;
        $this->setPageTitle('Product', '');
        $this->imageUploadService = $imageUploadService;
    }

    public function index()
    {
        return (\request()->ajax())
            ? $this->datatable()
            : view('cms.employees.products.index');
    }

    public function create()
    {
        if(!auth()->user()->can('add product')){
            abort(403);
        }

        return view('cms.employees.products.create',[
            'categories' => Category::with('children')->whereStatus(TRUE)->where('parent_id',NULL)->get(),
            'brands' => Brand::whereStatus(TRUE)->get(),
        ]);
    }

    public function store(ProductStoreRequest $request)
    {
        if(!auth()->user()->can('add product')){
            abort(403);
        }
        try {
            $product = $this->productRepository->storeProduct($request->validated());

            if ($product) {
                $this->imageUploadService->uploadImageFromRequest($request, $product, 'image', 'image');
            }

            return $product
                ? $this->responseRedirect('employee.products.index', 'Product has been created successfully.', 'success')
                : $this->responseRedirectBacK('There was some with the server. Please try again later.');

        }catch (\Throwable $exception){
            return $exception->getMessage();
        }
    }

    public function edit(Product $product)
    {
        if(!auth()->user()->can('edit product')){
            abort(403);
        }
        return view('cms.employees.products.edit', [
            'product' => $product,
            'categories' => Category::whereStatus(TRUE)->get(),
            'brands' => Brand::whereStatus(TRUE)->get(),
        ]);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        if(!auth()->user()->can('edit product')){
            abort(403);
        }
        try {
            $product = $this->productRepository->updateProduct($product->id, $request->all());

            return $product
                ? $this->responseRedirect('employee.products.index', 'Product has been updated successfully.', 'success')
                : $this->responseRedirectBack('There was some problem occurred with  the server. Please try again later.');
        }catch (\Throwable $exception){
            return $exception->getMessage();
        }
    }

    public function destroy(Product $product)
    {
        if(!auth()->user()->can('delete product')){
            abort(403);
        }
        return $this->productRepository->deleteProduct($product->id)
            ? response()->json(['status' => 'success', 'message' => 'Product has been deleted successfully.'])
            : response()->json(['status' => 'error', 'message' => 'There was some issue with the server. Please try again later.']);
    }

    public function datatable(){
        $products = $this->productRepository->listProducts('created_at', 'desc');
        return DataTables::of($products)
            ->addColumn('actions', function ($data) {
                $button = '';
                if(auth()->user()->can('edit product')){
                    $button .= '<a
                        href="' . route('employee.products.edit', $data) . '"
                            type="button"
                            class="btn btn-success waves-effect waves-light btn-md"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Edit"
                            data-bs-original-title="Edit"
                        ><i class="bx bx-pencil font-size-16 align-middle"></i></a>';
                }
                if(auth()->user()->can('delete product')){
                    $button .= '<a
                            href="#"
                            id="delete-btn"
                            data-id="' . $data->id . '"
                            type="button"
                            class="btn btn-danger waves-effect waves-light btn-md"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Delete"
                            data-bs-original-title="Delete"
                        ><i class="bx bx-trash font-size-16 align-middle"></i></a>';
                }
                return '
                    <div class="d-flex flex-wrap gap-2">
                    ' . $button .'
                    </div>
                ';
            })
            ->editColumn('name', function($data){
                return '<div class="col-auto" style="display: inline-block">
                    <img src="'.$data->getFirstOrDefaultMediaUrl('image', 'square-sm-thumb').'" alt="Product Image" height="50" width="50"/>
                </div>
                <div class="col-auto" style="display: inline-block">
                    <span class="text-muted text-truncate">'.$data->name.' </span>
                </div>';
            })
            ->addColumn('info', function ($data){
                $type = ($data->discount_type==='flat') ? 'Rs.' : '%';
                return '<strong>Selling Price : </strong>'. $data->selling_price .'<br />'.
                    '<strong>Discount : </strong>'. $data->discount . $type .'<br />';
            })
            ->editColumn('is_taxable', function ($data) {
                $checked = $data->is_taxable == 1 ? 'checked' : '';

                return '
                    <label for="is-taxable-switch-' . $data->id . '"></label>
                    <input
                        type="checkbox"
                        id="is-taxable-switch-' . $data->id . '"
                        data-id="' . $data->id . '"
                        name="is_taxable"
                        class="js-switch"
                        ' . $checked . '
                        autocomplete="off"
                        onchange="toggleIsTaxable(' . $data->id . ')"
                    />
                ';
            })
            ->editColumn('is_featured', function ($data) {
                $checked = $data->is_featured == 1 ? 'checked' : '';

                return '
                    <label for="is-featured-switch-' . $data->id . '"></label>
                    <input
                        type="checkbox"
                        id="is-featured-switch-' . $data->id . '"
                        data-id="' . $data->id . '"
                        name="is_featured"
                        class="js-switch"
                        ' . $checked . '
                        autocomplete="off"
                        onchange="toggleIsFeatured(' . $data->id . ')"
                    />
                ';
            })
            ->editColumn('is_trending', function ($data) {
                $checked = $data->is_trending == true ? 'checked' : '';

                return '
                    <label for="is-trending-switch-' . $data->id . '"></label>
                    <input
                        type="checkbox"
                        id="is-trending-switch-' . $data->id . '"
                        data-id="' . $data->id . '"
                        name="is_trending"
                        class="js-switch"
                        ' . $checked . '
                        autocomplete="off"
                        onchange="toggleIsTrending(' . $data->id . ')"
                    />
                ';
            })
            ->editColumn('is_refundable', function ($data) {
                $checked = $data->is_refundable == true ? 'checked' : '';

                return '
                    <label for="is-refundable-switch-' . $data->id . '"></label>
                    <input
                        type="checkbox"
                        id="is-refundable-switch-' . $data->id . '"
                        data-id="' . $data->id . '"
                        name="is_refundable"
                        class="js-switch"
                        ' . $checked . '
                        autocomplete="off"
                        onchange="toggleIsRefundable(' . $data->id . ')"
                    />
                ';
            })
            ->editColumn('is_sellable', function ($data) {
                $checked = $data->is_sellable == true ? 'checked' : '';

                return '
                    <label for="is-sellable-switch-' . $data->id . '"></label>
                    <input
                        type="checkbox"
                        id="is-sellable-switch-' . $data->id . '"
                        data-id="' . $data->id . '"
                        name="is_sellable"
                        class="js-switch"
                        ' . $checked . '
                        autocomplete="off"
                        onchange="toggleIsSellable(' . $data->id . ')"
                    />
                ';
            })
            ->addIndexColumn()
            ->rawColumns(['actions', 'name', 'info', 'is_featured', 'is_taxable', 'is_refundable', 'is_trending', 'is_sellable'])
            ->make(true);
    }
}
