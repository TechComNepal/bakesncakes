<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogStoreRequest;
use App\Http\Requests\BlogUpdteRequest;
use App\Models\Blog;
use App\Services\ImageUploadService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Yajra\DataTables\DataTables;

class BlogController extends Controller
{

    private $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    public function index()
    {
        $this->setPageTitle('Blogs', '');
        return request()->ajax()
            ? $this->datatable()
            : view('cms.admin.pages.blogs.index');
    }

    public function create()
    {
        $this->setPageTitle('Blog', 'Fill in the required fields to create a new Blog.');
        return view('cms.admin.pages.blogs.create');
    }

    public function store(BlogStoreRequest $request)
    {

        try {
            $validate = $request->validated();
            $collection = collect($validate)->except('user_id');
            $user_id = Auth::id();
            $merge = $collection->merge(compact('user_id'));
            $blog=Blog::create($merge->all());
            if ($blog) {
                $this->imageUploadService->uploadImageFromRequest($request, $blog, 'image', 'image');
            }
            return $blog
                ? $this->responseRedirect('admin.blogs.index', 'Blog Successfully Created.', 'success')
                : $this->responseRedirectBack('There was some issue with the server. Please try again.', 'error', true, true);
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }

    public function edit(Blog $blog)
    {
        return view('cms.admin.pages.blogs.edit', [
            'pagetitle' =>  $this->setPageTitle('Edit Blog', ''),
            'blog' => $blog,
        ]);
    }

    public function update(BlogUpdteRequest $request, Blog $blog)
    {
        try {
            $validate = $request->validated();
            $collection = collect($validate)->except('user_id');
            $user_id = Auth::id();
            $merge = $collection->merge(compact('user_id'));
            
            if ($blog) {

                $this->imageUploadService->uploadImageFromRequest($request, $blog, 'image', 'image');

                return $blog->update($merge->all())
                    ? $this->responseRedirect('admin.blogs.index', 'Blog created Sucessfully', 'success')
                    : $this->responseRedirectBack('Error while inserting the image', 'error');
            }
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }

    public function delete(Blog $blog)
    {
        return  $blog->delete()
            ? response()->json(['success' => 'Blog Successfully Deleted.'])
            : response()->json(['error' => 'There was some issue with the server. Please try again.']);
    }

    protected function datatable()
    {
        $data = Blog::latest()->get();
        return DataTables::of($data)
            ->addColumn('actions', function ($data) {
                return '
                    <div class="d-flex flex-wrap gap-2">
                        <a
                        href="' . route('admin.blogs.edit', $data) . '"
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
                            data-id="' . $data->slug . '"
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

            ->editColumn('title', function ($data) {
                return '
                        <div class="d-flex flex-column">
                            <p
                                class="text-body font-size-14 "
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="' . $data->title . '"
                                data-bs-original-title="' . $data->title . '"
                            >' . Str::limit($data->title, 17) . '</p>
                            
                        </div>
                    ';
            })

            ->editColumn('image', function ($data) {
                return ' <img src="'. $data->getFirstOrDefaultMediaUrl("image", 'thumb') .'" style="wiidth: 60px; height: 60px;">
                    ';
            })

            ->editColumn('slug', function ($data) {
                return '
                <p
                    class="text-body font-size-14 "
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="' . $data->slug . '"
                    data-bs-original-title="' . $data->slug . '"
                    >' . Str::limit($data->slug, 22) .
                '</p>
                ';
            })

            ->editColumn('description', function ($data) {
                return '
                <div class="d-flex flex-column">
                                     
                            <h5
                                class="text-body font-size-12 mb-1"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                >'. Str::limit($data->description, 112) .'
                                </h5>

                        </div>

                        

                ';
            })

            ->editColumn('created_at', function ($data) {
                return '
                    <p
                        class="text-body font-size-14 "
                                title="' . $data->created_at . '"
                                data-bs-original-title="' . $data->created_at . '"
                            >' . Carbon::parse($data->created_at)->diffForHumans() . '
                     </p>
                            
                    ';
            })

            ->editColumn('views', function ($data) {
                return '
                        <div class="d-flex flex-column">
                            <h5
                                class="text-body font-size-12 mb-1"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="' . $data->views . '"
                                data-bs-original-title="' . $data->views . '"
                            >' . Str::limit($data->views, 42) . '</h5>
                            <p class="text-muted mb-0 font-size-12">' . $data->views . '</p>
                        </div>
                    ';
            })

            // ,'image'
            ->addIndexColumn()
            ->rawColumns(['actions', 'title', 'image', 'slug', 'description', 'created_at', 'views'])
            ->make(true);
    }
}
