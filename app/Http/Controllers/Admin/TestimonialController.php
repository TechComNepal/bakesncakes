<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialStoreRequest;
use App\Http\Requests\TestimonialUpdateRequest;
use App\Models\Testimonial;
use App\Services\ImageUploadService;

use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded;
use Yajra\DataTables\DataTables;

class TestimonialController extends Controller
{
    private $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }
    public function index()
    {
        $this->setPageTitle('Testimonial', '');
        return request()->ajax()
            ? $this->datatable()
            : view('cms.admin.testimonials.index');
    }

    public function create()
    {
        $this->setPageTitle('Testimonials', 'Fill in the required fields to create a new testimonial.');
        return view('cms.admin.testimonials.create');
    }

    public function store(TestimonialStoreRequest $request)
    {
     try {
        $testimonial = Testimonial::create($request->validated());
            if($testimonial)
            {
                $this->imageUploadService->uploadImageFromRequest($request, $testimonial,'image','image');
            }
                
            return $testimonial
            ? $this->responseRedirect('admin.testimonials.index', 'Testimonial created Sucessfully', 'success')
            : $this->responseRedirectBack('Error while inserting the image', 'error');
        }
        catch (FileCannotBeAdded $e) {
            abort(413, 'File size to big or there was some issue with the upload. Please try again later.' . $e->getMessage());
        }
    }

    public function edit(Testimonial $testimonial)
    {
    return view('cms.admin.testimonials.edit',[
        'pageTitle'=> $this->setPageTitle('Testimonial','Please Update the reuired field'),
        'testimonial' => $testimonial
    ]);

    }

    public function update(TestimonialUpdateRequest $request, Testimonial $testimonial)
    {
        try {
                   
            if ($testimonial) {

                $this->imageUploadService->uploadImageFromRequest($request, $testimonial, 'image', 'image');

                return $testimonial->update($request->all())
                    ? $this->responseRedirect('admin.testimonials.index', 'Testimonial created Sucessfully', 'success')
                    : $this->responseRedirectBack('Error while inserting the image', 'error');
            }
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }

    public function delete(Testimonial $testimonial)
    {
        return  $testimonial->delete()
            ? response()->json(['success' => 'Testimonial Successfully Deleted.'])
            : response()->json(['error' => 'There was some issue with the server. Please try again.']);
    }
    
    protected function datatable()
    {
        $data = Testimonial::latest()->get();
        return DataTables::of($data)
            ->addColumn('actions', function ($data) {
                return '
                    <div class="d-flex flex-wrap gap-2">
                        <a
                        href="' . route('admin.testimonials.edit', $data) . '"
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

            ->editColumn('image', function ($data) {
                return ' <img src="'. $data->getFirstOrDefaultMediaUrl("image", 'thumb') .'" style="width: 80px; height:80px;">
                    ';
            })

            ->editColumn('description', function ($data) {
                return '
                <div class="d-flex flex-column">
                                     
                            <h5
                                class="text-body font-size-12 mb-1"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                >'. Str::limit($data->description, 60) .'
                                </h5>
                        </div>
                ';
            })

            // ,'image'
            ->addIndexColumn()
            ->rawColumns(['actions', 'title', 'slug','image', 'description'])
            ->make(true);
    }
}
