<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Repositories\Products\ProductRepository;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{
    private $productRepository;
    private $imageUploadService;

    public function __construct(ProductRepository $productRepository, ImageUploadService $imageUploadService)
    {
        $this->productRepository = $productRepository;
        $this->setPageTitle('Product', '');
        $this->imageUploadService = $imageUploadService;
    }

    public function index(Request $request)
    {
        return (request()->ajax())
            ? $this->datatable($request)
            : view('cms.admin.products.index');
    }

    public function create()
    {
        return view('cms.admin.products.create', [
            'categories' => Category::with('children')->whereStatus(true)->where('parent_id', null)->get(),
            'brands' => Brand::whereStatus(true)->get(),
        ]);
    }

    public function store(ProductStoreRequest $request)
    {
        try {
            $product = $this->productRepository->storeProduct($request->validated());
         
            if ($product) {
                $this->imageUploadService->uploadImageFromRequest($request, $product, 'image', 'image');
                $this->imageUploadService->uploadMultipleMediaFromRequest($request, $product, 'gallery_image_url', 'gallery_image');
            }

            return $product
                ? $this->responseRedirect('admin.products.index', 'Product has been created successfully.', 'success')
                : $this->responseRedirectBacK('There was some with the server. Please try again later.');
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }

    public function edit(Product $product)
    {
        $gallerys=$product->getMedia('gallery_image');

        return view('cms.admin.products.edit', [
            'product' => $product,
            'categories' => Category::whereStatus(true)->get(),
            'brands' => Brand::whereStatus(true)->get(),
            'gallerys'=>$gallerys,
        ]);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        try {
            $product = $this->productRepository->updateProduct($product->id, $request->all());

            return $product
                ? $this->responseRedirect('admin.products.index', 'Product has been updated successfully.', 'success')
                : $this->responseRedirectBack('There was some problem occurred with  the server. Please try again later.');
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }

    public function destroy(Product $product)
    {
        return $this->productRepository->deleteProduct($product->id)
            ? response()->json(['status' => 'success', 'message' => 'Product has been deleted successfully.'])
            : response()->json(['status' => 'error', 'message' => 'There was some issue with the server. Please try again later.']);
    }

    protected function datatable($request)
    {
        // $products = $this->productRepository->listProducts('created_at', 'desc');
        $query=Product::query();
        if ($request['name']) {
            $query->where('name', 'like', '%'. $request['name'].'%');
        }
        if ($request['sku']) {
            $query->where('sku', 'like', '%'. $request['sku'].'%');
        }
        if ($request['categories']) {
            $query->whereHas('category', function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request['categories'] .'%');
            });
        }
        if ($request['vendor']) {
            $query->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request['vendor'] .'%');
            });
        }

        if ($request['name'] && $request['sku']) {
            $query->where('name', 'like', '%'. $request['name'].'%')
                  ->where('sku', 'like', '%'. $request['sku'].'%');
        }
        if ($request['name'] && $request['categories']) {
            $query->where('name', 'like', '%'. $request['name'].'%')
            ->whereHas('category', function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request['categories'] .'%');
            });
        }
        if ($request['name'] && $request['vendor']) {
            $query->where('name', 'like', '%'. $request['name'].'%')
            ->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request['vendor'] .'%');
            });
        }

        if ($request['sku'] && $request['categories']) {
            $query->where('sku', 'like', '%'. $request['sku'].'%')
            ->whereHas('category', function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request['categories'] .'%');
            });
        }
        if ($request['sku'] && $request['vendor']) {
            $query->where('sku', 'like', '%'. $request['sku'].'%')
            ->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request['vendor'] .'%');
            });
        }

        if ($request['sku'] && $request['categories'] && $request['vendor']) {
            $query->where('sku', 'like', '%'. $request['sku'].'%')
             ->whereHas('category', function ($query) use ($request) {
                 $query->where('name', 'like', '%'.$request['categories'] .'%');
             })
            ->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request['vendor'] .'%');
            });
        }

        if ($request['name']&& $request['sku'] && $request['vendor']) {
            $query->where('name', 'like', '%'. $request['name'].'%')
            ->where('sku', 'like', '%'. $request['sku'].'%')
            ->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request['vendor'] .'%');
            });
        }

        if ($request['name']&& $request['categories'] && $request['vendor']) {
            $query->where('name', 'like', '%'. $request['name'].'%')
            ->whereHas('category', function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request['categories'] .'%');
            })
            ->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request['vendor'] .'%');
            });
        }



        if ($request['categories'] && $request['vendor']) {
            $query->whereHas('category', function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request['categories'] .'%');
            })
            ->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request['vendor'] .'%');
            });
        }



        if ($request['name'] && $request['sku'] && $request['categories']) {
            $query->where('name', 'like', '%'. $request['name'].'%')
            ->where('sku', 'like', '%'. $request['sku'].'%')
            ->whereHas('category', function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request['categories'] .'%');
            });
        }

        if ($request['name'] && $request['sku'] && $request['categories'] && $request['vendor']) {
            $query->where('name', 'like', '%'. $request['name'].'%')
            ->where('sku', 'like', '%'. $request['sku'].'%')
            ->whereHas('category', function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request['categories'] .'%');
            })
             ->whereHas('user', function ($query) use ($request) {
                 $query->where('name', 'like', '%'.$request['vendor'] .'%');
             });
        }



        $products=$query->latest()->get();
        return DataTables::of($products)
            ->addColumn('actions', function ($data) {
                return '
                    <div class="d-flex flex-wrap gap-2">
                        <a
                        href="' . route('admin.products.edit', $data) . '"
                            type="button"
                            class="btn btn-success waves-effect waves-light btn-md"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Edit"
                            data-bs-original-title="Edit"
                        ><i class="bx bx-pencil font-size-16 align-middle"></i></a>
                        <a
                            href="#"
                            id="delete-btn"
                            data-id="' . $data->id . '"
                            type="button"
                            class="btn btn-danger waves-effect waves-light btn-md"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Delete"
                            data-bs-original-title="Delete"
                        ><i class="bx bx-trash font-size-16 align-middle"></i></a>
                    </div>
                ';
            })
            ->editColumn('name', function ($data) {
                return '<div class="col-auto" style="display: inline-block">
                    <img src="'.$data->getFirstOrDefaultMediaUrl('image', 'square-sm-thumb').'" alt="Product Image" height="50" width="50"/>
                </div>
                <div class="col-auto" style="display: inline-block">
                    <span class="text-muted text-truncate">'.$data->name.' </span>
                </div>';
            })
            ->addColumn('info', function ($data) {
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

    public function galleryUpdate(Request $request, Product $product)
    {
        try {
            $this->imageUploadService->uploadMultipleMediaFromRequest($request, $product, 'gallery_image_url', 'gallery_image');
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }
        return $this->responseRedirect('admin.products.index', 'Product Gallery Updated successfully.', 'success');
    }

    public function galleryDestroy($id)
    {
        return $this->productRepository->deleteGallery($id)
            ? response()->json(['success' => 'Gallery Image Successfully Deleted.'])
            : response()->json(['success' => 'There was some issue with the server. Please try again.']);
    }

    public function toggleIsFeatured(Request $request): JsonResponse
    {
        return $this->productRepository->updateProductFeature($request->all())
            ? response()->json(['message' => 'Product Featured Updated Successfully.', 'status' => 'success'])
            : response()->json(['message' => 'Error occurred while updating product featured status.', 'status' => 'error']);
    }

    public function toggleIsTaxable(Request $request): JsonResponse
    {
        return $this->productRepository->updateProductTaxable($request->all())
            ? response()->json(['message' => 'Product Taxable Updated Successfully.', 'status' => 'success'])
            : response()->json(['message' => 'Error occurred while updating product taxable status.', 'status' => 'error']);
    }

    public function toggleIsRefundable(Request $request): JsonResponse
    {
        return $this->productRepository->updateProductRefundable($request->all())
            ? response()->json(['message' => 'Product Refundable Updated Successfully.', 'status' => 'success'])
            : response()->json(['message' => 'Error occurred while updating product refundable status.', 'status' => 'error']);
    }
    public function toggleIsTrending(Request $request): JsonResponse
    {
        return $this->productRepository->updateProductTrending($request->all())
            ? response()->json(['message' => 'Product Trending Updated Successfully.', 'status' => 'success'])
            : response()->json(['message' => 'Error occurred while updating product trending status.', 'status' => 'error']);
    }

    public function toggleIsSellable(Request $request): JsonResponse
    {
        return $this->productRepository->updateProductSellable($request->all())
            ? response()->json(['message' => 'Product Sellable Updated Successfully.', 'status' => 'success'])
            : response()->json(['message' => 'Error occurred while updating product sellable status.', 'status' => 'error']);
    }
}
