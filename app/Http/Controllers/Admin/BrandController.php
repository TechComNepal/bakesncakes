<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use App\Contracts\Brands\BrandContract;
use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Repositories\Brands\BrandRepository;
use App\Contracts\Categories\CategoryContract;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function __construct(CategoryContract $categoryRepository, BrandContract $brandRepository, ImageUploadService $imageUploadService)
    {
        $this->categoryRepository=$categoryRepository;
        $this->brandRepository=$brandRepository;
        $this->imageUploadService = $imageUploadService;
    }

    public function index()
    {
        $this->setPageTitle('Brand', '');
        return request()->ajax()
        ? $this->datatable()
        : view('cms.admin.brands.index');
    }

    public function create()
    {
        $this->setPageTitle('Brand', 'Fill in the required fields to create a new brand.');
        $categories= $this->categoryRepository->listCategories('created_at', 'desc');
        return view('cms.admin.brands.create', compact('categories'));
    }

    public function store(BrandStoreRequest $request)
    {
        try {
            $brand = $this->brandRepository->storeBrand($request->validated());
            if ($brand) {
                $this->imageUploadService->uploadImageFromRequest($request, $brand, 'image', 'brands') ;
            }
            return $brand
                ? $this->responseRedirect('admin.brands.index', 'Brand Created Successfully', 'success')
                : $this->responseRedirectBack('There was some problem with the server. Please try again later.', 'error', true, true);
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }

    public function edit(Brand $brand)
    {
        $this->setPageTitle('Brand', '');
        $categories= $this->categoryRepository->listCategories('created_at', 'desc');

        return view('cms.admin.brands.edit', [
            'categories' => $categories,
            'brand' => $brand
        ]);
    }

    public function update(Brand $brand, BrandUpdateRequest $request)
    {
        try {
            $brand=$this->brandRepository->updateBrand($brand->id, $request->validated());
            if ($brand) {
                $this->imageUploadService->uploadImageFromRequest($request, $brand, 'image', 'brands');
            }
            return $brand
                ? $this->responseRedirect('admin.brands.index', 'Brand Updated Successfully', 'success')
                : $this->responseRedirectBack('There was some problem with server. Please try again later.', 'error', true, true);
        } catch (\Throwable $exception) {
            return $this->responseBackWithException($exception);
        }
    }

    public function destroy(Brand $brand)
    {
        return $brand->delete()
            ? response()->json(['success' => 'Brand Successfully Deleted.'])
            : response()->json(['error' => 'There was some issue with the server. Please try again.']);
    }

    protected function datatable()
    {
        $brands= $this->brandRepository->listBrands('created_at', 'desc');

        return DataTables::of($brands)
            ->editColumn('status', function ($data) {
                $checked = $data->status == 1 ? 'checked' : '';
                return '
                <label for="is-status-switch-' . $data->id . '"></label>
                <input
                    type="checkbox"
                    id="is-status-switch-' . $data->id . '"
                    data-id="' . $data->id . '"
                    name="is_status"
                    class="js-switch"
                    ' . $checked . '
                    autocomplete="off"
                    onchange="toggleIsStatus(' . $data->id . ')"
                />
            ';
            })
            ->editColumn('category', function (Brand $brand) {
                return $brand->getcategory() ;
            })
            ->editColumn('user_id', function ($data) {
                return $data->user->name;
            })
            ->addColumn('actions', function ($data) {
                return '
                    <div class="d-flex flex-wrap gap-2">
                        <a
                        href="' .route('admin.brands.edit', $data). '"
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



         ->editColumn('short_description', function ($data) {
             return '
                    <div class="d-flex flex-column">
                        <h5
                        class="text-body font-size-12 mb-1"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="' . $data->short_description . '"
                            data-bs-original-title="' . $data->short_description . '"
                        >' . Str::limit($data->short_description, 67) . '</h5>
                        
                    </div>
                ';
         })
            ->addIndexColumn()
            ->rawColumns(['status','actions','short_description'])
            ->make(true);
    }

    public function toggleIsStatus(Request $request): JsonResponse
    {
        return $this->brandRepository->updateBrandStatus($request->all())
            ? response()->json(['message' => 'Category Status Updated Successfully.', 'status' => 'success'])
            : response()->json(['message' => 'Error occurred while updating category status.', 'status' => 'error']);
    }
}
