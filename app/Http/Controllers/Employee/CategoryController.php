<?php

namespace App\Http\Controllers\Employee;

use App\Contracts\Categories\CategoryContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\ImageUploadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    private $categoryRepository;
    private $imageUploadService;

    public function __construct(CategoryContract $categoryRepository, ImageUploadService $imageUploadService)
    {
        $this->categoryRepository = $categoryRepository;
        $this->imageUploadService = $imageUploadService;
    }

    public function index()
    {
        $this->setPageTitle('Category', '');
        return request()->ajax()
            ? $this->datatable()
            : view('cms.employees.categories.index');
    }

    public function create()
    {
        if (!auth()->user()->can('add category')) {
            abort(403);
        }

        $categories =$this->categoryRepository->listCategories('id', 'asc');
        $this->setPageTitle('Category', 'Fill in the required fields to create a new category.');

        return view('cms.employees.categories.create', compact('categories'));
    }

    public function store(CategoryStoreRequest $request)
    {
        if (!auth()->user()->can('add category')) {
            abort(403);
        }
        try {
            $category= $this->categoryRepository->storeCategory($request->validated());

            if ($category) {
                $this->imageUploadService->uploadImageFromRequest($request, $category, 'image', 'image');
            }

            return $category
                ? $this->responseRedirect('employee.categories.index', 'Category Successfully Created.', 'success')
                : $this->responseRedirectBack('There was some issue with the server. Please try again.', 'error', true, true);
        } catch (\Throwable $exception) {
//            return $this->responseBackWithException($exception);
            return $exception->getMessage();
        }
    }

    public function edit(Category $category)
    {
        if (!auth()->user()->can('edit category')) {
            abort(403);
        }
        $categories =$this->categoryRepository->listCategories('created_at', 'desc');
        $this->setPageTitle('Category', '');
        return view('cms.employees.categories.edit', compact('category', 'categories'));
    }

    public function update(Category $category, CategoryUpdateRequest $request)
    {
        if (!auth()->user()->can('edit category')) {
            abort(403);
        }
        try {
            $updateCategory = $this->categoryRepository->updateCategory($category->id, $request->validated());

            if ($updateCategory) {
                $this->imageUploadService->uploadImageFromRequest($request, $category, 'image', 'image');
            }

            return $updateCategory
                ? $this->responseRedirect('employee.categories.index', 'Category Successfully Updated.', 'success')
                : $this->responseRedirectBack('There was some issue with the server. Please try again.', 'error', true, true);
        } catch (\Throwable $exception) {
            return $this->responseBackWithException($exception);
        }
    }

    public function destroy(Category $category)
    {
        if (!auth()->user()->can('delete category')) {
            abort(403);
        }
        return $this->categoryRepository->deleteCategory($category->id)
            ? response()->json(['success' => 'Category Successfully Deleted.'])
            : response()->json(['success' => 'There was some issue with the server. Please try again.']);
    }

    protected function datatable()
    {
        $categories = $this->categoryRepository->listCategories('created_at', 'desc');
        return DataTables::of($categories)
            ->addColumn('actions', function ($data) {
                $button = '';
                if (auth()->user()->can('edit category')) {
                    $button .= '<a
                        href="' . route('employee.categories.edit', $data) . '"
                            type="button"
                            class="btn btn-success waves-effect waves-light btn-md"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Edit"
                            data-bs-original-title="Edit"
                        ><i class="bx bx-pencil font-size-16 align-middle"></i></a>';
                }
                if (auth()->user()->can('delete category')) {
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
                    '. $button .'
                    </div>
                ';
            })
            ->editColumn('parent_id', function ($data) {
                return $data->parent->name ?? 'Root';
            })
            ->editColumn('level', function ($data) {
                return $data->level ?? '-';
            })
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
            ->editColumn('featured', function ($data) {
                $checked = $data->featured == 1 ? 'checked' : '';

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
            ->editColumn('in_menu', function ($data) {
                $checked = $data->in_menu == true ? 'checked' : '';

                return '
                    <label for="in-menu-switch-' . $data->id . '"></label>
                    <input
                        type="checkbox"
                        id="in-menu-switch-' . $data->id . '"
                        data-id="' . $data->id . '"
                        name="in_menu"
                        class="js-switch"
                        ' . $checked . '
                        autocomplete="off"
                        onchange="toggleInMenu(' . $data->id . ')"
                    />
                ';
            })
            ->addIndexColumn()
            ->rawColumns(['actions', 'parent_id', 'status', 'featured', 'in_menu'])
            ->make(true);
    }

    public function toggleIsStatus(Request $request): JsonResponse
    {
        return $this->categoryRepository->updateCategoryStatus($request->all())
            ? response()->json(['message' => 'Category Status Updated Successfully.',  'status' => 'success'])
            : response()->json(['message' => 'Error occurred while updating category status.', 'status' => 'error']);
    }

    public function toggleIsFeatured(Request $request): JsonResponse
    {
        return $this->categoryRepository->updateCategoryFeature($request->all())
            ? response()->json(['message' => 'Category Featured Updated Successfully.', 'status' => 'success'])
            : response()->json(['message' => 'Error occurred while updating category featured status.', 'status' => 'error']);
    }

    public function toggleInMenu(Request $request): JsonResponse
    {
        return $this->categoryRepository->updateCategoryMenu($request->all())
            ? response()->json(['message' => 'Category Menu Status Updated Successfully.', 'status' => 'success'])
            : response()->json(['message' => 'Error occurred while updating category menu status.', 'status' => 'error']);
    }
}
